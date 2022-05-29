# buzzmn

## Docker
Esta aplicación de Laravel se ha desarrollado utilizando Docker, aunque Docker no resulta un requisito obligatorio para ejecutar la aplicación si se desea utilizar Docker para ejecutarlo necesitamos seguir las siguientes instrucciones:
1. Clonamos el repositorio en local
2. Copiamo el archivo .env.example en .env
3. Añadimos al archivo .env la url y la api key de open weather api al final del archivo.
4. En el direcotorio raíz ejecutamos: 
```
docker run --rm --interactive --tty -v $(pwd):/app composer install
```

El último paso instalará todas las dependencias. Para inicar el contenedor con la aplicación nos ubicamos en el directori oraíz y ejecutamos: 

```bash
./vendor/bin/sail -d
```

## Composer y npm
Al clonar el repositorio es necesario instalar todas las dependencias de node y composer.

Para instalar dependencias de node ejecutamos; `npm install`
Para instalar dependencias de composer (sólo si no estamos utilizando Docker, en ese caso seguimos las intrucciones del apartado Docker de más arriba): `composer install`

## Test
En el proyecto se incluyen ua serie de tests.
- Tests para validar que en e archivo .env hemos definido api key de la api de open weather y la dirección url de la api.
- Tests para validar que al consultar la previsión meteorologica para Manresa la api nos devuelve una respuesta con código 200.
- Test para validar que al cargar la ruta '/' Laravel devuelve respuesta http 200.

Para ejecutar los tests:
```bash
php artisan test
```

Con Docker:
```bash
./vendor/bin/sail artisan test
```

## Configuración openweather

En `config/openweather.php` se ha creado un archivo de configuaración para establecer la url base de la api de open weather y la api key. Estos valores se definen en el archivo .env pero dentro de la aplicación se leen desde el archivo de configuración.

## Http Client Macro
Para gestionar las peticiones contra la api de open weather y el úso de las credenciales se ha definido una macro que contiene la url de la api y la api key que hay que utilizar en todo momento. De esta manera sólo tenemos que ejecutar la Macro pasando por parametro la query string. En caso de error siempre se relizarán 3 intentos dejando 200 milisegundos de margen entre cada intento.

La Macro se ha definido en el `app/providers/AppServiceProvider.php` dentro del método `boot()`:

```php
public function boot()
    {
        Http::macro('openweather', function ($options) {

            $url = config('openweather.url');
            $apikey = config('openweather.appid');

            $options = array_merge($options, ['appid' => $apikey, 'lang' => 'es', 'units' => 'metric']);
            return Http::retry(3, 200)
                ->baseUrl($url)
                ->withOptions(['query' => $options])
                ->acceptJson();
        });
    }
```

Entonces, al ejecutar desde el controlador:

```php
public function show(Request $request)
    {

        $params = $request->all();

        return Http::openweather($params)->get('/data/2.5/weather')->throw()->json();
    }
```

Sólo tenemos que indicar el recurso de la api y la query string que recibimos del frontend. 

## Frontend

En el frontend se ha definido un vista que contiene un formulario para indicar el código postal y un selector para seleccionar el país al que pertenece el código postal.

Se ha creado un script js `weather.js` que al hacer submit en el formulario recoge los datos introducidos, realiza una petición al backend de Laravel y muestra el resultado por pantalla.