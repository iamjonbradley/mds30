role :app, "10.10.2.12"
set :user, 'root'
set :password, 'ITMgt2009'

set :application, "mds"
set :deploy_to, "/data/apps/#{application}"
set :copy_dir, "/tmp"

# SCM settings

default_run_options[:pty] = true

set :repository,  "git@github.com:jonbradley/MDS.git"
set :branch, 'master'
set :scm, 'git'
set :deploy_via, :remote_cache
 
# Deploy settings
set :copy_exclude, [".git/*", ".gitignore"]
set :copy_compression, :gzip
 
# Use account tmp dir as /tmp is wierd.
set :copy_remote_dir, '/tmp'
 
# Configure which plugins are going to be updated when the code is deployed.
# set :plugins_dir, "/Users/markstory/Sites/cake_plugins"
# set :app_plugins, ['asset_compress']
 
# Options
set :use_sudo, false
set :keep_releases, 5
 
#ssh_options[:keys] = %w(c:/Users/jonbradley/.sshid_rsa)
ssh_options[:forward_agent] = true

 
# Deployment tasks
namespace :deploy do
  desc "Override the original :restart"
  task :restart, :roles => :app do
    clear_cache
    cleanup
  end
 
  task :finalize_update, :roles => :app do
    # remove temp 
    run "rm -rf #{shared_path}/tmp/cache/models/*"
    run "rm -rf #{shared_path}/tmp/cache/views/*"
    run "rm -rf #{shared_path}/tmp/cache/persistent/*"
    run "rm -rf #{shared_path}/tmp/cache/cake_*"
    run "rm -rf #{current_release}/app/tmp"
    run "rm -rf #{current_release}/app/webroot/transmission_files"
    run "rm -rf #{current_release}/app/config/database.php"
    run "rm -rf #{current_release}/app/config/core.php"
    run "rm -rf #{current_release}/app/webroot/census"
    
    # link the files
    run "ln -s #{shared_path}/config/database.php #{current_release}/app/config/database.php"
    run "ln -s #{shared_path}/config/core.php #{current_release}/app/config/core.php"
    run "ln -s #{shared_path}/tmp #{current_release}/app/tmp"
    run "ln -s #{shared_path}/transmission_files #{current_release}/app/webroot/transmission_files"
    run "ln -s #{shared_path}/exports #{current_release}/app/webroot/exports"
    run "ln -s #{shared_path}/billing #{current_release}/app/webroot/billing"
    run "ln -s #{shared_path}/screenshots #{current_release}/app/webroot/screenshots"
    run "ln -s #{shared_path}/census #{current_release}/app/webroot/census"
    
    # chmod required files
    run "chmod 777 #{current_release}/cake/console/cake"
  end
 
  namespace :plugins do
    desc "Symlinks the configured plugins for the appliction into plugins, from the shared dirs."
    task :create_symlink, :roles => :app do 
      app_plugins.each { |plugin|
        run "ln -s #{shared_path}/plugins/#{plugin} #{latest_release}/plugins/#{plugin}"
      }
    end
  end
 
  namespace :web do
    desc "Setup lock file"
    task :disable, :roles => :app do
        run "touch #{current_release}/app/webroot/.capistrano-lock"
    end
 
    desc "Enable the current access after deployment"
    task :enable, :roles => :app do
      run "rm -f #{current_release}/app/webroot/.capistrano-lock"
    end
  end
end
 
namespace :clear_cache do
  desc <<-DESC
    Blow up all the cache files CakePHP uses, ensuring a clean restart.
  DESC
  task :default do
    # Remove absolutely everything from TMP
    run "rm -rf #{deploy_to}/app/tmp/*"
 
    # Create TMP folders
    run "mkdir -p #{shared_path}/tmp/{cache/{models,persistent,views},sessions,logs,tests}"
  end
end
 
namespace :pending do
  desc <<-DESC
    Displays the 'diff' since your last deploy. This is useful if you want \
    to examine what changes are about to be deployed. Note that this might \
    not be supported on all SCM's.
  DESC
  task :diff, :except => { :no_release => true } do
    system(source.local.diff(current_revision))
  end
 
  desc <<-DESC
    Displays the commits since your last deploy. This is good for a summary \
    of the changes that have occurred since the last deploy. Note that this \
    might not be supported on all SCM's.
  DESC
  task :default, :except => { :no_release => true } do
    from = source.next_revision(current_revision)
    system(source.local.log(from))
  end
end