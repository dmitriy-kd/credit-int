# credit-int

## Запуск

запуск проекта - docker compose up -d --build
выключение - docker compose down --remove-orphans

## Описание

- приложение слушает 81 порт
- данные хранятся в postgres на 5432 порту
  - имя бд: app
  - юзер - пароль: app - password

## Эндпоинты:
- создание кастомера:
  - метод POST
  - урл http://localhost:81/api/customer
  - тело 
    - {
      "fullName": "Petr Pavel",
      "age": 35,
      "region": "OS",
      "income": 1500,
      "score": 600,
      "pin": "123-45-4785",
      "email": "petr.paeeel@example.com",
      "phone": "+4201234561278"
      }


- выдача займа:
  - метод POST
  - урл http://localhost:81/api/loan/issue/{customer_id}
  - тело
    - {
      "creditTimeInDays": 30,
      "amount": 20000
      }


- получить активный займ кастомера:
  - метод GET
  - урл http://localhost:81/api/loan/customer/{customer_id}