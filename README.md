# Laravel Todo API

A robust RESTful API built with Laravel for a mobile todo application with full authentication support. This API provides all necessary endpoints for user management and todo operations.

## Features

- **User Authentication**
  - Registration with email verification
  - Login/Logout functionality
  - Password reset
  - Token-based authentication using Laravel Sanctum

- **Todo Management**
  - Create, read, update and delete todos
  - Mark todos as completed
  - Set due dates for todos
  - Filter and sort capabilities

- **Security**
  - Protected routes
  - CSRF protection
  - Secure token handling
  - Input validation

## Requirements

- PHP >= 8.1
- Composer
- MySQL or PostgreSQL
- Laravel 10.x

## Installation

1. Clone the repository
   ```bash
   git clone https://github.com/yourusername/laravel-todo-api.git
   cd laravel-todo-api
   ```

2. Install dependencies
   ```bash
   composer install
   ```

3. Create and configure your .env file
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure your database in the .env file
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=todo_api
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Run migrations
   ```bash
   php artisan migrate
   ```

6. Start the server
   ```bash
   php artisan serve
   ```

## API Endpoints

### Authentication

| Method | Endpoint | Description | Parameters |
|--------|----------|-------------|------------|
| POST | `/api/register` | Register a new user | name, email, password, password_confirmation |
| POST | `/api/login` | Login and get access token | email, password |
| POST | `/api/logout` | Logout (requires auth) | None |
| GET | `/api/user` | Get current user info (requires auth) | None |

### Todo Operations

| Method | Endpoint | Description | Parameters |
|--------|----------|-------------|------------|
| GET | `/api/todos` | Get all todos for the authenticated user | None |
| POST | `/api/todos` | Create a new todo | title, description (optional), completed (optional), due_date (optional) |
| GET | `/api/todos/{id}` | Get a specific todo | None |
| PUT | `/api/todos/{id}` | Update a todo | title, description, completed, due_date |
| DELETE | `/api/todos/{id}` | Delete a todo | None |

## Authentication

This API uses Laravel Sanctum for token-based authentication. After logging in, you'll receive an access token that should be included in the header of your authenticated requests:

```
Authorization: Bearer {your_access_token}
```

## Usage Examples

### Register a new user

```bash
curl -X POST http://your-api-url/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john@example.com","password":"password123","password_confirmation":"password123"}'
```

### Login

```bash
curl -X POST http://your-api-url/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@example.com","password":"password123"}'
```

### Create a Todo

```bash
curl -X POST http://your-api-url/api/todos \
  -H "Authorization: Bearer {your_access_token}" \
  -H "Content-Type: application/json" \
  -d '{"title":"Complete project","description":"Finish the Laravel Todo API","due_date":"2023-12-31"}'
```

### Get all Todos

```bash
curl -X GET http://your-api-url/api/todos \
  -H "Authorization: Bearer {your_access_token}"
```

## Mobile Client Implementation

For your mobile client, you'll need to:

1. Store the access token securely after login (use secure storage options for your platform)
2. Include the token in the Authorization header for all authenticated requests
3. Handle token expiration and refresh as needed

## Testing

Run the test suite with:

```bash
php artisan test
```

## Development

### Seeding the Database

You can seed the database with sample data:

```bash
php artisan db:seed
```

### Code Style

This project follows the PSR-12 coding standard. You can check your code with:

```bash
./vendor/bin/phpcs
```

## Security

If you discover any security related issues, please email your-email@example.com instead of using the issue tracker.

## License

The Laravel Todo API is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request