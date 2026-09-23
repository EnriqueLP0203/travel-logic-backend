# Travel Logic — Backend

Aplicación web desarrollada con **Laravel 12** y renderizado del lado del servidor (Blade). Incluye un portal público de hoteles, destinos y ofertas, así como un panel de administración completo con autenticación dedicada.

---

## Tabla de Contenidos

- [Stack Tecnológico](#stack-tecnológico)
- [Requisitos del Sistema](#requisitos-del-sistema)
- [Instalación](#instalación)
- [Configuración del Entorno](#configuración-del-entorno)
- [Configuración de la Base de Datos](#configuración-de-la-base-de-datos)
- [Levantar el Servidor de Desarrollo](#levantar-el-servidor-de-desarrollo)
- [Estructura del Proyecto](#estructura-del-proyecto)
  - [Modelos](#modelos)
  - [Controladores](#controladores)
  - [Form Requests (Validación)](#form-requests-validación)
  - [Servicios](#servicios)
  - [Reglas de Validación Personalizadas](#reglas-de-validación-personalizadas)
  - [Rutas](#rutas)
  - [Vistas (Blade)](#vistas-blade)
  - [Base de Datos](#base-de-datos)
  - [JavaScript & CSS](#javascript--css)
- [Docker](#docker)
- [Testing](#testing)
- [Scripts Disponibles](#scripts-disponibles)

---

## Stack Tecnológico

| Capa | Tecnología | Versión |
|---|---|---|
| Framework PHP | Laravel | ^12.0 |
| Runtime PHP | PHP | ^8.2 |
| Frontend CSS | Tailwind CSS | ^4.0 |
| Bundler | Vite | ^8.0 |
| Gestor de paquetes JS | pnpm | 11.8.0 |
| Animaciones | GSAP | ^3.15 |
| Scroll suave | Lenis | ^1.3 |
| Interactividad | Alpine.js | ^3.15 |
| Íconos (Blade) | Blade Lucide Icons | ^1.26 |
| Íconos (Blade) | Blade Simple Icons | ^8.12 |
| Autenticación API | Laravel Sanctum | ^4.3 |
| Base de datos (dev) | SQLite | — |
| Base de datos (prod) | MySQL / Clever Cloud | — |

---

## Requisitos del Sistema

Antes de instalar, asegúrate de tener lo siguiente en tu máquina:

- **PHP** `>= 8.2` con extensiones: `pdo`, `pdo_sqlite` (o `pdo_mysql`), `mbstring`, `xml`, `curl`, `zip`, `gd`
- **Composer** `>= 2.x` — [Descargar Composer](https://getcomposer.org/download/)
- **Node.js** `>= 20.x` — [Descargar Node.js](https://nodejs.org/)
- **pnpm** `>= 9.x` — Se instala con `npm install -g pnpm`
- **SQLite** (para desarrollo local) — generalmente ya viene con PHP
- **Git** — para clonar el repositorio

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd travel-logic-backend
```

### 2. Instalar dependencias PHP

```bash
composer install
```

### 3. Instalar dependencias JavaScript

```bash
pnpm install
```

### 4. Crear el archivo de entorno

```bash
cp .env.example .env
```

### 5. Generar la clave de la aplicación

```bash
php artisan key:generate
```

> También puedes ejecutar todo lo anterior con el script de setup definido en `composer.json`:
> ```bash
> composer run setup
> ```

---

## Configuración del Entorno

Edita el archivo `.env` con tus valores locales. Las variables más importantes son:

```dotenv
APP_NAME=Laravel
APP_ENV=local
APP_KEY=              # se genera con: php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost
```

---

## Configuración de la Base de Datos

El proyecto soporta **SQLite** (desarrollo) y **MySQL** (producción).

### Desarrollo — SQLite (por defecto)

Asegúrate de que estas líneas estén en tu `.env`:

```dotenv
DB_CONNECTION=sqlite
```

Crea el archivo de base de datos vacío:

```bash
touch database/database.sqlite
```

Ejecuta las migraciones:

```bash
php artisan migrate
```

Opcionalmente, ejecuta los seeders para poblar datos iniciales:

```bash
php artisan db:seed
```

> El seeder principal crea un **admin** inicial y datos de ejemplo de `CustomerInformation`.

---

### Producción — MySQL (Render + Clever Cloud)

Descomenta y completa las siguientes variables en `.env`:

```dotenv
APP_ENV=production
APP_DEBUG=false
APP_URL=https://<tu-servicio>.onrender.com

DB_CONNECTION=mysql
DB_HOST=<MYSQL_ADDON_HOST>
DB_PORT=<MYSQL_ADDON_PORT>
DB_DATABASE=<MYSQL_ADDON_DB>
DB_USERNAME=<MYSQL_ADDON_USER>
DB_PASSWORD=<MYSQL_ADDON_PASSWORD>
DB_SSL=true
```

Luego ejecuta:

```bash
php artisan migrate --force
```

---

## Levantar el Servidor de Desarrollo

El comando `composer run dev` inicia simultáneamente:

- `php artisan serve` — servidor PHP
- `php artisan queue:listen` — cola de trabajos
- `php artisan pail` — visor de logs en tiempo real
- `npm run dev` — servidor Vite para assets

```bash
composer run dev
```

O de forma individual:

```bash
# PHP
php artisan serve

# Vite (CSS + JS)
pnpm run dev
```

Accede a la aplicación en: `http://localhost:8000`  
Panel de administración en: `http://localhost:8000/admin/login`

---

## Estructura del Proyecto

```
travel-logic-backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # Controladores HTTP
│   │   ├── Requests/          # Form Requests (validación)
│   │   └── Resources/         # API Resources (vacío por ahora)
│   ├── Models/                # Modelos Eloquent
│   ├── Rules/                 # Reglas de validación personalizadas
│   ├── Services/              # Lógica de negocio (imágenes, íconos)
│   └── View/                  # Providers de Blade
├── database/
│   ├── factories/             # Factories para testing
│   ├── migrations/            # Migraciones de base de datos
│   └── seeders/               # Seeders de datos iniciales
├── resources/
│   ├── css/                   # CSS global (app.css)
│   ├── js/                    # JavaScript (Alpine, GSAP, Lenis)
│   └── views/                 # Vistas Blade
│       ├── admin/             # Vistas del panel de administración
│       ├── components/        # Componentes Blade reutilizables
│       ├── layouts/           # Layouts base
│       └── partials/          # Partiales (header, footer, sidebar)
├── routes/
│   ├── web.php                # Rutas web (públicas + admin)
│   └── console.php            # Comandos Artisan personalizados
├── docker/                    # Configuración Docker (nginx, supervisord)
├── .env.example               # Plantilla de variables de entorno
├── composer.json              # Dependencias PHP
├── package.json               # Dependencias JS
└── vite.config.js             # Configuración de Vite
```

---

## Modelos

Ubicación: `app/Models/`

| Archivo | Descripción |
|---|---|
| `Hotel.php` | Hotel con relaciones a destino, galería, grupos, tipos de alojamiento, reseñas y traducciones |
| `HotelTranslation.php` | Traducciones de campos del hotel (descripción, etc.) |
| `HotelGallery.php` | Imágenes de galería asociadas a un hotel |
| `HotelGroup.php` | Grupos o categorías de hoteles (ej: "Todo incluido") |
| `HotelGroupTranslation.php` | Traducciones de grupos de hoteles |
| `HotelReview.php` | Reseñas de clientes para hoteles |
| `Destination.php` | Destinos turísticos (ciudad/país) |
| `AccommodationType.php` | Tipos de alojamiento (ej: Suite, Junior Suite) |
| `AccommodationTypeTranslation.php` | Traducciones de tipos de alojamiento |
| `Offer.php` | Ofertas o promociones especiales |
| `Traveler.php` | Viajero/cliente del sistema |
| `TravelerAuth.php` | Autenticación de viajeros |
| `CustomerInformation.php` | Información de clientes que completan formularios |
| `InterestedClient.php` | Leads/clientes interesados desde el formulario de contacto |
| `Language.php` | Idiomas disponibles en el sistema |
| `Admin.php` | Usuario administrador del panel |
| `User.php` | Usuario genérico (base Laravel) |

---

## Controladores

### Controladores Públicos
Ubicación: `app/Http/Controllers/`

| Archivo | Ruta base | Descripción |
|---|---|---|
| `ContactController.php` | `POST /contact` | Procesa el formulario de contacto |
| `AgencyRegistrationController.php` | `POST /register-agency` | Registro de agencias |

### Controladores de Administración
Ubicación: `app/Http/Controllers/Admin/`

| Archivo | Ruta base | Descripción |
|---|---|---|
| `AuthController.php` | `/admin/login` | Login y logout del administrador |
| `DashboardController.php` | `/admin` | Vista principal del dashboard |
| `HotelsController.php` | `/admin/hotels` | CRUD completo de hoteles (con imágenes) |
| `DestinationController.php` | `/admin/destinations` | CRUD de destinos turísticos |
| `HotelGroupsController.php` | `/admin/hotel-groups` | CRUD de grupos de hoteles |
| `AccommodationTypeController.php` | `/admin/accommodation-types` | CRUD de tipos de alojamiento |
| `OffersController.php` | `/admin/offers` | CRUD de ofertas/promociones |
| `CustomerInformationController.php` | `/admin/customer-information` | Ver y gestionar información de clientes |
| `InterestedClientController.php` | `/admin/interested-clients` | Gestión de leads/clientes interesados |
| `LucideIconController.php` | `/admin/icons` | Catálogo y previsualización de íconos |

---

## Form Requests (Validación)

### Públicos
Ubicación: `app/Http/Requests/`

| Archivo | Descripción |
|---|---|
| `StoreCustomerInformationRequest.php` | Validación del formulario de registro de cliente |
| `StoreInterestedClientRequest.php` | Validación del formulario de cliente interesado |

### Administración
Ubicación: `app/Http/Requests/Admin/`

| Archivo | Descripción |
|---|---|
| `LoginRequest.php` | Validación de credenciales de admin |
| `StoreHotelsRequest.php` | Crear hotel (con imágenes, traducciones, etc.) |
| `UpdateHotelsRequest.php` | Actualizar hotel |
| `StoreDestinationRequest.php` | Crear destino |
| `UpdateDestinationRequest.php` | Actualizar destino |
| `StoreHotelGroupsRequest.php` | Crear grupo de hotel |
| `UpdateHotelGroupsRequest.php` | Actualizar grupo de hotel |
| `StoreAccommodationTypeRequest.php` | Crear tipo de alojamiento |
| `UpdateAccommodationTypeRequest.php` | Actualizar tipo de alojamiento |
| `StoreOfferRequest.php` | Crear oferta |
| `UpdateOfferRequest.php` | Actualizar oferta |
| `UpdateCustomerInformationRequest.php` | Actualizar información de cliente |
| `UpdateInterestedClientRequest.php` | Actualizar cliente interesado |

---

## Servicios

Ubicación: `app/Services/`

| Archivo | Descripción |
|---|---|
| `HotelImageService.php` | Manejo de subida, almacenamiento y eliminación de imágenes de hoteles |
| `DestinationImageService.php` | Mismo patrón para imágenes de destinos |
| `HotelGroupImageService.php` | Imágenes de grupos de hoteles |
| `OfferImageService.php` | Imágenes de ofertas |
| `LucideIconService.php` | Búsqueda y carga dinámica de íconos Lucide |

> Los archivos de imagen se almacenan en `storage/travel_media/` y se sirven a través de rutas dedicadas en `routes/web.php`.

---

## Reglas de Validación Personalizadas

Ubicación: `app/Rules/`

| Archivo | Descripción |
|---|---|
| `NumericPhone.php` | Valida que un teléfono contenga solo dígitos (sin guiones ni espacios) |

---

## Rutas

Ubicación: `routes/web.php`

### Rutas Públicas

| Método | URI | Nombre | Descripción |
|---|---|---|---|
| `GET` | `/` | `home` | Página principal |
| `GET` | `/about` | `about` | Página "Acerca de" |
| `GET` | `/contact` | `contact` | Formulario de contacto |
| `POST` | `/contact` | `contact.store` | Enviar formulario de contacto |
| `GET` | `/offers` | `offers` | Listado de ofertas y hoteles destacados |
| `GET` | `/register-agency` | `register-agency` | Registro de agencias |
| `POST` | `/register-agency` | `register-agency.store` | Procesar registro de agencia |
| `GET` | `/hotels` | `hotels` | Listado de hoteles con filtros |
| `GET` | `/hotels/{slug}` | `hotel.show` | Detalle de un hotel |
| `GET` | `/media/hotels/{filename}` | `media.hotels` | Servir imágenes de hoteles |
| `GET` | `/media/destinations/{filename}` | `media.destinations` | Servir imágenes de destinos |
| `GET` | `/media/hotel-groups/{filename}` | `media.hotel-groups` | Servir imágenes de grupos |
| `GET` | `/media/offers/{filename}` | `media.offers` | Servir imágenes de ofertas |

### Rutas de Administración (prefijo `/admin`)

| Método | URI | Nombre | Descripción |
|---|---|---|---|
| `GET` | `/admin/login` | `admin.login` | Formulario de login |
| `POST` | `/admin/login` | — | Procesar login |
| `POST` | `/admin/logout` | `admin.logout` | Cerrar sesión |
| `GET` | `/admin` | `admin.dashboard` | Dashboard principal |
| `GET/POST` | `/admin/hotels` | `admin.hotels.*` | Listado y creación de hoteles |
| `PUT/DELETE` | `/admin/hotels/{hotel}` | — | Actualizar/eliminar hotel |
| `GET/POST` | `/admin/destinations` | `admin.destinations.*` | Destinos |
| `GET/POST` | `/admin/offers` | `admin.offers.*` | Ofertas |
| `GET/POST` | `/admin/hotel-groups` | `admin.hotel-groups.*` | Grupos de hoteles |
| `GET/POST` | `/admin/accommodation-types` | `admin.accommodation-types.*` | Tipos de alojamiento |
| `GET` | `/admin/reviews` | `admin.reviews.index` | Reseñas |
| `GET` | `/admin/customer-information` | `admin.customer-information.index` | Info de clientes |
| `GET` | `/admin/interested-clients` | `admin.interested-clients.index` | Clientes interesados |
| `GET` | `/admin/icons/catalog` | `admin.icons.catalog` | Catálogo de íconos |

---

## Vistas (Blade)

### Layouts Base
Ubicación: `resources/views/layouts/`

| Archivo | Descripción |
|---|---|
| `app.blade.php` | Layout principal del sitio público |
| `dashboard.blade.php` | Layout del panel de administración |
| `admin-auth.blade.php` | Layout para la pantalla de login del admin |

### Páginas Públicas
Ubicación: `resources/views/`

| Archivo | URL | Descripción |
|---|---|---|
| `home.blade.php` | `/` | Página de inicio con animaciones GSAP |
| `about.blade.php` | `/about` | Página "Acerca de" |
| `contact.blade.php` | `/contact` | Formulario de contacto |
| `hotels.blade.php` | `/hotels` | Listado de hoteles con filtros |
| `hotel_details.blade.php` | `/hotels/{slug}` | Detalle de un hotel |
| `offers.blade.php` | `/offers` | Ofertas y hoteles destacados |
| `register-agency.blade.php` | `/register-agency` | Registro de agencias |
| `admin-dashboard-auth.blade.php` | `/admin/login` | Login del administrador |

### Vistas del Panel de Administración
Ubicación: `resources/views/admin/`

| Directorio / Archivo | Descripción |
|---|---|
| `dashboard.blade.php` | Vista principal del dashboard |
| `hotels/index.blade.php` | Gestión de hoteles |
| `destinations/` | Vistas de gestión de destinos |
| `hotel-groups/` | Vistas de grupos de hoteles |
| `accommodation-types/` | Tipos de alojamiento |
| `offers/` | Gestión de ofertas |
| `reviews/` | Gestión de reseñas |
| `customer_information/` | Información de clientes |
| `interested_clients/` | Leads/clientes interesados |

### Componentes Blade
Ubicación: `resources/views/components/`

| Archivo | Descripción |
|---|---|
| `hotel-card.blade.php` | Tarjeta de hotel para listados |
| `offer-card.blade.php` | Tarjeta de oferta/promoción |
| `testimonial-card.blade.php` | Tarjeta de testimonio/reseña |
| `destinations-carousel.blade.php` | Carrusel de destinos |
| `stacked-cards.blade.php` | Cards apiladas (efecto visual) |
| `pagination.blade.php` | Componente de paginación personalizado |
| `animate-in.blade.php` | Wrapper de animación de entrada |
| `hotels-search-bar.blade.php` | Barra de búsqueda de hoteles |
| `hotels-filters-modal.blade.php` | Modal con filtros de hoteles |
| `home-filter-details.blade.php` | Detalles del filtro en home |
| `home-filter-info.blade.php` | Información del filtro en home |
| `destination-create-modal.blade.php` | Modal para crear destino (admin) |
| `destination-edit-modal.blade.php` | Modal para editar destino (admin) |
| `destination-delete-modal.blade.php` | Modal de confirmación de eliminación |
| `destination-view-modal.blade.php` | Modal de vista detallada de destino |
| `customer-information-view-modal.blade.php` | Modal para ver info de cliente |
| `customer-information-review-modal.blade.php` | Modal de revisión de cliente |
| `customer-information-delete-modal.blade.php` | Modal de eliminación de cliente |
| `interested-client-contact-section.blade.php` | Sección de contacto para leads |
| `interested-client-attend-modal.blade.php` | Modal para atender un lead |
| `interested-client-delete-modal.blade.php` | Modal de eliminación de lead |
| `register-agency-success-modal.blade.php` | Modal de éxito de registro |
| `hotels/` | Sub-componentes para gestión de hoteles (admin) |
| `hotel-groups/` | Sub-componentes de grupos de hoteles |
| `accommodation-types/` | Sub-componentes de tipos de alojamiento |
| `offers/` | Sub-componentes de ofertas |

### Partiales
Ubicación: `resources/views/partials/`

| Archivo | Descripción |
|---|---|
| `header.blade.php` | Navbar / cabecera del sitio público |
| `footer.blade.php` | Pie de página del sitio público |
| `dashboard-sidebar.blade.php` | Sidebar del panel de administración |
| `dashboard-topbar.blade.php` | Barra superior del dashboard |

---

## Base de Datos

### Migraciones
Ubicación: `database/migrations/`

Las migraciones se ejecutan en orden cronológico con `php artisan migrate`.

| Migración | Tabla | Descripción |
|---|---|---|
| `0001_01_01_000000` | `users` | Tabla de usuarios base |
| `0001_01_01_000001` | `cache` | Tabla de caché en BD |
| `0001_01_01_000002` | `jobs` | Tabla de trabajos en cola |
| `2026_06_21_001639` | `languages` | Idiomas disponibles |
| `2026_06_21_154957` | `destinations` | Destinos turísticos |
| `2026_06_21_155551` | `hotels` | Hoteles |
| `2026_06_21_155757` | `hotels_t` | Traducciones de hoteles |
| `2026_06_21_155820` | `hotel_gallery` | Galería de imágenes de hoteles |
| `2026_06_21_155929` | `hotel_groups` | Grupos de hoteles |
| `2026_06_21_155946` | `hotel_groups_t` | Traducciones de grupos |
| `2026_06_21_155954` | `hotels_hotel_groups` | Relación hotel-grupo (pivot) |
| `2026_06_21_160008` | `accommodation_types` | Tipos de alojamiento |
| `2026_06_21_160023` | `accommodation_types_t` | Traducciones de tipos |
| `2026_06_21_160038` | `hotels_accommodation_types` | Relación hotel-tipo (pivot) |
| `2026_06_21_160049` | `travelers_auth` | Autenticación de viajeros |
| `2026_06_21_160104` | `travelers` | Viajeros/clientes |
| `2026_06_21_160117` | `hotel_review` | Reseñas de hoteles |
| `2026_06_22_050254` | `personal_access_tokens` | Tokens Sanctum |
| `2026_07_16_163532` | — | Elimina campo `order` de grupos y tipos |
| `2026_07_17_144956` | `admins` | Renombra `users` a `admins` y agrega `username` |
| `2026_07_18_150000` | `hotels` | Hace campos opcionales nullable |
| `2026_08_01_000001` | `customer_information` | Información de clientes |
| `2026_08_01_000002` | — | Elimina tablas de agencias |
| `2026_08_02_000001` | `interested_clients` | Leads/clientes interesados |
| `2026_08_02_200000` | `offers` | Ofertas/promociones |
| `2026_09_02_000001` | `interested_clients` | Agrega campos adicionales |
| `2026_09_17_200843` | `customer_information` | Hace `password` nullable |

### Seeders
Ubicación: `database/seeders/`

| Archivo | Descripción |
|---|---|
| `DatabaseSeeder.php` | Seeder principal, orquesta los demás |
| `AdminSeeder.php` | Crea el primer usuario administrador |
| `CustomerInformationSeeder.php` | Datos de ejemplo de clientes |

Ejecutar todos los seeders:

```bash
php artisan db:seed
```

Ejecutar uno específico:

```bash
php artisan db:seed --class=AdminSeeder
```

### Factories
Ubicación: `database/factories/`

| Archivo | Descripción |
|---|---|
| `UserFactory.php` | Factory para generar usuarios de prueba |

---

## JavaScript & CSS

### JavaScript
Ubicación: `resources/js/`

| Archivo | Descripción |
|---|---|
| `app.js` | Entrada principal: Alpine.js, Lenis (scroll suave), lógica de modales, filtros y UI general |
| `home-animations.js` | Animaciones GSAP específicas de la página de inicio |
| `about-animations.js` | Animaciones GSAP específicas de la página "About" |

### CSS
Ubicación: `resources/css/`

| Archivo | Descripción |
|---|---|
| `app.css` | Estilos globales con Tailwind CSS v4 |

### Configuración de Vite
Ubicación: `vite.config.js`

Vite está configurado con el plugin oficial de Laravel y Tailwind. Los entry points compilados son:

- `resources/css/app.css`
- `resources/js/app.js`
- `resources/js/home-animations.js`
- `resources/js/about-animations.js`

La fuente **Instrument Sans** se carga desde Bunny Fonts (pesos 400, 500, 600).

---

## Docker

El proyecto incluye soporte Docker para despliegue en producción.

| Archivo | Descripción |
|---|---|
| `Dockerfile` | Imagen Docker basada en PHP + Nginx + Supervisor |
| `docker/nginx.conf` | Configuración de Nginx |
| `docker/supervisord.conf` | Configuración de Supervisor para manejar procesos |
| `docker/start.sh` | Script de inicio del contenedor |
| `docker/www.conf` | Configuración de PHP-FPM |
| `.dockerignore` | Archivos ignorados en el build de Docker |

Para construir la imagen:

```bash
docker build -t travel-logic-backend .
```

---

## Testing

El proyecto usa **PHPUnit** con la configuración en `phpunit.xml`.

```bash
# Ejecutar todos los tests
composer run test

# O directamente con Artisan
php artisan test

# Test específico
php artisan test --filter NombreDelTest
```

Ubicación de tests: `tests/`

---

## Scripts Disponibles

### Composer

| Comando | Descripción |
|---|---|
| `composer run setup` | Instalación completa desde cero |
| `composer run dev` | Levanta todos los procesos de desarrollo |
| `composer run test` | Limpia config y ejecuta tests |

### pnpm

| Comando | Descripción |
|---|---|
| `pnpm run dev` | Servidor Vite en modo desarrollo (HMR) |
| `pnpm run build` | Build de producción de assets |

---

> **Nota de producción:** El sistema está configurado para desplegarse en **Render** (app PHP) + **Clever Cloud** (MySQL). Las variables de entorno de producción se configuran en el dashboard de Render, no en el `.env` del repositorio.
