#!/bin/sh
mysql -uroot -pLangara2 -e "CREATE DATABASE l_account"

for jj in ../schema/*.sql; do
	echo $jj
	mysql -uroot -pLangara2 l_account < $jj
done

mysql -uroot -pLangara2 -e "GRANT ALL ON l_account.* TO 'lotusyaccount'@'%' IDENTIFIED BY 'lotusypasswd'"
mysql -uroot -pLangara2 -e "FLUSH PRIVILEGES"