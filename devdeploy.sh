SERVER_PATH="www/u1646689.isp.regruhosting.ru/"

. ./zip.sh

ssh -t poweb "rm -rf $SERVER_PATH/*"
ssh -t poweb "rm -rf $SERVER_PATH/.*"

scp pcmpare.zip poweb:www/u1646689.isp.regruhosting.ru
ssh -t poweb "unzip $SERVER_PATH/pcmpare.zip -d $SERVER_PATH"

ssh -t poweb "sed -i 's/DB_HOST=mysql/DB_HOST=localhost/' $SERVER_PATH.env"
ssh -t poweb "sed -i 's/DB_DATABASE=products_compare/DB_DATABASE=u1646689_test/' $SERVER_PATH.env"
ssh -t poweb "sed -i 's/DB_USERNAME=sail/DB_USERNAME=u1646689_test/' $SERVER_PATH.env"
ssh -t poweb "sed -i 's/DB_PASSWORD=password/DB_PASSWORD=u1646689_test/' $SERVER_PATH.env"