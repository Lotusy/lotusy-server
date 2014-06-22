#!/bin/sh

DATE=`date +%Y%m%d%H%M%S`

deploy() {
	echo "starting www deployment to $1 ..."
	ssh root@$1 rm -rf /opt/lotusy/www/current
	scp -r $2/www root@$1:/opt/lotusy/www/releases > /dev/null 2>&1
	ssh root@$1 mv /opt/lotusy/www/releases/www /opt/lotusy/www/releases/$DATE
	ssh root@$1 ln -s /opt/lotusy/www/releases/$DATE /opt/lotusy/www/current
	ssh root@$1 rm -rf /opt/lotusy/www/current/.svn
	ssh root@$1 rm -rf /opt/lotusy/www/current/*/.svn
	ssh root@$1 rm -rf /opt/lotusy/www/current/*/*/.svn
	ssh root@$1 rm -rf /opt/lotusy/www/current/*/*/*/.svn
	ssh root@$1 rm /opt/lotusy/www/current/config/config.inc
	ssh root@$1 ln -s /opt/lotusy/www/current/config/config.inc.staging /opt/lotusy/www/current/config/config.inc
	ssh root@$1 rm /opt/lotusy/www/current/.project
	ssh root@$1 rm /opt/lotusy/www/current/.buildpath
	echo "finishing www deployment to $1!"
}

for ii in ${@:2}
do
    deploy $ii $1
done
