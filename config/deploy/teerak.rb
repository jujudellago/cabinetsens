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
SSHKit.config.command_map[:wp] = "wp"

set :default_env, fetch(:default_env, {}).merge(wp_env: :production)
set :linked_files, (fetch(:linked_files, []) + [".env"]).uniq

set :wpcli_remote_url, @secrets_yml["production_url"]
set :wpcli_local_url, @secrets_yml["dev_url"]
set :local_tmp_dir, "/tmp"
set :wpcli_backup_db, true
set :wpcli_local_db_backup_dir, "config/backups"
set :wpcli_local_uploads_dir, "web/app/uploads/"
set :wpcli_remote_uploads_dir, -> { "#{shared_path}/web/app/uploads/" }
