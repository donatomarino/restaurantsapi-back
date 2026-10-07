# 🍽️ Restaurant API - Back

Una API RESTful desarrollada en Laravel para la gestión de restaurantes. Incluye operaciones CRUD completas, autenticación con Laravel Sanctum, documentación automática con Swagger y pruebas automatizadas.

## 🚀 Despliegue en Render.com
- **URL:** https://restaurantsapi-back-1.onrender.com

## 📋 Características

- ✅ **CRUD completo** de restaurantes (Crear, Leer, Actualizar, Eliminar)
- 🔐 **Autenticación segura** con Laravel Sanctum y **Rate Limiting** para proteger la API
- 📝 **Validación de datos** con mensajes personalizados
- 📚 **Documentación automática** con Swagger/OpenAPI
- 🧪 **Tests automatizados** con PHPUnit
- 🗄️ **Base de datos** desplegada en Amazon RDS
- 🐳 **Containerización** con Docker
- 🎨 **Frontend** desarrollado en React
- 🛡️ **Manejo centralizado de excepciones**
- 📱 **Validación avanzada de teléfonos españoles**

## 📊 Arquitectura y Diagramas

### Diagrama de Secuencia - Proceso de Autenticación
![Diagrama de Login](./docs/diagrama_secuencia_login.png)

Este diagrama ilustra el flujo completo de autenticación implementado con Laravel Sanctum, incluyendo:

- ✅ Validación de campos obligatorios

---

He mantenido la sección breve y alineada con tu ejemplo; ajusto cualquier detalle si quieres otro nombre de BD o usar PostgreSQL por defecto.
│       ├── UserSeeder.php               # Seeder de usuarios
│       └── RestaurantSeeder.php         # Seeder de restaurantes
├── docs/
│   └── diagrama_secuencia_login.png     # Diagrama de autenticación
├── public/
│   ├── index.php                        # Punto de entrada
│   └── docs/                            # Documentación Swagger generada
├── routes/
│   ├── api.php                          # Rutas de la API
│   ├── web.php                          # Rutas web
│   └── console.php                      # Comandos Artisan
├── storage/
│   ├── app/
│   │   ├── public/
│   │   └── private/
│   ├── framework/
│   │   ├── cache/
│   │   ├── sessions/
│   │   └── views/
│   └── logs/
│       └── laravel.log                  # Logs de la aplicación
├── tests/
│   ├── Feature/
│   │   ├── ApiTest.php                  # Tests CRUD de restaurantes
│   │   └── LoginTest.php                # Tests de autenticación
│   ├── Unit/
│   ├── TestCase.php                     # Clase base para tests
│   └── CreatesApplication.php           # Helper para tests
├── vendor/                              # Dependencias de Composer
├── .env.example                         # Variables de entorno de ejemplo
├── .env                       ∫          # Variables de entorno (no versionado)
├── .gitignore                           # Archivos ignorados por Git
├── artisan                              # CLI de Laravel
├── composer.json                        # Dependencias y scripts PHP
├── composer.lock                        # Lock de versiones exactas
├── Dockerfile                           # Imagen Docker
├── phpunit.xml                          # Configuración de tests PHPUnit
└── README.md                            # Este archivo
```
```

### Instalación local

## 1. Requisitos del sistema

- PHP 8.1 o superior
- Node.js 18 o superior
- MySQL 8.0 o superior (o PostgreSQL/SQLite)
- Composer
- npm (incluido con Node.js)

---

## 2. Preparación del proyecto

1. Clona el proyecto:

```bash
git clone https://github.com/donatomarino/restaurantsapi-back.git
cd restaurantsapi-back
```

---

## 3. Instalación del Backend (Laravel)

### 3.1 Acceder al backend

```bash
cd restaurantsapi-back
```

### 3.2 Instalar dependencias

```bash
composer install
```

### 3.3 Crear archivo `.env`

```bash
cp .env.example .env
```

### 3.4 Configurar el archivo `.env`

Abre `.env` y asegúrate de que los valores principales estén así (ajusta nombres según tu DB):

```
APP_NAME=RestaurantsAPI

APP_ENV=local

APP_DEBUG=true

APP_URL=http://localhost

DB_CONNECTION=pgsql

DB_HOST=127.0.0.1

DB_PORT=5432

DB_DATABASE=restaurantsapi

DB_USERNAME=postgres

DB_PASSWORD=
```

Notas importantes:

- Si usas MySQL y tiene contraseña, colócala en `DB_PASSWORD=`.
- Si prefieres MySQL, cambia `DB_CONNECTION=mysql` y ajusta `DB_PORT=3306`, `DB_USERNAME=root` y `DB_PASSWORD`.

### 3.5 Generar clave de aplicación

```bash
php artisan key:generate
```

### 3.6 Ejecutar migraciones y seeds

```bash
php artisan migrate --seed
```

Si la base de datos no existe, créala con tu cliente SQL o herramienta del sistema antes de ejecutar `migrate`.

### 3.7 Crear enlace simbólico de almacenamiento

```bash
php artisan storage:link
```

### 3.8 Iniciar servidor del backend

```bash
php artisan serve
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






