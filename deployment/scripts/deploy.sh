#!/bin/sh

DATE=`date +%Y%m%d%H%M%S`

setup() {
    mv /tmp/$DATE/$1 /opt/lotusy/$1/releases/$DATE
    rm /opt/lotusy/$1/current.bak
    mv /opt/lotusy/$1/current /opt/lotusy/$1/current.bak
    ln -s /opt/lotusy/$1/releases/$DATE /opt/lotusy/$1/current
    if [ "$1" = "www" ] ; then
        ln -s /opt/lotusy/www/current/config/config.inc.int /opt/lotusy/www/current/config/config.inc
    elif [ "$1" = "core" ] ; then
        ln -s /opt/lotusy/core/current/dao/config/config.inc.int /opt/lotusy/core/current/dao/config/config.inc
    else
        ln -s /opt/lotusy/$1/current/dao/config/config.inc.int /opt/lotusy/$1/current/dao/config/config.inc
        ln -s /opt/lotusy/$1/current/rest/config/config.inc.int /opt/lotusy/$1/current/rest/config/config.inc
        ln -s /opt/lotusy/$1/current/portal/config/config.inc.int /opt/lotusy/$1/current/portal/config/config.inc
    fi
}

git clone -b production https://pshen1983:Langara2@github.com/pshen1983/lotusy-server.git /tmp/$DATE

setup $1

rm -rf /tmp/$DATE

echo $1' is deployed successfully...'