# Overskull API — Backend Laravel

API REST para gestión de productos y categorías. Prueba técnica Full Stack.

## Requisitos Previos

- **PHP** >= 8.3
- **Composer** >= 2.x
- **MySQL** >= 8.0
- **Laragon** (recomendado) o cualquier servidor local con PHP y MySQL

## Instalación

```bash
# 1. Clonar el repositorio
git clone <url-del-repo> laravel-api
cd laravel-api

# 2. Instalar dependencias
composer install

# 3. Copiar archivo de entorno y configurar
cp .env.example .env

# 4. Generar llave de la aplicación
php artisan key:generate

# 5. Configurar la base de datos en .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=overskull_db
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Crear la base de datos
mysql -u root -e "CREATE DATABASE IF NOT EXISTS overskull_db"

# 7. Ejecutar migraciones y seeders
php artisan migrate:fresh --seed

# 8. Generar documentación Swagger
php artisan l5-swagger:generate

# 9. Levantar el servidor
php artisan serve
```

## Instalación con Docker

```bash
# 1. Clonar el repositorio
git clone <url-del-repo> laravel-api
cd laravel-api

# 2. Copiar y configurar variables de entorno para Docker
cp .env.example .env
# Editar .env:
# DB_HOST=mysql
# DB_USERNAME=overskull
# DB_PASSWORD=secret

# 3. Levantar los contenedores (PHP + MySQL + Nginx)
docker-compose up -d

# 4. Instalar dependencias dentro del contenedor
docker-compose exec php composer install

# 5. Ejecutar migraciones y seeders
docker-compose exec php php artisan migrate:fresh --seed

# 6. Generar Swagger
docker-compose exec php php artisan l5-swagger:generate
```

La API estará disponible en `http://localhost:8000`.

## URLs Principales

| Recurso | URL |
|---|---|
| API Base | `http://localhost:8000/api` |
| Swagger UI | `http://localhost:8000/api/documentation` |
| Swagger Alias | `http://localhost:8000/api/docs` |
| Laravel Telescope | `http://localhost:8000/telescope` |

## Endpoints de la API

### Categorías

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/categories` | Listar todas las categorías |
| POST | `/api/categories` | Crear una categoría |
| GET | `/api/categories/{id}` | Obtener una categoría |
| PUT | `/api/categories/{id}` | Actualizar una categoría |
| DELETE | `/api/categories/{id}` | Eliminar una categoría |

### Productos

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/products` | Listar todos los productos |
| POST | `/api/products` | Crear un producto |
| GET | `/api/products/{id}` | Obtener un producto |
| PUT | `/api/products/{id}` | Actualizar un producto |
| DELETE | `/api/products/{id}` | Eliminar un producto |

## Formato de Respuesta Estándar

**Respuesta exitosa:**
```json
{
  "success": true,
  "message": "Producto creado correctamente",
  "data": {
    "id": 1,
    "name": "Camiseta Overskull",
    "price": 89.90
  }
}
```

**Respuesta de error:**
```json
{
  "success": false,
  "message": "Error de validación",
  "errors": {
    "name": ["El campo nombre es requerido"]
  }
}
```

## Estructura del Proyecto

```
laravel-api/
├── app/
│   ├── Http/
│   │   ├── Controllers/Api/
│   │   │   ├── CategoryController.php
│   │   │   └── ProductController.php
│   │   └── Requests/
│   │       ├── Category/
│   │       │   ├── StoreCategoryRequest.php
│   │       │   └── UpdateCategoryRequest.php
│   │       └── Product/
│   │           ├── StoreProductRequest.php
│   │           └── UpdateProductRequest.php
│   ├── Models/
│   │   ├── Category.php
│   │   └── Product.php
│   └── Traits/
│       └── ApiResponse.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── CategorySeeder.php
│       └── ProductSeeder.php
├── routes/
│   └── api.php
├── docker/
│   └── nginx/
│       └── default.conf
├── docker-compose.yml
├── Dockerfile
└── README.md
```

## Tecnologías y Paquetes

- **Laravel 13** — Framework PHP
- **MySQL** — Base de datos relacional
- **Laravel Sanctum** — Autenticación API
- **Laravel Telescope** — Observabilidad y debugging
- **Spatie Activity Log** — Auditoría de acciones CRUD
- **L5-Swagger** — Documentación OpenAPI/Swagger
- **Form Requests** — Validaciones bajo SRP
- **Docker** — Contenedores PHP + MySQL + Nginx

## Manejo de Errores

- Las validaciones se realizan mediante Form Requests separados (SRP).
- Las respuestas JSON siempre siguen el formato estándar `{success, message, data/errors}`.
- Las rutas `api/*` devuelven JSON automáticamente ante excepciones.
- Todas las acciones de create/update/delete quedan registradas en el log de auditoría (Spatie Activity Log).
