# Mercado Nova · E-commerce (Primera entrega)

Proyecto en Laravel 13 con autenticación manual y tres niveles de acceso: **Cliente**, **Empleado** y **Gerente**.

## Funcionalidades

- Página de inicio y páginas públicas: Quiénes somos, Misión y visión, Ubicación, Contáctanos.
- Inicio de sesión y registro propios (sin paquetes), con validación de datos.
- Redirección automática al dashboard de cada rol.
- Middleware `role:` que protege las rutas por nivel de acceso.
- CRUD de usuarios (solo Gerente) con búsqueda, filtro por rol y paginación.
- Cerrar sesión para todos los usuarios autenticados.

## Requisitos (solo para la instalación local)

- PHP 8.3 o superior
- Composer
- MySQL (XAMPP, Laragon o similar)

## Opción A: con Docker (recomendada)

Solo necesitas Docker Desktop. No hace falta instalar PHP, Composer ni MySQL.

```bash
docker compose up -d --build
docker compose logs -f app      # espera a ver "Server running on [http://0.0.0.0:8000]"; sal con Ctrl+C
docker compose exec app php artisan db:seed
```

- Aplicación: http://localhost:8000
- phpMyAdmin: http://localhost:8080 (root / secret)
- Pruebas: `docker compose exec app php artisan test`
- Rutas: `docker compose exec app php artisan route:list --except-vendor`
- Apagar: `docker compose down` (agrega `-v` para borrar también la base de datos)

## Opción B: instalación local (XAMPP / Laragon)

```bash
git clone https://github.com/USUARIO/ecommerce.git
cd ecommerce
composer install
cp .env.example .env        # en Windows: copy .env.example .env
php artisan key:generate
```

Crea una base de datos vacía llamada `ecommerce` en MySQL (phpMyAdmin o `CREATE DATABASE ecommerce;`) y revisa usuario/contraseña en `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

Luego:

```bash
php artisan migrate --seed
php artisan serve
```

Abre http://127.0.0.1:8000

## Usuarios de prueba

Contraseña de todos: `Password123`

| Rol      | Correo                    |
|----------|---------------------------|
| Gerente  | gerente@mercadonova.mx    |
| Empleado | empleado@mercadonova.mx   |
| Cliente  | cliente@mercadonova.mx    |

## Pruebas automáticas

```bash
php artisan test
```

## Archivos principales

| Qué                         | Dónde |
|-----------------------------|-------|
| Rutas                       | `routes/web.php` |
| Login / logout              | `app/Http/Controllers/Auth/LoginController.php` |
| Registro                    | `app/Http/Controllers/Auth/RegisterController.php` |
| Validación del registro     | `app/Http/Requests/RegisterRequest.php` |
| CRUD de usuarios            | `app/Http/Controllers/UserController.php` |
| Validación del CRUD         | `app/Http/Requests/UserRequest.php` |
| Middleware de roles         | `app/Http/Middleware/RoleMiddleware.php` (alias en `bootstrap/app.php`) |
| Modelo con roles            | `app/Models/User.php` |
| Migración del rol           | `database/migrations/2026_10_18_000001_add_role_and_phone_to_users_table.php` |
| Vistas                      | `resources/views/` (`pages/`, `auth/`, `dashboards/`, `usuarios/`) |
