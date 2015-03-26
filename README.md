# mvc framework (silvercoding)
>desarrollado por: Carlos Herrera Plata

##Primer uso

###Instalando el framework
Una vez descargado el repositorio de manera local, tendremos que copiar el contenido en el directorio donde se desarrollar usando el framework.

Dentro del framework encontraremos la siguiente estructura de directorios:

<ul>
		<li>aplication</li>
		<li>public</li>
		<li>system</li>
		<li>.htaccess *</li>
		<li>index.php *</li>
</ul>

Donde el directorio <strong>aplication</strong> contiene la estructura de desarrollo, donde se crearan los controladores, modelos y vistas de su aplicación web.

El directorio <strong>public</strong> es un directorio destinado a contener archivos y directorios de tipo assets (css, js, imagenes, etc...), estos tipos de archivos jamas deben ser colocados en el directorio aplication.

El directorio <strong>system</strong> es donde se alojan las clases que dan vida al framework, este directorio no debe ser modificado, a menos que usted quiera modificar el funcionamiento interno del framework.

Los archivos <strong>.htaccess</strong> e <strong>index.php</strong> son archivos necesarios para el funcionamiento del framework.

===

###Configurando el framework por primera vez
Antes de empezar el desarrollo de su aplicacion web es necesario configurar el framework para su correcto funcionamiento.

Primero deberemos abrir el archivo <strong>.htaccess</strong> ubicado en la raíz del directorio; en el encontrara la siguiente linea:

```
  RewriteBase /mvc/
```

Esta linea debe ser modificada con el directorio donde se aloja su framework.
tomando el ejemplo que el framework ha sido instalado en el directorio raiz de tu servidor `archivos/silvercoding` la linea debera verse como sigue:

```
  RewriteBase /archivos/sivercoding/
```
Esto con el objetivo de que el ruteo manual sea mas comodo para usted. y cada vez que quiera llamar alguna ruta dentro de su aplicación web no tenga que escribir la ruta completa de donde se encuentra su archivo.

===

Como segundo paso se debera configurar el archivo `config.php` en ella debera editar las varibales que estan puestas para que sea copatible con su aplicación.
Dentro del archivo ya vienen descritas lo qe cada variable significa.

===

A continuación de manera adicional (en caso de que use base de datos) debera configurar el archivo `database.php` para que pueda conectarse con la base de datos que usted desee.
Si quiere saber sobre mas opciones de configuración de base de datos acceda a la [documentacion](#).

===

Con esto el framework estara configurado y listo para poder ser usado.

===

##Manejo de rutas del framework
Para aprender a desarrollar en el framework es necesario conocer como este maneja las rutas para acceder a controladores por metodos y variables.

El acceso a los controladores del framework esta sujeto a la url que su aplicación obtenga del navegador
De la forma siguiente:

``www.mypage.com/mycontroller/method/param1/param2/param3/...``

Una url tipica del framework podria ser:

``` www.mypage.com/user/login/username/password  ```

Porsupuesto enviar informacion sensible via url (o via get) no es lo optimo, pero a motivos de ejemplo, esto sera omitido.

Pasemos a diseccionar la url anterior, tomando los elementos que estan separados por `/`

Tipo de elemento|Elemento  | Significado
------------- | ------------- | -------------
1|``www.mypage.com`` | es la url raiz de nuestra aplicación, en caso de que la url solo contenga este elemento el framework intentara llamar al controlador default por el metodo default `action()` que se halla configurado en el archivo `config.php`.
2|``user`` | user hace referencia a un controlador, con el mismo nombre de clase que se indica en la url si la url se corta sobre este contenido, entonces se llamara al metodo default `action()` del controlador `user`.
3|``login`` | login hace referencia a un metodo `login()` existente dentro de la clase controlador `user`.
4|``username/password`` | el resto de los elementos de la url haran referencia a variables que seran pasadas al metodo que se quiera llamar. <br> De modo que en este ejemplo se llamara a: `login($username, $password)` metodo contenido en la clase controlador `user`

Es importante que **evitemos** pasar parametros por el metodo `GET` ya que estos modifican la url, y podria causar errores en nuestra aplicación, en vez de eso, los parametros por get deberan ser enviados por url como elementos del tipo 4.

##Creando nuestra primera aplicación
El **Objetivo** de nuestra aplicación sera el listado e insertado de usuarios en una base de datos.

Antes de empezar es necesario crear una base de datos para poder ser usada en nuestro framework. Se puede usar el siguiente sql:

```
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` text NOT NULL,
  `lastname` text NOT NULL,
  `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```

Ahora que tenemos la base de datos, y tener configurada nuestro framework, es hora de comenzar a desarrollar nuestro framework.

###Creando el primer controlador
Se creara un controlador llamado `user` en el directorio `aplication/controller/`, este debe extender del controlador base del framework `core_controller` para que pueda ser usado por el framework.

```
class user extends core_controller {
    function __construct(){}
}
```
Una vez creado nuestro controlador seria bueno definirlo como nuestro controlador default de nuestra aplicación para esto, nos vamos al archivo `config.php` y modificamos la variable `default_controller` con el nombre de nuestro controlador.
de modo que deberia quedar de la forma:

```
$config['default_controller'] 	= 'user';
```

Como ya se ha mencionado antes, silercoding, usa un metodo default para ser llamado en caso de que solo se defina el controlador en la url.
Este metodo es llamado `action()` y debe ser definido en nuestra clase:

```
class user extends core_controller {
    function __construct(){}`
    
    function action(){
      echo "hello world"
    }
}
```

Ahora mismo usted puede ejecutar su aplicación web y debera ver en su navegador un mensaje:
`hello world`

###creando el primero modelo
A continuacion crearemos el modelo que nos permitira acceder a la base de datos de nuestros usuarios.
Nos dirigiremos al directorio `aplication/model` y crearemos una nueva clase de modelo `muser` que extiende de la clase `core_model` de nuestrio framework.

```
class muser extends core_model {
  function __construct(){
    parent::__construct();
  }
}
```
Nuestro framework por defecto conecta a nuestra base de datos cada vez que se crea un nuevo modelo y esta coneccion puede ser accedida mediante la variable `db` de nuestra clase modelo.

A continuacion crearemos un metodo en nuestro modelo para obtener todos los usuarios registrados en la tabla `user` (No se olvide de insertar algun valor en su tabla).

```
class muser extends core_model {
  function __construct(){
    parent::__construct();
  }

