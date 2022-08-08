module.exports = {
    'resources/**/*.{css,js,vue}': ['prettier --write'],
    '**/*.php': ['php ./vendor/bin/php-cs-fixer fix --config .php_cs --allow-risky=yes'],
};