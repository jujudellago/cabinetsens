# New server teerak (201.79.15.11). Independent of production.rb, which still targets shatzi.
# See ~/Sites/TEERAK-DEPLOY-HANDOFF-2026-10-22.md before running anything against it.
set :stage, :teerak
server "201.79.15.11", user: "deploy", roles: %w[web app db]

set :deploy_to, "/var/www/cabinetsens"
set :tmp_dir, "/tmp"
set :branch, :master

set :ssh_options, {
  keys: [File.expand_path("~/.ssh/id_ed25519_teerak")],
  keys_only: true,
  auth_methods: %w[publickey],
  forward_agent: false,
  verify_host_key: :always
}

# File ownership/permissions are set up on the server per site; don't chmod the release
# (deploy.rb's set_rights also made cache, w3tc-config and Bridge js dirs 0777).
set :set_rights, false

# WP-CLI from the server PATH.
SSHKit.config.command_map[:wp] = "/usr/local/bin/teerak-wp cabinetsens"

set :default_env, fetch(:default_env, {}).merge(wp_env: :production)
set :linked_files, (fetch(:linked_files, []) + [".env"]).uniq

set :wpcli_remote_url, @secrets_yml["production_url"]
set :wpcli_local_url, @secrets_yml["dev_url"]
set :local_tmp_dir, "/tmp"
set :wpcli_backup_db, true
set :wpcli_local_db_backup_dir, "config/backups"
set :wpcli_local_uploads_dir, "web/app/uploads/"
set :wpcli_remote_uploads_dir, -> { "#{shared_path}/web/app/uploads/" }

# Override only for a reviewed deployment; ordinary future deploys use master.
set :branch, ENV.fetch("TEERAK_REVISION", "master")
set :composer_install_flags, "--no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader --no-scripts"
set :composer_working_dir, -> { release_path }
set :composer_roles, :web

namespace :teerak do
  desc "Apply site isolation before publishing a new Cabinetsens release"
  task :prepare_cabinetsens_release do
    next unless fetch(:deploying, false)
    raise "Unexpected teerak destination" unless fetch(:deploy_to).to_s == "/var/www/cabinetsens"
    expected = ENV["TEERAK_REVISION"]
    raise "Unexpected revision" if expected && fetch(:current_revision).to_s != expected
    on roles(:web) do
      if test("[ -f /var/www/cabinetsens/shared/.preview-mode ]")
        upload! File.expand_path("teerak-preview-guard.php", __dir__),
                release_path.join("web/app/mu-plugins/000-cabinetsens-preview-guard.php")
      end
      upload! File.expand_path("teerak-mail-disabled.php", __dir__),
              release_path.join("web/app/mu-plugins/002-teerak-mail-disabled.php")
      upload! File.expand_path("teerak-runtime-filesystem.php", __dir__),
              release_path.join("web/app/mu-plugins/001-cabinetsens-runtime-filesystem.php")
      upload! File.expand_path("teerak-asset-fixes.py", __dir__), release_path.join(".teerak-asset-fixes.py")
      execute :python3, release_path.join(".teerak-asset-fixes.py"), release_path
      execute :sudo, "-n", "/usr/local/sbin/teerak-prepare-release", "cabinetsens", release_path
    end
  end
end

before "deploy:publishing", "teerak:prepare_cabinetsens_release"

# The gem and legacy local task both define wpcli:run. Replace their accumulated
# actions for teerak so each command runs once against the published site.
Rake::Task["wpcli:run"].clear_actions
namespace :wpcli do
  task :run, :command do |_task, args|
    args.with_defaults(command: :help)
    on roles(:app) do
      within current_path do
        execute :wp, args[:command], fetch(:wpcli_args)
      end
    end
  end
end
