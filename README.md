<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
</p>

## Instalación y Uso del Proyecto

Primero es necesario clonar el proyecto:
```bash
git clone https://github.com/romero-javi/dam_api_proyecto_final.git
```

Luego es necesario crear una base de datos llamada ```proyecto_final_dam```.

Posterior a la creacion de la base de datos es necesario crear las tablas mediante las migraciones desarrolladas en el proyecto:
```bash
php artisan migrate
``` 

Ahora es necesario alojar la api en un servidor web como Apache o Nginx, para facil y rapido uso de esta es posible utilizar el servidor web de php artisan:
```bash
php artisan serve
```
