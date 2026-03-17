# Restaurant API & Web Admin

A Laravel 12 application managing restaurants and menu items with a custom API token authentication, Redis caching, and a basic Web Admin UI.

## Tech Stack Used
- PHP 8.2+
- Laravel 12
- MySQL 8.0
- Redis
- PHPUnit for feature testing
- TailwindCSS (via CDN for Web Admin)

## Design Decisions
1. **Authentication**: Instead of Laravel Sanctum, a simple custom middleware `EnsureApiTokenIsValid` compares the incoming `Authorization: Bearer <token>` to the `API_TOKEN` environment variable. 
2. **Caching**: Redis is used to cache the list of restaurants retrieved from `GET /api/restaurants`. Cache invalidation occurs automatically on Create, Update, or Delete operations.
3. **Database Seeding**: Manual DB inserts without using faker were implemented to ensure precise initial state matching the requirements constraint (2 restaurants with 5 menu items each).
4. **Validation**: Built-in Laravel request validation ensures payload integrity (e.g., specific enum values for `category`, minimum amounts for `price`).
5. **Pagination & Searching**: Built-in Eloquent pagination and query scopes are used for robust and efficient data retrieval.

## Setup Instructions (Local without Docker)

1. Clone or copy this repository to your local server (e.g., Laragon/XAMPP).
```bash
git clone <repository_url> restaurant
cd restaurant
```

2. Install dependencies:
```bash
composer install
```

3. Configure Environment:
```bash
cp .env.example .env
```
Update `.env` to match your local setup:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=restaurant_db
DB_USERNAME=root
DB_PASSWORD=

CACHE_STORE=redis
REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

API_TOKEN=restaurant_secret_api_key
```

4. Prepare Database and seed:
```bash
# Optional helper script to create the DB if it doesn't exist
php create_db.php 

# Run migrations and seed the data
php artisan migrate:fresh --seed
```

5. Run the dev server:
```bash
php artisan serve
```

## Setup Instructions (With Docker)

A `docker-compose.yml` and `Dockerfile` are provided for ease of use.

1. Update your `.env` to connect to the Docker containers instead:
```env
DB_HOST=db
REDIS_HOST=redis
```

2. Build and run containers:
```bash
docker-compose up -d --build
```
This will start `restaurant-app` (PHP), `restaurant-webserver` (Nginx on port 8000), `restaurant-db` (MySQL on port 3306), and `restaurant-redis` (Redis on port 6379).

3. Set up the application inside the container:
```bash
docker exec -it restaurant-app composer install
docker exec -it restaurant-app php artisan key:generate
docker exec -it restaurant-app php artisan migrate:fresh --seed
```

The app will be accessible at `http://localhost:8000` assuming port 8000 is open.

## API Endpoints

All endpoints (except Web views) require the `Authorization` header: `Bearer restaurant_secret_api_key`

- `POST /api/restaurants` : Create a restaurant (requires `name`, `address`).
- `GET /api/restaurants` : List all restaurants. Supports `?search=name` and `?page=N`. Cached in Redis.
- `GET /api/restaurants/:id` : Get restaurant detail, including its menu items.
- `PUT /api/restaurants/:id` : Update a restaurant.
- `DELETE /api/restaurants/:id` : Delete a restaurant.
- `POST /api/restaurants/:id/menu_items` : Add a menu item to a restaurant.
- `GET /api/restaurants/:id/menu_items` : List menu items for a restaurant. Supports `?search=name` and `?category=type`.
- `PUT /api/menu_items/:id` : Update a menu item.
- `DELETE /api/menu_items/:id` : Delete a menu item.

## Testing
To run the automated test suite:
```bash
php artisan test
```
