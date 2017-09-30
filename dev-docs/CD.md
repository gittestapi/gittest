Continuous Deployment
```
echo 'y'|cp /root/composer.json /var/www/html/gittest/basic/composer.json
echo 'y'|cp /root/db.php /var/www/html/gittest/basic/config/db.php
echo 'yes'|/var/www/html/gittest/basic/yii migrate --migrationPath=/var/www/html/gittest/basic/migrations
/var/www/html/gittest/basic/yii /var/www/html/gittest/basic/rbac/init
```
