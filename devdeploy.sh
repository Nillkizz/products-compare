. ./mysqldump.sh
. ./zip.sh

APP_URL="https://u1646689.isp.regruhosting.ru"
DB_DATABASE="u1646689_test"
DB_USERNAME="u1646689_test"
DB_PASSWORD="u1646689_test"
SERVER_PATH="www/u1646689.isp.regruhosting.ru"
STORAGE_LN="/var/www/u1646689/data/www/u1646689.isp.regruhosting.ru/storage/app/public"

ssh -t poweb "rm -rf $SERVER_PATH/* && rm -rf $SERVER_PATH/.*"

scp pcmpare.zip poweb:www/u1646689.isp.regruhosting.ru
ssh -t poweb "unzip $SERVER_PATH/pcmpare.zip -d $SERVER_PATH"

ssh -t poweb "sed -i 's/APP_URL=.*/APP_URL=${APP_URL//\//\\/}/' $SERVER_PATH/.env && \
              sed -i 's/DB_HOST=mysql/DB_HOST=localhost/' $SERVER_PATH/.env && \
              sed -i 's/DB_DATABASE=products_compare/DB_DATABASE=$DB_DATABASE/' $SERVER_PATH/.env && \
              sed -i 's/DB_USERNAME=sail/DB_USERNAME=$DB_USERNAME/' $SERVER_PATH/.env && \
              sed -i 's/DB_PASSWORD=password/DB_PASSWORD=$DB_PASSWORD/' $SERVER_PATH/.env"

ssh -t poweb "ln -s $STORAGE_LN $SERVER_PATH/public/storage"

ssh -t poweb "sh $SERVER_PATH/drop_all_tables.sh -d $DB_DATABASE -u $DB_USERNAME -p $DB_PASSWORD && \
              mysql -u $DB_USERNAME -p$DB_PASSWORD $DB_DATABASE < $SERVER_PATH/db_dump.sql"
