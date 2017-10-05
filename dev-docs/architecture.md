# Architecture Desgin for GitTest.com

## Design
GeoDNS+Apache+Mysql

## GeoDNS
TBD:

https://www.cloudns.net/

http://www.geoscaling.com/

## Apache Replication(Reverse Proxy with load balance)
Reverse Proxy: https://httpd.apache.org/docs/current/en/mod/mod_proxy.html#basic-examples

Load Balance:
https://httpd.apache.org/docs/2.4/howto/reverse_proxy.html#manager

https://www.digitalocean.com/community/tutorials/how-to-use-apache-http-server-as-reverse-proxy-using-mod_proxy-extension

https://www.digitalocean.com/community/tutorials/how-to-use-apache-as-a-reverse-proxy-with-mod_proxy-on-centos-7

Sync: https://www.tecmint.com/sync-two-apache-websites-using-rsync/

## Mysql Replication
https://www.toptal.com/mysql/mysql-master-slave-replication-tutorial

http://networkgeekstuff.com/networking/master-master-apache-mysql-synchronization-tutorial-example-config/

https://www.digitalocean.com/community/tutorials/how-to-set-up-mysql-master-master-replication

https://www.digitalocean.com/community/tutorials/how-to-set-up-master-slave-replication-in-mysql

## Make yii support mysql read/write splitting
http://www.yiiframework.com/extension/dbreadwritesplitting/
