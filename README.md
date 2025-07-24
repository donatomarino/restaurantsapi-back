# Restaurants API

API RESTful desarrollada en Laravel para la gestión de restaurantes.

## Requisitos

- Docker y Docker Compose
- (Opcional) PHP >= 8.2 y Composer si deseas ejecutar localmente sin contenedores

## Instalación y ejecución con Docker

1. **Clona el repositorio:**
   ```bash
   git clone https://github.com/tu-usuario/restaurantsapi-back.git
   cd restaurantsapi-back
   ```

2. **Construye la imagen y levanta el contenedor:**
   ```bash
   docker build -t restaurantsapi-back .
   docker run -p 8080:80 --env-file .env restaurantsapi-back
   ```
   > El contenedor expone el puerto 80. Puedes acceder a la API en [http://localhost:8080](http://localhost:8080).

3. **Configuración de entorno:**
   - El archivo `.env` se genera automáticamente a partir de `.env.example` en el build del contenedor.
   - Modifica las variables de entorno según tu configuración de base de datos y otros servicios.

## Endpoints principales

Consulta la documentación Swagger para ver todos los endpoints disponibles.

## Documentación Swagger

La documentación interactiva de la API está disponible en:

```
http://localhost:8080/api/documentation
```

> Esta ruta es generada por el paquete `l5-swagger`. Si cambias el puerto o la configuración, ajusta la URL en consecuencia.

## Estructura del proyecto

- `app/` - Lógica de negocio y modelos
- `routes/` - Definición de rutas de la API
- `config/` - Configuración de servicios y paquetes
- `public/` - Punto de entrada de la aplicación (Apache sirve este directorio)
- `storage/` y `bootstrap/cache/` - Directorios con permisos de escritura para Laravel

## Comandos útiles

- **Instalar dependencias:**  
  Se ejecuta automáticamente en el build del contenedor con Composer.
- **Generar clave de la aplicación:**  
  Se ejecuta automáticamente (`php artisan key:generate`).
- **Optimizar configuración y rutas:**  
  Se ejecuta automáticamente (`php artisan config:cache && php artisan route:cache && php artisan view:cache`).

## Notas de seguridad

- Los permisos de los directorios `storage` y `bootstrap/cache` se configuran para permitir escritura por el usuario de Apache.
- Revisa y ajusta las variables sensibles en `.env` antes de desplegar en producción.

## Autor

Donato Marino