#!/bin/sh

DATE=`date +%Y%m%d%H%M%S`

deploy() {
	echo "starting image deployment to $1 ..."
	ssh root@$1 rm -rf /opt/lotusy/image/current
	scp -r $2/image root@$1:/opt/lotusy/image/releases > /dev/null 2>&1
	ssh root@$1 mv /opt/lotusy/image/releases/image /opt/lotusy/image/releases/$DATE
	ssh root@$1 ln -s /opt/lotusy/image/releases/$DATE /opt/lotusy/image/current
	ssh root@$1 rm -rf /opt/lotusy/image/current/.svn
	ssh root@$1 rm -rf /opt/lotusy/image/current/*/.svn
	ssh root@$1 rm -rf /opt/lotusy/image/current/*/*/.svn
	ssh root@$1 rm -rf /opt/lotusy/image/current/*/*/*/.svn
	ssh root@$1 rm /opt/lotusy/image/current/dao/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/image/current/dao/config/config.inc.staging /opt/lotusy/image/current/dao/config/config.inc
	ssh root@$1 rm /opt/lotusy/image/current/rest/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/image/current/rest/config/config.inc.staging /opt/lotusy/image/current/rest/config/config.inc
	ssh root@$1 rm /opt/lotusy/image/current/portal/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/image/current/portal/config/config.inc.staging /opt/lotusy/image/current/portal/config/config.inc
	ssh root@$1 rm /opt/lotusy/image/current/.project
	ssh root@$1 rm /opt/lotusy/image/current/.buildpath
	echo "finishing image deployment to $1!"
}

for ii in ${@:2}
do
    deploy $ii $1
done
