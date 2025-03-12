# PHP Learning Project

This project follows the Laracasts "PHP for Beginners" course, implementing various concepts and examples covered in the tutorials.

## Prerequisites

- PHP installed on your system
- MySQL database server
- Basic understanding of command line operations

## Getting Started

1. Clone this repository to your local machine:

```bash
git clone https://github.com/HandMatt/php-for-beginners.git
```

2. Navigate to the project directory:

```bash
cd php-for-beginners/demo
```

3. Configure your database:
   - Create a new MySQL database
   - Update database configuration in `config.php`

4. Serve the application:

```bash
php -S localhost:8888 -t public
```

## Project Structure

```
demo/
├── Core/                   # Core framework classes
|   └── Middleware/         # Middleware files
├── Http/                   # HTTP-related components
│   ├── controllers/        # Controller files
│   │   ├── notes/          # Note controller files
│   │   ├── registration/   # Registration controller files
│   │   └── session/        # Session controller files
│   └── Forms/              # Form handling and validation classes
├── public/                 # Public assets
└── views/                  # View files
    ├── notes/              # Note view files
    ├── partials/           # Partial view files
    ├── registration/       # Registration view files
    └── session/            # Session view files
```

## Features

- Simple MVC architecture
- Database integration with PDO
- Routing system with support for:
  - GET, POST, PATCH, PUT, DELETE methods
  - Middleware protection
  - Dynamic route parameters
- Authentication system
  - User registration
  - User login and logout
  - Session management
  - Protected routes
- Middleware implementation
  - Guest-only access control
  - Authenticated user protection
- Basic CRUD operations
- Form validation
- Error handling with custom error pages
- Clean separation of concerns
- Organized project structure

## Learning Resources

This project is based on the [PHP for Beginners](https://laracasts.com/series/php-for-beginners) course by Laracasts.

## License

This project is open-sourced and follows the same license as the original course material.

## Acknowledgments

- Jeffrey Way and the Laracasts team for the excellent learning material