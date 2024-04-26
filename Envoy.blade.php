@servers(['web' => 'vhost101931ssh@babycoolfood.com -p 1022'])

@task('info', ['on' => 'web'])
    cd htdocs/stage
    which php
@endtask

@task('deploy:stage', ['on' => 'web'])
    cd htdocs/stage
    git pull origin dev -ff
    /usr/local/bin/php81-cli /usr/local/bin/composer install --no-dev
    npm install
    npm run build
    /usr/local/bin/php81-cli artisan storage:link
    /usr/local/bin/php81-cli artisan statamic:static:clear
    /usr/local/bin/php81-cli artisan statamic:stache:warm
    /usr/local/bin/php81-cli artisan statamic:stache:refresh
    /usr/local/bin/php81-cli artisan cache:clear
    /usr/local/bin/php81-cli artisan optimize:clear
@endtask

@task('deploy:live', ['on' => 'web'])
    cd htdocs/prod
    git pull origin main -ff
    /usr/local/bin/php81-cli /usr/local/bin/composer install --no-dev
    npm install
    npm run build
    /usr/local/bin/php81-cli artisan storage:link
    /usr/local/bin/php81-cli artisan statamic:static:clear
    /usr/local/bin/php81-cli artisan statamic:stache:warm
    /usr/local/bin/php81-cli artisan statamic:stache:refresh
    /usr/local/bin/php81-cli artisan cache:clear
    /usr/local/bin/php81-cli artisan optimize:clear
@endtask