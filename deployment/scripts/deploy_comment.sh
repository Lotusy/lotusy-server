#!/bin/sh

DATE=`date +%Y%m%d%H%M%S`

deploy() {
	echo "starting comment deployment to $1 ..."
	ssh root@$1 rm -rf /opt/lotusy/comment/current
	scp -r $2/comment root@$1:/opt/lotusy/comment/releases > /dev/null 2>&1
	ssh root@$1 mv /opt/lotusy/comment/releases/comment /opt/lotusy/comment/releases/$DATE
	ssh root@$1 ln -s /opt/lotusy/comment/releases/$DATE /opt/lotusy/comment/current
	ssh root@$1 rm -rf /opt/lotusy/comment/current/.svn
	ssh root@$1 rm -rf /opt/lotusy/comment/current/*/.svn
	ssh root@$1 rm -rf /opt/lotusy/comment/current/*/*/.svn
	ssh root@$1 rm -rf /opt/lotusy/comment/current/*/*/*/.svn
	ssh root@$1 rm /opt/lotusy/comment/current/dao/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/comment/current/dao/config/config.inc.staging /opt/lotusy/comment/current/dao/config/config.inc
	ssh root@$1 rm /opt/lotusy/comment/current/rest/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/comment/current/rest/config/config.inc.staging /opt/lotusy/comment/current/rest/config/config.inc
	ssh root@$1 rm /opt/lotusy/comment/current/portal/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/comment/current/portal/config/config.inc.staging /opt/lotusy/comment/current/portal/config/config.inc
	ssh root@$1 rm /opt/lotusy/comment/current/.project
	ssh root@$1 rm /opt/lotusy/comment/current/.buildpath
	echo "finishing comment deployment to $1!"
}

for ii in ${@:2}
do
    deploy $ii $1
done
