#!/bin/sh
mysql -uroot -pLangara2 -e "DROP DATABASE foodster"

cd ../../api/dao/generated/

rm *