set :stage, :production

# Simple Role Syntax
# ==================
#role :app, %w{deploy@example.com}
#role :web, %w{deploy@example.com}
#role :db,  %w{deploy@example.com}

# Extended Server Syntax
# ======================
#server '127.0.0.1', user: 'juju', roles: %w{web app db}
server "94.103.96.177", user: 'gsprojet', roles: %w{web app db}

#set :tmp_dir, "/home/clients/d9e7a0ab00bb20eac180d94da2fe2de6/tmp"

set :tmp_dir, "/home/gsprojet/tmp"


set :deploy_to, -> { "/home/gsprojet/gs-projets.ch/production" }
#SSHKit.config.command_map[:bash] = "source"

#SSHKit.config.shell = "source"

#SSHKit.config.command_map[:composer] = "php /Users/juju/utils/php/composer/composer.phar"
SSHKit.config.command_map[:composer] = "php /home/gsprojet/utils/php/composer/composer.phar"



# you can set custom ssh options
# it's possible to pass any option but you need to keep in mind that net/ssh understand limited list of options
# you can see them in [net/ssh documentation](http://net-ssh.github.io/net-ssh/classes/Net/SSH.html#method-c-start)
# set it globally
# set :ssh_options, {
#   keys: %w(~/.ssh/id_rsa),
#   forward_agent: true,
#   auth_methods: %w(password)
# }

fetch(:default_env).merge!(wp_env: :production)

set :wpcli_remote_url, @secrets_yml['production_url']
set :wpcli_local_url, @secrets_yml['dev_url']

set :local_tmp_dir, '/Users/juju/tmp'
set :wpcli_backup_db, true
set :wpcli_local_db_backup_dir, 'config/backups'
set :wpcli_local_uploads_dir, 'web/app/uploads/'
set :wpcli_remote_uploads_dir, "#{shared_path.to_s}/web/app/uploads/"





#namespace :deploy do
#  task :export_db do
#    on roles(:web) do
#      execute :wp, release_path.to_s, ' db export'
#    end
#  end
#end
#
#after "deploy:updated", "deploy:export_db"
