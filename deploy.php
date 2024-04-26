<?php

namespace Deployer;

require 'recipe/statamic.php';

// Project name
set('application', 'babycool');
set('remote_user', 'vhost101931ssh');
set('http_user', 'vhost101931ssh');
set('keep_releases', 2);

set('shared_files', [
    'public/.htaccess',
    '.env'
]);

// Hosts
host('babycoolfood.com')
    ->setHostname('babycoolfood.com')
    ->set('http_user', 'vhost101931ssh')
    ->set('port', 1022)
    ->set('deploy_path', '~/htdocs/prod')
    ->set('branch', 'master');

host('Stage')
    ->setHostname('babycoolfood.com')
    ->set('http_user', 'vhost101931ssh')
    ->set('port', 1022)
    ->set('remote_user', 'vhost101931ssh')
    ->set('deploy_path', '~/htdocs/stage')
    ->set('branch', 'dev');

// Tasks
set('repository', 'git@gitlab.com:veebisepad/babycool.git');
//Restart opcache
task('opcache:clear', function () {
    run('killall php81-cgi || true');
})->desc('Clear opcache');

desc('Warm statche');
task('stache:warm', artisan('statamic:stache:warm'));

task('build:node', function () {
    cd('{{release_path}}');
    run('npm i');
    run('npx vite build');
    run('rm -rf node_modules');
});
task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'build:node',
    'stache:warm',
    'deploy:publish',
    'opcache:clear',
]);
after('deploy:failed', 'deploy:unlock');
