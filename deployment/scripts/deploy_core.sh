#!/bin/sh

DATE=`date +%Y%m%d%H%M%S`

deploy() {
	echo "starting core deployment to $1 ..."
	ssh root@$1 rm -rf /opt/lotusy/core/current
	scp -r $2/core root@$1:/opt/lotusy/core/releases > /dev/null 2>&1
	ssh root@$1 mv /opt/lotusy/core/releases/core /opt/lotusy/core/releases/$DATE
	ssh root@$1 ln -s /opt/lotusy/core/releases/$DATE /opt/lotusy/core/current
	ssh root@$1 rm -rf /opt/lotusy/core/current/.svn
	ssh root@$1 rm -rf /opt/lotusy/core/current/*/.svn
	ssh root@$1 rm -rf /opt/lotusy/core/current/*/*/.svn
	ssh root@$1 rm -rf /opt/lotusy/core/current/*/*/*/.svn
	ssh root@$1 rm /opt/lotusy/core/current/dao/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/core/current/dao/config/config.inc.staging /opt/lotusy/core/current/dao/config/config.inc
	ssh root@$1 rm /opt/lotusy/core/current/.project
	ssh root@$1 rm /opt/lotusy/core/current/.buildpath
	echo "finishing core deployment to $1!"
}

for ii in ${@:2}
do
    deploy $ii $1
done
