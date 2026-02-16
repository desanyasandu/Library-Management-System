# Library Management System

## How to Run

Follow these steps to get the project up and running on your local machine.

### Prerequisites

Ensure you have the following installed:
- PHP
- Composer
- Node.js & NPM

### Installation

1.  **Clone the repository**
    ```bash
    git clone <repository-url>
    cd libraryManagement
    ```

2.  **Install PHP dependencies**
    ```bash
    composer install
    ```

3.  **Install JavaScript dependencies**
    ```bash
    npm install
    ```

4.  **Environment Setup**
    - Copy the example environment file:
      ```bash
      cp .env.example .env
      ```
    - Configure your database credentials in the `.env` file.

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Run Database Migrations**
    ```bash
    php artisan migrate
    ```

### Running the Application

You need to run both the Laravel development server and the Vite development server. Open two terminal terminals:

**Terminal 1: Start Laravel Server**
```bash
php artisan serve
```
Access the application at: [http://127.0.0.1:8000](http://127.0.0.1:8000)

**Terminal 2: Start Vite Server (for assets)**
```bash
npm run dev
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
