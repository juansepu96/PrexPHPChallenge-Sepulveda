<p align="center"><a href="https://www.prexcard.com.ar" target="_blank"><img src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/prex.png" width="400" alt="Prex Logo"></a></p>

<h2 align="center">PHP Challenge - Sepulveda Juan Pablo</h2>

## Tecnologías Utilizadas

<p align="center">
    <a href="https://php.net"><img style="width:150px;padding:45px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/php.webp" alt="PHP v8.2"></a>
    <a href="https://laravel.com"><img style="width:150px;padding:45px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/laravel.png" alt="Laravel v10"></a>
    <a href="https://mysql.com"><img style="width:150px;padding:45px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/mysql.webp" alt="MySQL"></a>
    <a href="https://www.docker.com/"><img style="width:150px;padding:45px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/docker.png" alt="Docker"></a>
</p>

## PHP Challenge

El presente proyecto tiene como objetivo desarrollar el Challenge de PHP propuesto por PREX para el rol de PHP Developer. El desafío es integrarse a una API existente y desarrollar una API REST propia que exponga un conjunto de servicios. Asimismo se deberán entregar distintos diagramas que representen la solución.

## Requisitos necesarios

- PHP 8.2^
- Composer 2.7^
- Laravel 10^
- MySQL 
- Docker 
- API Giphy para .env -> GIPHY_API_KEY="v6xSRoYkKV4OXBSHe4ZzJOrCBMh3QT4n"


## Despligue del proyecto

- Clonar el Proyecto **[git clone https://github.com/juansepu96/PrexPHPChallenge-Sepulveda.git]**
- Copiar el archivo .env.example a .env **[cp .env.example .env]**
- Generar la clave de la aplicación **[docker run --rm -v $(pwd):/var/www -w /var/www laravel_app php artisan key:generate]**
- Levantar Docker **docker-compose up -d --build**
- Realizar migración y seeders de la base de datos **docker-compose exec app php artisan migrate --seed**
- Para realizar los test, ejecutar el comando **docker-compose exec app php artisan test**

**La API estará en funcionamiento en localhost:8000**

## Rutas API

- Login  **POST:[/api/login]**
- Buscar GIFS **GET:[/api/gifs]**
- Buscar GIF por ID  **GET:[/api/gifs/{id}]**
- Guardar GIF favorito  **POST:[/api/favorites]**

## Codigos de Error HTTP

- **[400]** Error de conexión con Giphy
- **[401]** No tiene permisos
- **[409]** Parametros inválidos

## Usuario por defecto

- **[admin@admin.com]** 
- **[123456]** 

## Test Unitarios / Features

- **[Unit]** 
    - AuthTest.php : Testea la ruta /login en 3 casos: Credenciales válidas, inválidas y petición incorrecta.
- **[Features]** 
    - GIFFavoriteTest.php : Testea agregar gif como favorito en caso válido y e petición incorrecta.
    - GIFTest.php : Verifica la búsqueda por parámetro y por ID.

## Casos de Uso
**Diagrama**

<p align="center">
    <img style="width:900px;margin:15px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/diagcu.png" alt="Diagrama de Casos de Uso">
</p>

**Consideraciones**

- Login: Estuve en duda de agregarlo o no, ya que teóricamente el Diagrama de Casos de Uso es un diagrama dónde no se muestran detalles de implementación, pero si representa acciones que realizan los usuarios, por eso decidí incluirlo, además de también esta especificado como un servicio mas en el enunciado del Challenge.
- API Giphy: También la incluí debido a que es una comunicación externa que también realiza validación de la GIPHY_API_KEY.


**Actores Principales**
- Usuario (User): Interactúa con la API para autenticarse, buscar y guardar GIFs.
- API: El sistema que proporciona servicios de autenticación y manejo de GIFs.
- API GIPHY

**Casos de Uso**
- Login <br>
Descripción: Autenticación de usuario para obtener un token.<br>
Actor: Usuario.<br>
Entrada: email, password. <br>
Salida: token con expiración de 30 minutos.<br>

- Buscar GIFs <br>
Descripción: Buscar GIFs por una frase o término. <br>
Actor: Usuario. <br>
Entrada: QUERY (cadena, requerido), LIMIT (numérico, opcional), OFFSET (numérico, opcional). <br>
Autenticación: El usuario debe estar logueado. <br>
Salida: Colección con resultados de búsqueda.<br> 

- Buscar GIF por ID <br>
Descripción: Obtener información de un GIF específico. <br>
Actor: Usuario.<br>
Entrada: ID (numérico, requerido).<br>
Autenticación: El usuario debe estar logueado.<br>
Salida: Datos del recurso consultado.<br>

- Guardar GIF Favorito <br>
Descripción: Almacenar un GIF favorito para un usuario.<br>
Actor: Usuario.<br>
Entrada: GIF_ID (numérico, requerido), ALIAS (cadena, requerido), USER_ID (numérico, requerido).<br>
Autenticación: El usuario debe estar logueado.<br>
Salida: Confirmación de guardado.<br>

## Diagrama de Secuencias

**Caso de Uso: Login**

<p align="center">
    <img style="width:100%;margin:15px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/DiagSec1.png" alt="Diagrama de Secuencia - caso Login">
</p>

**Caso de Uso: Buscar GIFs**

<p align="center">
    <img style="width:100%;margin:15px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/DiagSec2.png" alt="Diagrama de Secuencia - caso Buscar GIFs">
</p>

**Caso de Uso: Buscar GIF por ID**

<p align="center">
    <img style="width:100%;margin:15px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/DiagSec3.png" alt="Diagrama de Secuencia - caso Buscar GIF por ID">
</p>

**Caso de Uso: Guardar GIF Favorito**

<p align="center">
    <img style="width:100%;margin:15px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/DiagSec4.png" alt="Diagrama de Secuencia - caso Guardar GIF Favorito">
</p>


## Diagrama de Entidad - Relacion

<p align="center">
    <img style="width:100%;margin:15px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/DER.png" alt="Diagrama de Entidad - Relación">
</p>

## Coleccion POSTMAN

La colección POSTMAN se encuentra en **postman/PrexPHPChallenge-Sepulveda.postman_collection**


## Dockerfile

El archivo se encuentra en **./Dockerfile**

## Principio SOLID

- Utilicé Controladores y Servicios para las rutas de la API con el objetivo de cumplir con el principio SOLID. 

## Principio DRY

- Aplicado gracias a Passport utilizando el Middleware para validar un grupo de rutas sin duplicar código.

## Principio Tell Don’t Ask.

- Aplicado al verificar el estado del controlador Auth en el servicio AuthService y no en el AuthController.
