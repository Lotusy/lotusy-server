#!/bin/sh
mysql -uroot -pLangara2 -e "CREATE DATABASE l_comment"

for jj in ../schema/*.sql; do
	echo $jj
	mysql -uroot -pLangara2 l_comment < $jj
done

mysql -uroot -pLangara2 -e "GRANT ALL ON l_comment.* TO 'lotusycomment'@'%' IDENTIFIED BY 'lotusypasswd'"
mysql -uroot -pLangara2 -e "FLUSH PRIVILEGES"