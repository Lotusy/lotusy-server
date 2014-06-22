#!/bin/sh

create() {
	ssh root@$1 mkdir /opt/lotusy
	ssh root@$1 mkdir /opt/lotusy/core
	ssh root@$1 mkdir /opt/lotusy/core/releases
	ssh root@$1 mkdir /opt/lotusy/core/logs
	ssh root@$1 mkdir /opt/lotusy/core/current
	ssh root@$1 mkdir /opt/lotusy/account
	ssh root@$1 mkdir /opt/lotusy/account/releases
	ssh root@$1 mkdir /opt/lotusy/account/logs
	ssh root@$1 mkdir /opt/lotusy/account/current
	ssh root@$1 mkdir /opt/lotusy/business
	ssh root@$1 mkdir /opt/lotusy/business/releases
	ssh root@$1 mkdir /opt/lotusy/business/logs
	ssh root@$1 mkdir /opt/lotusy/business/current
	ssh root@$1 mkdir /opt/lotusy/comment
	ssh root@$1 mkdir /opt/lotusy/comment/releases
	ssh root@$1 mkdir /opt/lotusy/comment/logs
	ssh root@$1 mkdir /opt/lotusy/comment/current
	ssh root@$1 mkdir /opt/lotusy/image
	ssh root@$1 mkdir /opt/lotusy/image/releases
	ssh root@$1 mkdir /opt/lotusy/image/logs
	ssh root@$1 mkdir /opt/lotusy/image/current
	ssh root@$1 mkdir /opt/lotusy/www
	ssh root@$1 mkdir /opt/lotusy/www/releases
	ssh root@$1 mkdir /opt/lotusy/www/logs
	ssh root@$1 mkdir /opt/lotusy/www/current
	ssh root@$1 chmod 777 /opt/lotusy/account/logs
	ssh root@$1 chmod 777 /opt/lotusy/business/logs
	ssh root@$1 chmod 777 /opt/lotusy/comment/logs
	ssh root@$1 chmod 777 /opt/lotusy/image/logs
	ssh root@$1 chmod 777 /opt/lotusy/www/logs
}

for ii in $@
do
    create $ii
done
