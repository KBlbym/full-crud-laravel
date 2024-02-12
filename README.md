
# Generador de CRUD completo para Laravel
Este repositorio contiene una herramienta personalizada para Laravel que simplifica la creación de CRUD (Create, Read, Update, Delete) de manera eficiente y rápida utilizando los datos del modelo.

# Características principales:
Generación automática: Crea controladores con todo el código necesario para el funcionamiento de la aplicación, junto con las vistas con una estructura básica de HTML.

# Uso:
1. Crea un proyecto Laravel con tu herramienta preferida.
2. Copia los archivos ``` MakeControllerCrudCommand.php ``` y ``` MakeViewCrudCommand.php ``` a la ruta de tu proyecto ``` App\Console\Commands\ ```.
3. Pega la carpeta templates dentro de la carpeta ``` resources\views ``` de tu proyecto.
4. Crea un modelo.
5. Ejecuta el siguiente comando para crear el controlador junto con sus vistas, utilizando los datos de tu modelo creado anteriormente:
   ```
    php artisan make:controller-crud ElNombreDelModelo --views
   ```
   
  La opción ``` --views ``` crea las vistas además del controlador. Puedes omitirla si solo deseas crear el controlador.
  
6. Si no especificaste la opción ``` --views ``` en el paso anterior, puedes crear las vistas más adelante ejecutando el siguiente comando:
```
php artisan make:controller-crud ElNombreDelModelo --views
```

7. Finalmente, agrega las rutas al archivo app\routes\web.php, además de configurar tu base de datos.
   
# ¡Listo! Ahora puedes disfrutar de la creación automática de CRUD en tu proyecto Laravel de forma rápida y sencilla.





