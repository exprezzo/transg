transg
======


Instalación:
==

En la raiz de las aplicaciones web:

	/www/  			 (linux)
	
	/xampp/htdocs/  (windows + xampp)  
	
Ejecutamos:

	git clone https://github.com/exprezzo/transg.git NOMBREPROYECTO
 
Luego nos ubicamos dentro de la carpeta NOMBREPROYECTO
 
Y ejecutamos:
 
	git submodule update --init core
 
	git submodule update --init modulos/backend
	
Lo siguiente es importar la base de datos que se encuentra en:
	
	/dev_docs/sql/trans.sql

Y dependiendo de tu configuración para MySql, deberás editar el archivo

	/portal/config.php