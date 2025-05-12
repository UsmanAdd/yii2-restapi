Для запуска проекта:
- composer install
- composer dump
- docker-compose up

В отдельной вкладке
- docker-compose exec php sh
- yii migrate
- yii seeder

Для взаимодействия с api рекомендуется используется postman:
- на вкладке Headers добавить ключи:
      X-Api-Key: secret
      X-Role: main - для post/put/delete запросов


  Эндпоинты:
  http://localhost:8000/api/requests - управление заявками
  http://localhost:8000/api/vehicles — управление транспортом
  http://localhost:8000/api/couriers — управление курьерами
