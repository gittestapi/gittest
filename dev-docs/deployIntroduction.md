# How to deploy GitTest.COM website
## Setup Yii environment
CentOS 6.3:
```
vi /etc/httpd/conf/httpd.conf
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/gittest/basic/web
    ServerName 104.225.150.223
    ErrorLog /var/log/apache.com-error_log
    CustomLog /var/log/apache-access_log common
</VirtualHost>
https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-centos-6
https://www.zerostopbits.com/how-to-upgrade-php-5-3-to-php-5-4-on-centos-6-7/
https://www.zerostopbits.com/how-to-install-upgrade-php-5-3-to-php-5-5-on-centos-6-7/
cd /var/www/html/gittest/basic/
composer install
chmod 777 assets/
chmod 777 runtime/
chmod 777 web/assets/
vi  composer.json
"asset-installer-paths": {
            "npm-asset-library": "vendor/npm",
            "bower-asset-library": "vendor"
}
rm -rf vendor
composer install
mv vendor/bower-asset vendor/bower

yum --enablerepo remi,epel install gd-last
yum install php-gd
vi /etc/php.ini
service httpd restart
```

## Insert mysql.txt script to mysql database
//TODO

## yii migrate and RBAC init
Run following command:
```
yii migrate --migrationPath=/migrations
yii rbac/init
```
