*INSTRUCCIONES DE DESPLIEGUE*

Configuraciones

•	Al no estar utilizando un motor de Datos relacional
•	Es importante tener en cuenta la configuración ya escrita para el uso de la misma que esta realizada

*SQL LITE*

```
'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('db_trycore.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],
```

*COMANDOS A EJECUTAR*

1.	Git clone https://github.com/gespitia/test-trycore-frontend
2.	composer install
3.	php aritasn server
4.	php artisan migrate --seed(si queremos utilizar esta opción para hacer pruebas)


*PROBLEMATICA A RESOLVER*

Se requiere construir una aplicación que le permita al usuario identificar los planetas y
personas registrados en la base de datos., y la relación que hay entre sí (Modelo relacional),
para efectos de estadísticas y control, teniendo en consideración las siguientes
características:
● Un planeta puede ser habitado por muchas personas.
● Una persona solamente puede habitar un planeta a la vez.
● Tanto los planetas como las personas, deben contar con un campo “contador”, para
conocer la cantidad de visitas de cada registro.
La aplicación debe contemplar los siguientes características / funcionalidade

Se crearon las tablas Planetas y Personas

Con los campos que se pueden apreciar en la aplicación

Planetas
    
    id: bint(20)
    nombre: varchar(25)
    periodo_rotacion: int(11)
    diametro: int(11)
    clima: varchar(50)
    terreno: varchar(50)
    masa: int(11)
    radio_orbital: int(11)
    contador: int(11)
    deleted_at: timestamp
    created_at: timestamp
    updated_at: timestamp
    
Personas
    
    id: bint(20)
    nombres: varchar(25)
    apellidos: varchar(25)
    diametro: int(11)
    no_identidad: bigint(20)
    edad: int(10)
    peso: int(10)
    altura: int(10)
    genero: varchar(10)
    fecha_nacimiento: date
    planeta_id:bigint(20)
    contador: int(11)
    deleted_at: timestamp
    created_at: timestamp
    updated_at: timestamp
    
    
  Se establecen las relacion entre la tabla persona y planeta que ya esta citada en el ejercicio.
  
  Se crearon las migraciones de esas entidades, en sql lite
  se crearon los respectivos controladores, de las tablas
  
  *PersonaController*
  *PlanetaController*
  
    
    
    
    
    
    


