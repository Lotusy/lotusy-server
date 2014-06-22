#!/bin/sh

DATE=`date +%Y%m%d%H%M%S`

deploy() {
	echo "starting business deployment to $1 ..."
	ssh root@$1 rm -rf /opt/lotusy/business/current
	scp -r $2/business root@$1:/opt/lotusy/business/releases > /dev/null 2>&1
	ssh root@$1 mv /opt/lotusy/business/releases/business /opt/lotusy/business/releases/$DATE
	ssh root@$1 ln -s /opt/lotusy/business/releases/$DATE /opt/lotusy/business/current
	ssh root@$1 rm -rf /opt/lotusy/business/current/.svn
	ssh root@$1 rm -rf /opt/lotusy/business/current/*/.svn
	ssh root@$1 rm -rf /opt/lotusy/business/current/*/*/.svn
	ssh root@$1 rm -rf /opt/lotusy/business/current/*/*/*/.svn
	ssh root@$1 rm /opt/lotusy/business/current/dao/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/business/current/dao/config/config.inc.staging /opt/lotusy/business/current/dao/config/config.inc
	ssh root@$1 rm /opt/lotusy/business/current/rest/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/business/current/rest/config/config.inc.staging /opt/lotusy/business/current/rest/config/config.inc
	ssh root@$1 rm /opt/lotusy/business/current/portal/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/business/current/portal/config/config.inc.staging /opt/lotusy/business/current/portal/config/config.inc
	ssh root@$1 rm /opt/lotusy/business/current/.project
	ssh root@$1 rm /opt/lotusy/business/current/.buildpath
	echo "finishing business deployment to $1!"
}

for ii in ${@:2}
do
    deploy $ii $1
done
