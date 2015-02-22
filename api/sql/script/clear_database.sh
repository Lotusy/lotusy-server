#!/bin/sh
mysql -uroot -pLangara2 -e "DROP DATABASE foodster"

cd ../../dao/generated/

rm *