# LucioProject
Proyecto para Ingenieria de software Escom

## Caracteristicas del proyecto
* Arquitectura MVC (Model View Controller)
* Dividido en 2 secciones la parte **Cliente** y la parte **Panel** 
  * Cliente es la seccion a la cual los padres e infantes tienen acceso a la plataforma
  * Panel es la seccion de administracion de la plataforma donde se pueden dar de alta Cursos y sus recursos
* Uso de gestores de paquetes para dependencias del proyecto
  * [Composer](https://getcomposer.org/): Gestor de dependencias para PHP
  * [Bower](http://bower.io/): Gestor de dependencias JS

## Paquetes instalados mediante Bower

### Seccion de Panel
* [Showdownjs](https://github.com/showdownjs/showdown)

### Seccion de Cliente
* [Materialize](http://materializecss.com/)
* [Material Desing Icons](https://design.google.com/icons/)

## Paquetes instalados mediante Composer

### Seccion del Panel
* [CorePHP Mapper](https://github.com/danteay/CorePHPMapper)
* [Parsedown](https://github.com/erusev/parsedown)

## Proceso de instalacion del proyecto

### Requerimeintos
* PHP >= 5.6
* Mysql >= 5

### Pasos para la instalacion
* Descargar e instalar [XAMPP](https://www.apachefriends.org/es/index.html) como servidor para montar la aplicacion.
* Una vez instalada iniciar los servicios Apache
* Descargar einstalar [MySQL](https://www.mysql.com/) como servidor de base de datos
* Una vez instalado iniciarlo y asegurarse que este ligado a las variables de entorno para poder corre el comando **mysql** desde consola
* Descargar el .zip del proyecto desde [github](https://github.com/danteay/LucioProject) 
* Descomprimir el contenido del .zip en la carpeta **xampp/htdocs/**
* Abrir una consola o terminal e ingresar a la ruta donde se encuentra el archivo **database.sql** del proyecto situado en la raiz del mismo
* Correr el comando **mysql -u root** o **mysql -u root -p** si su servidor tiene alguna contraseña
* Ejecutar **source database.sql;** Esto cargara la base de datos
* Al finalizar la carga insertar el primer usuario administrador con el comando **[ inserto into Administradores (correo,passwd) values ('root@root.com','root') ]**, esto generara un acceso balido al panel de administración

## Referencias importantes
* [Markdown](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet): Formato utilizado para generar los temarios de los cursos en el panel de administracion
