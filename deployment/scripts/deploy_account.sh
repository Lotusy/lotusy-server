#!/bin/sh

DATE=`date +%Y%m%d%H%M%S`

deploy() {
	echo "starting account deployment to $1 ..."
	ssh root@$1 rm -rf /opt/lotusy/account/current
	scp -r $2/account root@$1:/opt/lotusy/account/releases > /dev/null 2>&1
	ssh root@$1 mv /opt/lotusy/account/releases/account /opt/lotusy/account/releases/$DATE
	ssh root@$1 ln -s /opt/lotusy/account/releases/$DATE /opt/lotusy/account/current
	ssh root@$1 rm -rf /opt/lotusy/account/current/.svn
	ssh root@$1 rm -rf /opt/lotusy/account/current/*/.svn
	ssh root@$1 rm -rf /opt/lotusy/account/current/*/*/.svn
	ssh root@$1 rm -rf /opt/lotusy/account/current/*/*/*/.svn
	ssh root@$1 rm /opt/lotusy/account/current/dao/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/account/current/dao/config/config.inc.staging /opt/lotusy/account/current/dao/config/config.inc
	ssh root@$1 rm /opt/lotusy/account/current/rest/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/account/current/rest/config/config.inc.staging /opt/lotusy/account/current/rest/config/config.inc
	ssh root@$1 rm /opt/lotusy/account/current/portal/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/account/current/portal/config/config.inc.staging /opt/lotusy/account/current/portal/config/config.inc
	ssh root@$1 rm /opt/lotusy/account/current/.project
	ssh root@$1 rm /opt/lotusy/account/current/.buildpath
	echo "finishing account deployment to $1!"
}

for ii in ${@:2}
do
    deploy $ii $1
done
