## Stacks

```
LARAVEL 11
DOCKER
MYSQL
SAIL
```

### Install dependencies

```
# composer
composer install
```

### Compiles and hot-reloads for development

```
# php artisan key:generate

# ./sail buil

# ./sail up

# ./sail art migrate

# ./sail artisan db:seed
```

### Routes

```
  GET|HEAD  / ..................................................................................................................................... 
  POST      api/auth/login ......................................................................................... Auth\Api\LoginController@login
  POST      api/auth/logout ....................................................................................... Auth\Api\LoginController@logout
  POST      api/auth/validate-token ........................................................................ Auth\Api\LoginController@validateToken
  POST      api/consult/assign/consult/{consult_id}/doctor/{doctor_id} ................................. Consult\Api\ConsultController@assignDoctor
  DELETE    api/consult/delete/{id} .......................................................................... Consult\Api\ConsultController@delete
  GET|HEAD  api/consult/filter ............................................................................... Consult\Api\ConsultController@filter
  GET|HEAD  api/consult/getDoctors ....................................................................... Consult\Api\ConsultController@getDoctors
  GET|HEAD  api/consult/list ................................................................................... Consult\Api\ConsultController@list
  POST      api/consult/register ........................................................................... Consult\Api\ConsultController@register
  PUT       api/consult/update/{id} .......................................................................... Consult\Api\ConsultController@update
  POST      api/register ..................................................................................... User\Api\UserController@registerUser
  GET|HEAD  api/user/list .................................................................................. User\Api\UserController@listUserCommon
  GET|HEAD  sanctum/csrf-cookie ................................................. sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show
  GET|HEAD  up ....................................................................................................................................
```

### Complementary Project

[Complementary Project](https://github.com/MacielSousa/patusco_front).

