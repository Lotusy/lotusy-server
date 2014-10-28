#!/bin/sh
mysql -uroot -pLangara2 -e "CREATE DATABASE l_business"

for jj in ../schema/*.sql; do
	echo $jj
	mysql -uroot -pLangara2 l_business < $jj
done

mysql -uroot -pLangara2 -e "GRANT ALL ON l_business.* TO 'lotusybusiness'@'%' IDENTIFIED BY 'lotusypasswd'"
mysql -uroot -pLangara2 -e "FLUSH PRIVILEGES"