

## instalacion

Paso para instalar

- git clone
- composer install
- php artisan migrate
- php artisan db:seed

## rutas

has sistema de usuarios y la contraseña inicial es "secret" consultar seeders

- /home  para usuarios (user@mail.com)
- /admin  panel de administracion (admin@mail.com)
- /login  para ambos usuarios


## usar el generador
las rutas del generador solo pueden ser usadas por un administrador, asi que logueate como admin y luego entra a:

- /1crearjson  genera el json base para crear el panel
- /2generar  genera las pantallas de CRUD para todas las tablas de la bd
- /rollback  elimina todas las pantallas de CRUD pero no toca el JSON


