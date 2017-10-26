Continuous Deployment
```
cd /var/www/html/gittest/basic/
Restore mysql: mysql -uroot -p yii2basic < gittest.sql;

echo 'y'|cp /root/db.php /var/www/html/gittest/basic/config/db.php
cd /var/www/html/gittest/basic
./yii rbac/init
```

Obsoleted:
```
echo 'y'|cp /root/composer.json /var/www/html/gittest/basic/composer.json
echo 'yes'|/var/www/html/gittest/basic/yii migrate --migrationPath=/var/www/html/gittest/basic/migrations
```
