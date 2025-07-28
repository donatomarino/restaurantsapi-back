# 🍽️ Restaurant API - Back

Una API RESTful desarrollada en Laravel para la gestión de restaurantes. Incluye operaciones CRUD completas, autenticación con Laravel Sanctum, documentación automática con Swagger y pruebas automatizadas.

## 📋 Características

- ✅ **CRUD completo** de restaurantes (Crear, Leer, Actualizar, Eliminar)
- 🔐 **Autenticación segura** con Laravel Sanctum
- 📚 **Documentación automática** con Swagger/OpenAPI
- 🧪 **Tests automatizados** con PHPUnit
- 🗄️ **Base de datos** desplegada en Amazon RDS
- 🐳 **Containerización** con Docker
- 🎨 **Frontend** desarrollado en React

## 📊 Arquitectura y Diagramas

### Diagrama de Secuencia - Proceso de Autenticación
![Diagrama de Login](./docs/diagrama_secuencia_login.png)

Este diagrama ilustra el flujo completo de autenticación implementado con Laravel Sanctum, incluyendo:

- ✅ Validación de campos obligatorios
- ✅ Verificación de credenciales en base de datos
- ✅ Generación de tokens seguros
- ✅ Manejo de errores (422, 401)
- ✅ Respuestas JSON estructuradas

### 📖 Documentación de la API
La documentación completa con Swagger está disponible en:
https://restaurantsapi-back-1.onrender.com/api/documentation

#### 🔐 Autenticación Requerida
Para realizar llamadas a la API protegida, primero necesitas obtener un token de autenticación:

**Credenciales de prueba:**
- **Email:** `donato@wewelcome.com`
- **Password:** `wewelcome2025`

### 📞 Validación de Teléfonos
Se ha implementado validación avanzada de números de teléfono usando el paquete `propaganistas/laravel-phone`:

```php
'phone' => 'required|phone:ES'
```

**Formatos soportados:**
- ✅ **España (ES):** `+34 915 123 456`, `957 71 9926`, `982 883878`

## 📁 Estructura del Proyecto

```
restaurantsapi-back/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php       # Controlador de autenticación
│   │   │   └── RestaurantController.php # Controlador de restaurantes
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   │   ├── Restaurant.php               # Modelo de restaurante
│   │   └── User.php                     # Modelo de usuario
│   └── Providers/
├── bootstrap/
│   └── cache/                           # Cache de Laravel
├── config/
│   ├── auth.php                         # Configuración de autenticación
│   ├── cors.php                         # Configuración CORS
│   ├── database.php                     # Configuración de base de datos
│   └── sanctum.php                      # Configuración de Sanctum
├── database/
│   ├── factories/
│   │   ├── RestaurantFactory.php        # Factory de restaurantes
│   │   └── UserFactory.php              # Factory de usuarios
│   ├── migrations/
│   │   ├── create_users_table.php       # Migración de usuarios
│   │   ├── create_restaurants_table.php # Migración de restaurantes
│   │   └── create_personal_access_tokens_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php           # Seeder principal
│       ├── UserSeeder.php               # Seeder de usuarios
│       └── RestaurantSeeder.php         # Seeder de restaurantes
├── public/
│   └── index.php                        # Punto de entrada
├── routes/
│   ├── api.php                          # Rutas de la API
│   └── web.php                          # Rutas web
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/                            # Logs de la aplicación
├── tests/
│   ├── Feature/
│   │   ├── ApiTest.php                  # Tests CRUD de restaurantes
│   │   └── LoginTest.php                # Tests de autenticación
│   └── Unit/
├── vendor/                              # Dependencias de Composer
├── .env.example                         # Variables de entorno de ejemplo
├── .gitignore
├── composer.json                        # Dependencias PHP
├── Dockerfile                           # Imagen Docker
├── phpunit.xml                          # Configuración de tests
└── README.md                            # Este archivo
```

## 🏗️ Instalación

### Con Docker

```bash
# Clonar el repositorio
git clone https://github.com/donatomarino/restaurantsapi-back.git
cd restaurantsapi-back

# Configurar variables de entorno
cp .env.example .env
# Editar .env con tus configuraciones de base de datos

# Construir imagen
docker build -t laravel-apirestaurants:1.0.0 .

# Ejecutar contenedor
docker run -d \
  --name restaurant-api \
  -p 8000:80 \
  --env-file .env \
  laravel-apirestaurants:1.0.0

# Generar APP_KEY (OBLIGATORIO)
docker exec restaurant-api php artisan key:generate

# Ejecutar migraciones y seeders
docker exec restaurant-api php artisan migrate --seed
```

## 🧪 Testing

### Ejecutar todos los tests
```bash
# Local
php artisan test

# Con Docker
docker exec -it restaurantsapi-back php artisan test
```

### Tests incluidos
- ✅ **Autenticación:** Login exitoso, credenciales inválidas, validaciones
- ✅ **Restaurantes CRUD:** Crear, listar, actualizar, eliminar
- ✅ **Validaciones:** Campos obligatorios, duplicados, formatos
- ✅ **Autorización:** Acceso sin token, tokens inválidos
- ✅ **Errores:** Manejo de errores 404, 422, 500

## 🗄️ Base de Datos

### Amazon RDS
- **Motor:** MySQL 8.0
- **Instancia:** db.t3.micro (Free Tier)
- **Almacenamiento:** 20GB SSD
- **Backup:** Automático (7 días)
- **Multi-AZ:** Habilitado para alta disponibilidad

## 🛡️ Notas de Seguridad

- ✅ **Autenticación:** Laravel Sanctum con tokens seguros
- ✅ **Validación:** Validación de entrada en todos los endpoints
- ✅ **CORS:** Configurado para dominios específicos
- ✅ **Permisos:** Los directorios `storage` y `bootstrap/cache` configurados para Apache
- ✅ **Variables sensibles:** Revisar y ajustar las variables en `.env`

## 👨‍💻 Autor

**Donato Marino**






