#!/bin/sh

{% if project.type != 'application' %}
echo '[curl] Getting Composer, the PHP dependency manager'
curl -sS https://getcomposer.org/installer | php

echo '[composer] Downloading the dependencies'
composer require "{{ project.composer_package }}:~1"
{% if project.type == 'bundle' %}

echo '[sed] Registering the bundle'
sed -i 's/{{ project.appKernelPatternToMatch }}/{{ project.appKernelPatternToReplace }}/' app/AppKernel.php
{% endif %}
{% else %}
echo '[git] Downloading the project'
git clone https://github.com/{{ project.github_repository }}.git
cd {{ project.directory }}

echo '[curl] Getting Composer, the PHP dependency manager'
curl -sS https://getcomposer.org/installer | php

echo '[composer] Downloading the dependencies'
php composer.phar install --no-dev --optimize-autoloader
{% endif %}
