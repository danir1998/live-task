## REST API сервис для формирования подборки задач

## Заголовки
### `Authorization: Bearer {token}`
где `{token}`, токен выданный при авторизации или регистрации 
### `Accept: application/json`
### `Content-Type: application/json`

## Маршруты

### `POST /api/login - Авторизация`
Тело запроса
```javascript
{
    "email": "era@vk.com",
    "password": "123123123"
}
```
Ответ
```javascript
{
    "token": "14|sdfds7hstV2qW7WL1iUW9ez9shki9Ohreg3GIsu5a94",
    "user": {
        "id": 5,
        "name": "Eleonora.Taz",
        "email": "era@vk.com",
        "email_verified_at": null,
        "created_at": "2022-04-28T09:18:34.000000Z",
        "updated_at": "2022-04-28T09:18:34.000000Z",
        "token": null
    }
}
```

### `POST /api/register - Регистрация`
Тело запроса
```javascript
{
    "email": "test@vk.com", 
    "password": "testtest",
    "name": "Last Name Middle"
}
```
Ответ
```javascript
{
    "message": "success",
    "user": {
        "name": "Last Name Middle",
        "email": "test@vk.com",
        "updated_at": "2022-04-28T18:34:58.000000Z",
        "created_at": "2022-04-28T18:34:58.000000Z",
        "id": 6
    },
    "token": "15|huJSL4Jq0nFXzucrmNToJRjjTBVRukxBZ9lVdzZ5"
}
```

### `GET /api/v1/list - Вывод базы всех задач`
Ответ
```javascript
[
    {
        "id": 61,
        "title": "Mining Engineer OR Geological Engineer",
        "body": "Dolor animi eos sunt sed.",
        "category_id": "6",
        "category": {
            "id": 6,
            "name": "Booleans"
        }
    },
    ...
]
```

### `GET /api/v1/task - вывод уникальных персональных задач`
Ответ
```javascript
[
    {
        "id": 31,
        "task_id": "88",
        "user_id": "5",
        "created_at": null,
        "updated_at": null,
        "done": false,
        "task": {
            "id": 88,
            "title": "Animal Control Worker",
            "body": "Maiores ipsam a ut rerum qui.",
            "category_id": "1",
            "category": {
                "id": 1,
                "name": "Fundamentals"
            }
        }
    },
    ...
]
```

### `POST /api/v1/task/success/{id} - установка статуса выполнено`
Тело запроса
```
/api/v1/task/success/31
```
Ответ
```javascript
{
        "id": 31, 
        "task_id": "88",
        "user_id": "5",
        "created_at": null,
        "updated_at": "2022-04-28T18:39:53.000000Z",
        "done": true
}
```

### `PUT /api/v1/task/change/{id} - Замена задания`
Тело запроса

```javascript
/api/v1/task/change/31
{"task_id": "78"}
```
Ответ
```javascript
{
    "message": "success"
}
```

### `GET /api/v1/for-user - Формирование уникальной подборки задач для пользователей (на крон раз в сутки)`

### `GET /api/v1/fake - Генерация базы задач`



