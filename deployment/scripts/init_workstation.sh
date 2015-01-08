cd ../../core/dao/config/
ln -s config.inc.dev config.inc
cd ../../../account/dao/config/
ln -s config.inc.dev config.inc
cd ../../rest/config/
ln -s config.inc.dev config.inc
cd ../../portal/config/
ln -s config.inc.dev config.inc
cd ../..
mkdir logs
chmod 777 logs
cd ../business/dao/config/
ln -s config.inc.dev config.inc
cd ../../rest/config/
ln -s config.inc.dev config.inc
cd ../../portal/config/
ln -s config.inc.dev config.inc
cd ../..
mkdir logs
chmod 777 logs
cd ../comment/dao/config/
ln -s config.inc.dev config.inc
cd ../../rest/config/
ln -s config.inc.dev config.inc
cd ../../portal/config/
ln -s config.inc.dev config.inc
cd ../..
mkdir logs
chmod 777 logs
cd ../image/dao/config/
ln -s config.inc.dev config.inc
cd ../../rest/config/
ln -s config.inc.dev config.inc
cd ../../portal/config/
ln -s config.inc.dev config.inc
cd ../..
mkdir logs
chmod 777 logs
cd ../www/config
ln -s config.inc.dev config.inc
cd ..
mkdir logs
chmod 777 logs
rm /etc/apache2/sites-enabled/lotusy-*
ln -s /opt/lotusy/deployment/apache/local/lotusy-* /etc/apache2/sites-enabled/

