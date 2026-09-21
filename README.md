# Laravel Marketplace

A full-stack e-commerce marketplace built with Laravel, where buyers can browse products, manage a cart, place orders, leave reviews, and manage wishlists. Sellers can manage their products and update order statuses.

## Features

### Buyer Features

* Browse and search products
* Sort products by price
* View product details
* Add products to cart
* Update cart quantities
* Checkout and create orders
* View order history and order details
* Track order status
* Add and remove products from wishlist
* Leave product reviews and ratings

### Seller Features

* Seller dashboard
* Create products
* Edit products
* Delete products
* Upload a product image
* Manage product stock
* View customer orders
* Update order status
* Seller authorization and access control

### Security & Authorization

* Authentication
* Buyer and seller roles
* Product ownership authorization
* Seller-only product management
* Seller-only order management
* Buyers can access only their own orders
* Stock availability validation
* Protected routes and controller authorization

## Order Flow

1. Buyer selects a product.
2. Buyer adds the product to the cart.
3. Buyer checks out.
4. An order and order items are created.
5. Product stock is decreased according to the purchased quantity.
6. Seller sees the order.
7. Seller updates the order status.
8. Buyer can see the updated order status.

## Technologies

* PHP
* Laravel
* MySQL
* Blade
* Bootstrap
* JavaScript
* Vite
* HTML
* CSS

## Project Structure

The project follows Laravel's MVC architecture and uses:

* Controllers for application logic
* Eloquent models and relationships
* Blade views
* Database migrations and seeders
* Policies for authorization
* Session-based shopping cart
* RESTful routes

## Installation

Clone the repository:

```bash
git clone https://github.com/davitmkh98/laravel-marketplace.git
cd laravel-marketplace
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure the database in `.env`, then run:

```bash
php artisan migrate --seed
```

Start the Laravel development server:

```bash
php artisan serve
```

In another terminal, start Vite:

```bash
npm run dev
```

## Project Status

The core marketplace functionality is implemented and tested, including product management, cart, checkout, orders, seller order management, reviews, wishlist functionality, stock management, and role-based authorization.

Payment integration can be added as a future stage.

## Author

Davit Mkhitaryan

GitHub: https://github.com/davitmkh98
