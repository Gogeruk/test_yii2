
:::START:::
1.
docker-compose up -d

2.
docker ps

3.
docker exec -it <php docker id> /bin/bash

4.
composer install

5.
php yii migrate

!!!
IN CASE OF PERMISSION ERROR
sudo chown -R $USER:$USER test_yii2
chmod 777 -R test_yii2/app/web/
chmod 777 -R test_yii2/app/runtime/


--------------------
Go to
http://localhost:8080/
Generate an anon user and copy token for api

:::API Curl:::
// index
curl \
  --request GET \
  --header "Content-Type: application/json" \
  http://localhost:8080/api/user-review?access_token=<token>

// by id
curl \
  --request GET \
  --header "Content-Type: application/json" \
  http://localhost:8080/api/user-review/id/<id>?access_token=<token>

// by ip
curl \
  --request GET \
  --header "Content-Type: application/json" \
  http://localhost:8080/api/user-review/ip/<ip>?access_token=<token>

// get all authors
curl \
  --request GET \
  --header "Content-Type: application/json" \
  http://localhost:8080/api/user-review/author?access_token=<token>


// create
curl \
  --request POST \
  --header "Content-Type: application/json" \
  --data '{"name":"Actor_ex","email":"Actor_ex@email.com","review":"data_ex","rating":"2","advantage":"advantage_ex"}' \
  http://localhost:8080/api/user-review/create?access_token=<token>

// update
curl \
  --request POST \
  --header "Content-Type: application/json" \
  --data '{"id":"1","name":"Actor_ex_2","email":"Actor_ex_2@email.com","review":"data_ex_2","rating":"3","advantage":"advantage_ex_2"}' \
  http://localhost:8080/api/user-review/update?access_token=<token>

