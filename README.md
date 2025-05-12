Для запуска проекта:
- composer install
- composer dump
- docker-compose up

В отдельной вкладке
- docker-compose exec php sh
- yii migrate
- yii seeder

Для взаимодействия с api рекомендуется используется postman:
- на вкладке Headers добавить ключи: <br>
      X-Api-Key: secret <br>
      X-Role: main - для post/put/delete запросов <br>
<br> <br>
  Эндпоинты: <br>
  http://localhost:8000/api/requests - управление заявками <br>
  http://localhost:8000/api/vehicles — управление транспортом <br>
  http://localhost:8000/api/couriers — управление курьерами <br>
