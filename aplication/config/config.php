<?php 
	
	/*
	app_name de manera opcional se describe el nombre de su aplicacion web, 
	puede poner el nombre del directorio donde esta instalado el framework
	*/
	$config['app_name'] 			= 'mvc';

	/* 
	usted puede cambiar de nombre el directorio donde se aloja su aplicacion (directorio: aplication)
	siempre y cuando modifique la variable que hace referencia a esta
	*/
	$config['aplication_folder'] 	= 'aplication';

	/*
	usted puede cambiar de nombre el directorio donde se aloja sus archivos publicos (directorio: public)
	siempre y cuando modifique la variable que hace referencia a esta
	*/
	$config['public_folder'] 		= 'public';

	/*
	Esta variable se llena de manera automatica si su directorio donde se aloja su framework tiene el mismo nombre
	que su variable app_name, en caso de no serlo puede modificar esta variable con la url donde esta su aplicacion.
	*/
	$config['base_url'] 		  	= $_SERVER["SERVER_NAME"].'/'.$config['app_name'];

	/*
	cuando la url no contiene ningun controlador definido en esta, se puede llamar a un controlador por default.
	Usualmente podria ser la pagina de inicio de su aplicacion web, para que esta sea ejecutada cuando se acceda a la url raiz
	*/
	$config['default_controller'] 	= 'user';