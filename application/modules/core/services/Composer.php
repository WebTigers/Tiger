<?php

class Core_Service_Composer
{

    public function status () {

        pr( shell_exec("
            cd /var/www/tiger-vendor;
            export COMPOSER_HOME=/home/ec2-user/.config/composer;
            php /var/www/tiger-vendor/composer.phar show webtigers/kitten 2>&1")
        );

    }

}