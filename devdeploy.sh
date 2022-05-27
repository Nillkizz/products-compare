DB_DATABASE=u1646689_test
DB_USERNAME=u1646689_test
DB_PASSWORD=u1646689_test

SERVER_PATH="www/u1646689.isp.regruhosting.ru"

. ./mysqldump.sh
. ./zip.sh

ssh -t poweb "rm -rf $SERVER_PATH/*"
ssh -t poweb "rm -rf $SERVER_PATH/.*"

scp pcmpare.zip poweb:www/u1646689.isp.regruhosting.ru
ssh -t poweb "unzip $SERVER_PATH/pcmpare.zip -d $SERVER_PATH"

ssh -t poweb "sed -i 's/DB_HOST=mysql/DB_HOST=localhost/' $SERVER_PATH/.env"
ssh -t poweb "sed -i 's/DB_DATABASE=products_compare/DB_DATABASE=$DB_DATABASE/' $SERVER_PATH/.env"
ssh -t poweb "sed -i 's/DB_USERNAME=sail/DB_USERNAME=$DB_USERNAME/' $SERVER_PATH/.env"
ssh -t poweb "sed -i 's/DB_PASSWORD=password/DB_PASSWORD=$DB_PASSWORD/' $SERVER_PATH/.env"

ssh -t poweb "sh $SERVER_PATH/drop_all_tables.sh -d $DB_DATABASE -u $DB_USERNAME -p $DB_PASSWORD"
ssh -t poweb "mysql -u $DB_USERNAME -p$DB_PASSWORD $DB_DATABASE < $SERVER_PATH/db_dump.sql"


