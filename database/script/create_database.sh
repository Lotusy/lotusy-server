#!/bin/sh
mysql -uroot -pLangara2 -e "CREATE DATABASE foodster"

for jj in ../schema/*.sql; do
	echo $jj
	mysql -uroot -pLangara2 foodster < $jj
done

mysql -uroot -pLangara2 -e "GRANT ALL ON foodster.* TO 'foodsteraccount'@'%' IDENTIFIED BY 'foodsterpass'"
mysql -uroot -pLangara2 -e "FLUSH PRIVILEGES"