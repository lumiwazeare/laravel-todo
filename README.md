
## Installation Process

### Prerequisites

- [PHP 8.2+](https://www.php.net/manual/en/install.php)
- [Composer](https://getcomposer.org)
- [Node.js](https://nodejs.org/en/)

### Installation

```
composer install
```

``` 
npm install
```

### Usage
Please update mysql credential in the `.env` file. Then run the command below to run migrations.

``` 
php artisan migrate
```

Start the development server.
``` 
php artisan serve --port 8080
```

## API documentation
baseUrl: http://127.0.0.1:8080/api

## Authentication
### Login
```
[POST]

{{baseUrl}}/login

Header
Content-Type: application/json

Body Parameters
email: string
password: string

```

### Register
```
[POST]

{{baseUrl}}/register

Header
Content-Type: application/json

Body Parameters
name: string
email: string
password: string

```


### Logout
```
[POST]

{{baseUrl}}/logout

Header
Content-Type: application/json
Authorization: Bearer {{token}}

Body Parameters


```


### Refresh Token
```
[POST]

{{baseUrl}}/refresh

Header
Content-Type: application/json
Authorization: Bearer {{token}}

Body Parameters

```

## Todo

### Create Todo
```
[POST]

{{baseUrl}}/todo

Header
Content-Type: application/json
Authorization: Bearer {{token}}

Body Parameters
title: string

```


### Get All Todo
```
[GET]

{{baseUrl}}/todo

Header
Content-Type: application/json
Authorization: Bearer {{token}}

```

### Get A single todo
```
[GET]

{{baseUrl}}/todo/{{todoId}}

Header
Content-Type: application/json
Authorization: Bearer {{token}}

```


### Update Todo
```
[PUT]

{{baseUrl}}/todo/{{todoId}}

Header
Content-Type: application/json
Authorization: Bearer {{token}}

Body Parameters
title: string

```


### Delete Todo
```
[DELETE]

{{baseUrl}}/todo/{{todoId}}

Header
Content-Type: application/json
Authorization: Bearer {{token}}

```


## Task

### Create Task
```
[POST]

{{baseUrl}}/task/{{todoId}}

Header
Content-Type: application/json
Authorization: Bearer {{token}}

Body Parameters
title: string
description: string
startDate: datetime e.g 2022-01-01 00:00:00
endDate: datetime e.g 2022-01-01 00:00:00
```


### Get All Tasks
```
[GET]

{{baseUrl}}/task/{{todoId}}

Header
Content-Type: application/json
Authorization: Bearer {{token}}

```

### Get A single task
```
[GET]

{{baseUrl}}/task/{{todoId}}/{{id}}

Header
Content-Type: application/json
Authorization: Bearer {{token}}

```


### Update Task
```
[PUT]

{{baseUrl}}/task/{{todoId}}/{{id}}

Header
Content-Type: application/json
Authorization: Bearer {{token}}

Body Parameters
title: string
description: string
```


### Delete Task
```
[DELETE]

{{baseUrl}}/task/{{todoId}}/{{id}}

Header
Content-Type: application/json
Authorization: Bearer {{token}}

```