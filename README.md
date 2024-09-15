
---

# Laravel Weather API Project

This is a Laravel project designed to save and manage weather data from an external weather API. The project uses Laravel Sail for local development, and users need to run background tasks like scheduling and queue processing.

## Requirements

- Docker (for Laravel Sail)
- PHP 8.x
- Composer
- MySQL or another database (configured in `.env` file)

## Getting Started

Follow these steps to set up the project locally using Laravel Sail.

### 1. Clone the Repository

```bash
git clone https://github.com/NurlanRazak/hoteza-test.git
cd laravel-weather-api
```

### 2. Install Dependencies

Ensure you have Docker installed and running.

```bash
composer install
```

### 3. Set Up Environment File

Copy the `.env.example` to `.env` and configure it as per your local environment.

```bash
cp .env.example .env
```

Make sure to set up the database configuration in the `.env` file:

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=weather_db
DB_USERNAME=sail
DB_PASSWORD=password
```

### 4. Start Laravel Sail

You can use Laravel Sail to bring up the Docker environment:

```bash
./vendor/bin/sail up -d
```

### 5. Run Migrations

Run the database migrations to create the necessary tables:

```bash
./vendor/bin/sail artisan migrate
```

### 6. Scheduling and Queue Workers

In order for the weather data to be processed correctly, you'll need to run the following background tasks:

#### 6.1 Start the Scheduler

To start the Laravel scheduler to handle any scheduled tasks (e.g., fetching weather data periodically):

```bash
./vendor/bin/sail artisan schedule:work
```

#### 6.2 Start the Queue Worker

Start the Laravel queue worker to process any queued jobs (e.g., storing weather data in the background):

```bash
./vendor/bin/sail artisan queue:work
```

### 7. Access the Application

Once everything is set up, you can access the application via your local environment:

```
http://localhost
```

### 8. Running Tests

To run the tests, use the following command:

```bash
./vendor/bin/sail artisan test
```

### 9. Stopping the Application

To stop the application, run the following:

```bash
./vendor/bin/sail down
```

## Project Structure

- **City Model**: Represents the cities where weather data is fetched from.
- **Weather Model**: Stores weather details for a given city.
- **WeatherController**: Handles the logic of storing weather data from the API.

## Additional Notes

- This project is using Laravel Sail for local development. Make sure Docker is running before executing any commands.
- If you need to run Artisan commands, prefix them with `./vendor/bin/sail`, for example:

  ```bash
  ./vendor/bin/sail artisan migrate
  ```

---

This should give a clear set of instructions for setting up, running, and maintaining the Laravel project with Sail, as well as handling the scheduler and queue worker.
