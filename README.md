# VibeFashion

VibeFashion is a full-stack Laravel ecommerce website for discovering and buying eyewear, jewelry, and everyday fashion accessories. The store is designed around a clean shopping experience: customers can browse products by category, search the catalog, add items to a session-based cart, complete checkout, and manage their account details.

The project also includes a protected administration area where authorized staff can manage the product catalog, review customers, and monitor recent orders.

## Store Categories

VibeFashion organizes its catalog into these product categories:

- Eyewear and sunglasses
- Necklaces and pendants
- Rings
- Bracelets and cuffs
- Earrings
- Jewelry collections
- Accessories such as protective cases and frame straps

The seeded catalog includes product names, descriptions, prices, stock levels, category assignments, product images, and featured-product flags.

## Customer Experience

Customers can:

- Browse all products or filter the catalog by category
- Search products by name, category, or description
- View detailed product information and availability
- Add products to a shopping cart and adjust quantities
- Submit checkout details and receive an order confirmation
- Register, sign in, and edit their name, email, phone, and address
- Receive clear validation and authentication error messages

## Administration

The admin dashboard is protected by authentication and role-based authorization. Administrators can:

- Add new products with categories, prices, stock, descriptions, and images
- Edit existing product information
- Remove products from the catalog
- View registered customers and order counts
- Review recent orders and their statuses

New accounts are customers by default. Specific administrator email addresses can be configured through the `ADMIN_EMAILS` environment variable. An email domain such as `@admin.com` does not grant administrator access by itself.

## Features

- Laravel ecommerce storefront with Blade views
- Responsive product browsing, categories, search, and pagination
- Session-based shopping cart and checkout flow
- Customer authentication and profile editing
- Admin-only dashboard and product management
- Environment-configured admin email allowlist
- Server-side validation with visible form error messages
- Password visibility controls on authentication forms
- SQLite development database with migrations and seed data
- Docker image based on PHP 8.4 and Apache

## Technology

- PHP 8.4+
- Laravel 13
- SQLite by default
- Blade templates
- Bootstrap and custom CSS
- PHPUnit feature tests
- Docker and Apache

## Local Installation

### Requirements

- PHP 8.4 or newer
- Composer
- Node.js and npm

### Setup

```bash
git clone https://github.com/Ezzo425/VibeFashion.git
cd VibeFashion
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

On macOS/Linux, replace `copy .env.example .env` with:

```bash
cp .env.example .env
```

Open `http://127.0.0.1:8000` after the server starts.

## Admin Access Configuration

To allow specific email addresses to register as administrators, add them to `.env`:

```env
ADMIN_EMAILS=admin@example.com,manager@example.com
```

Then clear cached configuration:

```bash
php artisan config:clear
```

New registrations using those exact email addresses receive the `admin` role and can open `/admin`.

For optional seeded admin credentials, set these values before running the seeder:

```env
ADMIN_SEED_EMAIL=admin@example.com
ADMIN_SEED_PASSWORD=replace-with-a-strong-password
```

Never commit `.env` or real passwords.

## Docker

### Build the image

```bash
docker build -t vibefashion .
```

### Run the application

Generate an application key once:

```bash
php artisan key:generate --show
```

Start the container with the generated key and a persistent SQLite volume:

```bash
docker run -d --name vibefashion -p 8080:80 \
  -e APP_ENV=production \
  -e APP_DEBUG=false \
  -e APP_KEY=base64:replace-with-generated-key \
  -e DB_CONNECTION=sqlite \
  -e DB_DATABASE=/data/database.sqlite \
  -e ADMIN_EMAILS=admin@example.com \
  -v vibefashion-data:/data \
  vibefashion
```

Open `http://127.0.0.1:8080` in a browser. The container runs migrations automatically on startup.

Useful commands:

```bash
docker logs -f vibefashion
docker exec -it vibefashion php artisan db:seed
docker stop vibefashion
docker rm vibefashion
```

The Docker daemon must be running before these commands are used.

## Testing

Run the full test suite:

```bash
php artisan test
```

Run the account, profile, checkout, and admin tests only:

```bash
php artisan test tests/Feature/AccountCheckoutAdminTest.php
```

## Project Structure

```text
app/                Application controllers, models, middleware, and mail
database/           Migrations, factories, and seeders
public/assets/      Storefront images, stylesheets, scripts, and fonts
resources/views/    Blade pages and layouts
routes/             Web and console routes
tests/              PHPUnit feature and unit tests
Dockerfile          PHP 8.4 Apache container definition
```

## License

This project is released under the MIT License.
