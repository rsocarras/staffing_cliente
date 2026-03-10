<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

Yii 2 Basic Project Template is a skeleton [Yii 2](https://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![build](https://github.com/yiisoft/yii2-app-basic/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-basic/actions?query=workflow%3Abuild)

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources


PROJECT CUSTOMIZATION
---------------------

### Modulo: Administracion de planta

Se implemento un modulo completo para visualizar y administrar la planta autorizada por:

- empresa
- sede
- area
- subarea
- cargo

El modulo trabaja en esquema multitenant por `empresa_id` y toma el tenant actual desde el
usuario autenticado. La fuente operativa para calcular ocupacion ya no es `profile`, sino la
nueva tabla `contrato`.

### Alcance funcional implementado

- Dashboard global con KPIs de planta total, ocupados, vacantes, cobertura, sobredotacion,
  sedes con vacantes y sedes sobredotadas.
- Resumen por sede con agrupacion `Sede -> Area -> Subarea -> Cargo`.
- Resumen por area con agrupacion `Area -> Subarea -> Cargo -> Sede`.
- Vista administrativa de planta autorizada con `index`, `create`, `update` y `view`.
- Historial de cambios sobre la planta autorizada.
- Exportacion en Excel y vista imprimible tipo PDF.
- Filtros por region, ciudad, sede, tipo de sede, area, subarea, cargo, cobertura y texto libre.
- RBAC base para `admin_total`, `rrhh`, `operaciones_regionales`, `director_area` y `gerente_sede`.

### Modelo analitico implementado

- `staffing_planta` define la planta autorizada por la combinacion obligatoria:
  `empresa_id + location_sede_id + area_id + sub_area_id + cargo_id`.
- `contrato` define la asignacion laboral vigente del empleado.
- `contrato_distribucion_sede` permite distribuir un contrato entre varias sedes y soporta
  conteo ponderado por porcentaje.
- `staffing_planta_historial` registra cambios de alta, actualizacion, activacion y desactivacion.
- `location_sedes.tipo_sede` clasifica la sede como `operativa` o `administrativa`.

Estados de contrato que ocupan planta:

- `activo`
- `suspendido`
- `licencia`
- `incapacidad`

Estados que no ocupan planta:

- `inactivo`
- `liquidado`
- `cancelado`

Calculos principales:

- `ocupados`:
  - modo `ponderado`: usa `contrato_distribucion_sede` si la suma de porcentajes es 100
  - modo `entero`: usa la `sede_id` principal del contrato
- `vacantes = cantidad_autorizada - ocupados`
- `cobertura = ocupados / planta * 100`
- si `vacantes < 0`, el registro se muestra como sobredotado

### Archivos principales

- `controllers/AdministracionPlantaController.php`
- `services/AdministracionPlantaService.php`
- `models/Contrato.php`
- `models/ContratoDistribucionSede.php`
- `models/StaffingPlanta.php`
- `models/StaffingPlantaHistorial.php`
- `models/search/AdministracionPlantaDashboardSearch.php`
- `models/search/StaffingPlantaSearch.php`
- `views/administracion-planta/*`

### Migraciones agregadas

Aplicar en este orden:

1. `m260310090000_add_tipo_sede_to_location_sedes`
2. `m260310090100_create_contrato_table`
3. `m260310090200_create_contrato_distribucion_sede_table`
4. `m260310090300_create_staffing_planta_tables`
5. `m260310090400_seed_administracion_planta_rbac`
6. `m260310150000_seed_administracion_planta_demo_data`

### Rutas principales

- `/administracion-planta/dashboard`
- `/administracion-planta/resumen-sede`
- `/administracion-planta/resumen-area`
- `/administracion-planta/index`
- `/administracion-planta/historial`

### Como probar el modulo

1. Ejecutar migraciones:

   ```
   php yii migrate/up --migrationPath=@app/migrations
   ```

2. Asignar un rol RBAC con acceso al modulo.
3. Crear o validar sedes, areas, subareas y cargos de la empresa.
4. Registrar planta autorizada en `staffing_planta`.
5. Registrar contratos vigentes en `contrato`.
6. Si aplica distribucion entre sedes, registrar porcentajes en `contrato_distribucion_sede`
   con suma exacta de `100`.
7. Ingresar a las rutas del modulo y validar dashboard, resumenes, CRUD, historial y exportacion.

Datos demo incluidos por el seed:

- 3 sedes seed: 2 operativas y 1 administrativa
- 4 empleados seed con contratos en estado `activo`, `licencia`, `suspendido` e `incapacidad`
- distribucion 50/50 entre sedes para el caso de licencia
- 4 registros de `staffing_planta`
- historial seed para revisar la pestaña de auditoria

### Notas tecnicas

- El proyecto real usa Yii2 con estructura tipo basic y un template administrativo ya integrado.
- El tenant actual se resuelve desde `Profile.empresas_id`.
- El alcance por sede o area se resuelve hoy desde RBAC y apoyo temporal en `Profile`
  (`data_json`, `sede_id`, `area_id`) para permitir evolucion futura a tablas de asignacion.
- La exportacion PDF quedo como vista imprimible HTML porque el proyecto no incluye una
  libreria PDF dedicada.
- La analitica usa la planta capturada manualmente como fuente prioritaria para la dimension
  `area/subarea/cargo` cuando exista inconsistencia con el cargo.


REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.4.


INSTALLATION
------------

### Install via Composer

If you do not have [Composer](https://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](https://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
composer create-project --prefer-dist yiisoft/yii2-app-basic basic
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~

### Install from an Archive File

Extract the archive file downloaded from [yiiframework.com](https://www.yiiframework.com/download/) to
a directory named `basic` that is directly under the Web root.

Set cookie validation key in `config/web.php` file to some random secret string:

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~


### Install with Docker

Update your vendor packages

    docker-compose run --rm php composer update --prefer-dist

Run the installation triggers (creating cookie validation code)

    docker-compose run --rm php composer install

Start the container

    docker-compose up -d

You can then access the application through the following URL:

    http://127.0.0.1:8000

**NOTES:**
- Minimum required Docker engine version `17.04` for development (see [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- The default configuration uses a host-volume in your home directory `.docker-composer` for composer caches


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.


TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](https://codeception.com/).
By default, there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
vendor/bin/codecept run
```

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser.


### Running  acceptance tests

To execute acceptance tests do the following:

1. Rename `tests/acceptance.suite.yml.example` to `tests/acceptance.suite.yml` to enable suite configuration

2. Replace `codeception/base` package in `composer.json` with `codeception/codeception` to install full-featured
   version of Codeception

3. Update dependencies with Composer

    ```
    composer update
    ```

4. Download [Selenium Server](https://www.seleniumhq.org/download/) and launch it:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ```

    In case of using Selenium Server 3.0 with Firefox browser since v48 or Google Chrome since v53 you must download [GeckoDriver](https://github.com/mozilla/geckodriver/releases) or [ChromeDriver](https://sites.google.com/a/chromium.org/chromedriver/downloads) and launch Selenium with it:

    ```
    # for Firefox
    java -jar -Dwebdriver.gecko.driver=~/geckodriver ~/selenium-server-standalone-3.xx.x.jar

    # for Google Chrome
    java -jar -Dwebdriver.chrome.driver=~/chromedriver ~/selenium-server-standalone-3.xx.x.jar
    ```

    As an alternative way you can use already configured Docker container with older versions of Selenium and Firefox:

    ```
    docker run --net=host selenium/standalone-firefox:2.53.0
    ```

5. (Optional) Create `yii2basic_test` database and update it by applying migrations if you have them.

   ```
   tests/bin/yii migrate
   ```

   The database configuration can be found at `config/test_db.php`.


6. Start web server:

    ```
    tests/bin/yii serve
    ```

7. Now you can run all available tests

   ```
   # run all available tests
   vendor/bin/codecept run

   # run acceptance tests
   vendor/bin/codecept run acceptance

   # run only unit and functional tests
   vendor/bin/codecept run unit,functional
   ```

### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```
#collect coverage for all tests
vendor/bin/codecept run --coverage --coverage-html --coverage-xml

#collect coverage only for unit tests
vendor/bin/codecept run unit --coverage --coverage-html --coverage-xml

#collect coverage for unit and functional tests
vendor/bin/codecept run functional,unit --coverage --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.
