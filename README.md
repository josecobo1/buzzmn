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
