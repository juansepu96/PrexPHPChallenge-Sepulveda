<p align="center"><a href="https://www.prexcard.com.ar" target="_blank"><img src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/prex.png" width="400" alt="Prex Logo"></a></p>

<h2 align="center">PHP Challenge - Sepulveda Juan Pablo</h2>

## Tecnologías Utilizadas

<p align="center">
    <a href="https://php.net"><img style="width:150px;margin:15px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/php.webp" alt="PHP v8.2"></a>
    <a href="https://laravel.com"><img style="width:150px;margin:15px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/laravel.png" alt="Laravel v10"></a>
    <a href="https://mysql.com"><img style="width:150px;margin:15px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/mysql.webp" alt="MySQL"></a>
    <a href="https://www.docker.com/"><img style="width:150px;margin:15px" src="https://softweare.com.ar/PrexPHPChallenge-Sepulveda/docker.png" alt="Docker"></a>
</p>

## PHP Challenge

El presente proyecto tiene como objetivo desarrollar el Challenge de PHP propuesto por PREX para el rol de PHP Developer. El desafío es integrarse a una API existente y desarrollar una API REST propia que exponga un conjunto de servicios. Asimismo se deberán entregar distintos diagramas que representen la solución.

## Requisitos necesarios

- PHP 8.2^
- Composer
- Laravel 10^
- MySQL 
- Docker 
- API Giphy para .env -> GIPHY_API_KEY="v6xSRoYkKV4OXBSHe4ZzJOrCBMh3QT4n"



## Despligue del proyecto

- Clonar el Proyecto
- Levantar Docker **docker-compose up -d --build**
- Realizar migración y seeders de la base de datos **docker-compose exec php artisan migrate --seed**

**La API está en funcionamiento en 127.0.0.1:8000**

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
- Login
Descripción: Autenticación de usuario para obtener un token.
Actor: Usuario
Entrada: email, password
Salida: token con expiración de 30 minutos

- Buscar GIFs
Descripción: Buscar GIFs por una frase o término.
Actor: Usuario
Entrada: QUERY (cadena, requerido), LIMIT (numérico, opcional), OFFSET (numérico, opcional)
Autenticación: El usuario debe estar logueado
Salida: Colección con resultados de búsqueda

- Buscar GIF por ID
Descripción: Obtener información de un GIF específico.
Actor: Usuario
Entrada: ID (numérico, requerido)
Autenticación: El usuario debe estar logueado
Salida: Datos del recurso consultado

- Guardar GIF Favorito
Descripción: Almacenar un GIF favorito para un usuario.
Actor: Usuario
Entrada: GIF_ID (numérico, requerido), ALIAS (cadena, requerido), USER_ID (numérico, requerido)
Autenticación: El usuario debe estar logueado
Salida: Confirmación de guardado
