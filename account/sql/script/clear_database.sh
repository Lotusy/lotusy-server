#!/bin/sh
mysql -uroot -pLangara2 -e "DROP DATABASE l_account"

cd ../../dao/generated/

rm *