  function getUsers(){
    return $this->db->get('users');
  }
}
```

En el metodo anterior usamos los metodos **active record** que pueden ser invocados desde nuestra variable de acceso a base de datos, en este ejemplo concreto usaremos el metodo `get($tableName)`
El cual ejecuta una sentencia similar a:

´SELECT * FROM users´

Para saber mas acerca de la variable `db` y los metodos **active record** consulte la [documentacion](#).

ahora para mostrarle los datos al usuario hay que llamar nuestro modelo desde nuestro controlador `usuario`, para esto usaremos un metodo interno del framework desde nuestro controlador.

EL metodo e: `load_model($modelName)`, este metodo carga un modelo en nuestra clase controlador, que luego podra ser accedida como variable local llamandola por el nombre del metodo.
De este modo si nuestro modelo se llama `muser` lo llamamos por medio del metodo `load_model('muser')`, y luego desde nuestro controlador podremos llamarlo como `$this->muser`.

Aqui el ejemplo para imprimir los usuarios.

```
class user extends core_controller {
    function __construct(){}`

    function action(){
      $this->load_model('muser');
      $users = $this->muser->getUsers();
      
      foreach($user as $row){
        echo $row['name'].'<br>';
      }
    }
}
```

De esta manera si accedemos a nuestra aplicación y todo ha salido de manera correcta, deberiamos encontrarnos con un listado de los nombres de los usuarios en nuestra base de datos.

###Creando una vista
Nuestro framework esta enfocado para separar no solo el codigo en una estructura MVC si no tambien tratar de desligar el codigo HTML usada en la vista con la logica de php usada en el controlador.
De modo que las vistas en nuestro controlador no necesitan extender ni usar codigo `php` a menos que sea necesario para mostrar contenido de forma dinamica.

De esta forma vamos a crear un nueva vista en nuestro directorio `aplication/view/` nuestro archivo se llamara `user_view.php`, recalcamos aunque nuestras vistas sean archivos `php` para el uso de estas en el framework nuestra vista puede no contener ninguna sentencia `php` y solo `html`.

nuestro archivo `user_view.php` contendra:

```
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>my page</title>
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Usuario</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </body>
  </html>
```

Una simple vista que contiene una tabla para poder visualizar nuestros usuarios en la base de datos.
Para poder visualizarlos nos vamos a nuestro controlador `user` y usamos un metodo similar al que utilizamos para cargar un modelo, usaremos el metodo `load_view($viewName, $data)`, al cargar una vista de este modo, se mostrara automaticamente en pantalla.

lo llamaremos desde nuestro controlador entonces:

```
class user extends core_controller {
    function __construct(){}

    function action(){
      $this->load_model('muser');
      $users = $this->muser->getUsers();
      
      //cargando una vista para mostrarla
      $this->load_view('users_view', array());
    }
}
```

Si probamos en este punto nuestra aplicacion, podremos ver que al ejecutarla ya se puede apreciar nuestra pequeña vista, pero en este momento no hemos mandado ningun usuario a la vista para poder mostrarlo.

Para eso, haremos uso del segundo parametro de nuestro metodo `load_view()` el parametro `$data` es un arreglo que contiene los diferentes datos que han de ser pasados a la vista en forma de variables.
este parametro es un array asociativo de la forma:
```
array('key' => value);
```
Al pasar dicho array como segundo parametro a nuestra vista, luego puede ser invocada desde la misma en forma de variable.
```
echo $key
```

resultado:

```
value
```

de este modo, vamos a pasar nuestros usuarios a la vista para ser listados en la tabla que hemos creado:

```
class user extends core_controller {
    function __construct(){}

    function action(){
      $this->load_model('muser');

      $data =  array();
      $data['users'] = $this->muser->getUsers();
      
      //cargando una vista para mostrarla
      $this->load_view('users_view', $data);
    }
}
```


y nuestra vista luego podemos mostrar los usuarios de la siguiente forma:

```
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>my page</title>
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Usuario</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $line): ?>
          <tr>
            <td> <?php echo $line['name'] ?> </td>
            <td> <?php echo $line['lastname'] ?> </td> 
            <td> <?php echo $line['user'] ?> </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </body>
  </html>
```

Al ejecutar nuestra aplicacion ya se debera poder ver nuestros usuarios registrados en la base de datos.
De esta forma dinamica hemos podido comprender la transicion y flujo de nuestra aplicacion

Pero que pasa si queremos mantener nuestra aplicacion web con una estructura en las vistas definida, que todas mantengan el mismo estilo visual y en concreto usen una plantilla.

Silvercoding tiene la facilidad de cargar vistas de manera asyncrona, es decir de guardar una vista en una variable y luego poder pasarla como parametro a otra vista, para ser usada.

De este modo podemos cargar diferentes estructuras de vistas en una sola plantilla.

Tomemos como ejemplo nuestra vista anterior separemos nuestra vista en dos archivos, en este caso vamos a crear un nuevo directorio llamado `templates` (esto es opcional y a manera de mostrar como silvercoding maneja directorios), en nuestro directorio de vistas `aplication/view/templates/`

Dentro crearemos una nueva vista llamada `template.php` la cual contendra solo el esqueleto basico de una pagina html.

`template.php`
```
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>my page</title>
  </head>
  <body>
    
  </body>
  </html>
```

y modificamos nuestra vista `users_view.php` para que solo contenga el cuerpo de la vista:

`users_view.php`
```
  <tbody>
    <?php foreach ($users as $line): ?>
      <tr>
        <td> <?php echo $line['name'] ?> </td>
        <td> <?php echo $line['lastname'] ?> </td> 
        <td> <?php echo $line['user'] ?> </td>
      </tr>
    <?php endforeach ?>
  </tbody>
```

ahora vamos nuestro controlador, y empecemos a trabajar.
En primer lugar habra que crear una variable a la que llamaremos `body` la cual contendra el cuerpo de nuestra vista.
Aqui volveremos a usar nuestro metodo `load_view()` pero esta vez le añadiremos un tercer parametro.
`load_view($viewName, $data, $asynLoad)`
el parametro `$asyncLoad` es un booleano, cuando esta definido en `true` realizara una carga asincrona de la vista, de manera que nuestra vista no sera mostrada en pantalla si no, retornada a manera de variable.
Ahora almacenaremos esta vista en nuestra variable `$body`.


```
class user extends core_controller {
    function __construct(){}

    function action(){
      $this->load_model('muser');

      $data =  array();
      $data['users'] = $this->muser->getUsers();
      
      //cargando una vista de manera asincrona
      $body = $this->load_view('users_view', $data, true)
    }
}
```

si ejecutamos nuestra aplicacion web en este momento notaremos que no aparecera nada en pantalla, ya que la vista no ha sido cargada en pantalla, si no que devuelta en forma de variable.
Sin embargo si somos curiosos y hacemos:

```
class user extends core_controller {
    function __construct(){}

    function action(){
      $this->load_model('muser');

      $data =  array();
      $data['users'] = $this->muser->getUsers();
      
      //cargando una vista de manera asincrona
      $body = $this->load_view('users_view', $data, true)

      echo $body;     //<----------
    }
}
```

ahora podremos ver el contenido de nuestra vista, debido a que hemos llamado a nuestra variable que la contenia, para que se muestre en pantalla.

Ahora crearemos un nuevo arreglo `$dataTemplate` donde añadiremos nuestra vista:

```
class user extends core_controller {
    function __construct(){}

    function action(){
      $this->load_model('muser');

      $data =  array();
      $data['users'] = $this->muser->getUsers();
      
      //cargando una vista de manera asincrona
      $body = $this->load_view('users_view', $data, true)

      $dataTemplate = array();
      $dataTemplate['body'] = $body;
    }
}
```

Ahora solo faltara cargar la vista del template y mandarle `$dataTemplate` para que el template pueda tener acceso a la variable `$body`

```
class user extends core_controller {
    function __construct(){}

    function action(){
      $this->load_model('muser');

      $data =  array();
      $data['users'] = $this->muser->getUsers();
      
      //cargando una vista de manera asincrona
      $body = $this->load_view('users_view', $data, true)

      $dataTemplate = array();
      $dataTemplate['body'] = $body;

      $this->load_view('templates/template', $dataTemplate);
    }
}
```

Solo faltaria hacer unos ajustes a nuestra vista `template.php` para poder mostrar el cuerpo que se contiene en la variable `$body`

`template.php`
```
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>my page</title>
  </head>
  <body>
    <?php echo $body; ?>
  </body>
  </html>
```

de este modo hemos logrado cargar multiples vistas y que al final se vean reflejadas en una sola template, jugando con estos metodos podriamos hacer cosas como:

`template.php`
```
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>my page</title>
  </head>
  <body>
    <?php echo $header; ?>

    <?php if ($isIndex): ?>
      <?php echo $bannerSection; ?>
    <?php endif ?>

    <?php echo $body; ?>

    <?php echo $footer; ?>
  </body>
  </html>
```

Ahora mostraremos como quedarian las vistas si combinamos todos los metodos que hemos visto, para hacer un insert de un nuevo usuario y refactorizar el codigo de manera mas optima:

**modelo**
`muser.php`
```
class muser extends core_model {

  function __construct(){
    parent::__construct();
  }

  function getUsers(){
    return $this->db->get('users');
  }

  function insertUser($name, $lastname, $user){
    $data = array();
    $data['name'] = $name;
    $data['lastname'] = $lastname;
    $data['user'] = $user;

    $this->db->insert('users',$data);
  }

  
}
```

**controlador**
`user.php`
```
  class user extends core_controller {

    function __construct() {
         $this->data['css'] = array('public/famous/css/famous.min.css', 'public/css/login.css' );
         $this->load_model('muser');
     }

    function action(){
      $data['users'] = $this->muser->getUsers();
      $this->data['content'] = $this->load_view('users_view', $data, true);
      $this->load_view('templates/template', $this->data);
    }

    function insert(){
      if ( isset($_POST['username']) ) {
        $username = $_POST['username'];
        $name     = $_POST['name'];
        $lastname = $_POST['lastname'];

        $this->load_model('muser');
        $this->muser->insertUser($name, $lastname, $username);

        $this->redirect('user');

      } else {
        $this->data['content'] = $this->load_view('insert_view', array(), true);
        $this->load_view('templates/template', $this->data);
      }
    }
  }
```

**vistas**
`template.php`
```
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>esta cosa funca</title>
  <?php foreach ($css as $value): ?>
    <link rel="stylesheet" href="<?php echo 'http://localhost/mvc/'.$value ?>">
  <?php endforeach ?>
</head>
<body>
  <div class="container">
    <?php echo $content; ?>
  </div>
</body>
</html>
```

`user_view.php`
```
    <div class="row vertical-offset-100">
      <div class="col-md-12" style="background: white;">
          <div class="row">
            <div class="col-md-9">
              <a href="user/insert" class="btn btn-default">Insertar nuevo</a>
            </div>
          </div>
        <table class="table">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Usuario</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $line): ?>
              <tr>
                <td> <?php echo $line['name'] ?> </td>
                <td> <?php echo $line['lastname'] ?> </td> 
                <td> <?php echo $line['user'] ?> </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
  </div>
```

`insert_view.php`
```
    <div class="row vertical-offset-100">
      <div class="col-md-12" style="background: white; padding: 50px;">
        <form action="user/insert" class="form-control" method="POST">
          <div class="row" style="margin-top: 10px;">
                     <div class="col-md-12"><input type="text" name="name" placeholder="name" class="form-control"></div>
                 </div> 
                <div class="row" style="margin-top: 10px;">
                     <div class="col-md-12"><input type="text" name="lastname" placeholder="lastname" class="form-control"></div>
                 </div>
                <div class="row">
                     <div class="col-md-12"><input type="text" name="username" placeholder="username" class="form-control"></div>
                 </div>
                 <div class="row" style="margin-top: 10px;">
                     <div class="col-md-1"><input type="submit" value="insertar" class="btn btn-success"></div>
                     <div class="col-md-1"><a href="user" class="btn btn-warning">Cancelar</a>
                 </div>
        </form>
      </div>
  </div>
```









