# Docker Management for TaskPilot IA

TaskPilot IA is containerized using Docker to ensure environment consistency across development and production.

## Docker Composition

The project includes a multi-container setup managed by Docker Compose:

*   **App Container**: Runs PHP 8.3-FPM with all necessary extensions for Laravel.
*   **Web Container**: Uses Nginx to serve the application and manage static assets.
*   **Build Tools**: Integration with Node.js and NPM for compiling frontend assets via Vite.

## Environment Configuration

The Docker setup relies on environment variables defined in the `.env` file. Key variables for the containerized environment include:

*   `DB_CONNECTION=sqlite`
*   `DB_DATABASE=/var/www/html/database/database.sqlite`

## Development Workflow

To start the development environment:

1.  Build the images:
    ```bash
    docker-compose build
    ```
2.  Start the containers:
    ```bash
    docker-compose up -d
    ```
3.  Install dependencies within the container:
    ```bash
    docker-compose exec app composer install
    docker-compose exec app npm install
    docker-compose exec app npm run build
    ```

## Production Considerations

For production deployments, the `Dockerfile` utilizes a multi-stage build process:

1.  **Dependencies Stage**: Installs composer and npm dependencies.
2.  **Asset Stage**: Compiles frontend assets.
3.  **Final Image**: A lean production-ready image containing only the necessary PHP extensions, the application code, and compiled assets.

The `docker-compose.prod.yml` file is optimized for performance, including opcache configurations and disabled debugging tools.

## Common Commands

A `Makefile` is provided to simplify common Docker operations:

*   `make up`: Start containers.
*   `make down`: Stop containers.
*   `make shell`: Open a terminal inside the application container.
*   `make test`: Run PHPUnit tests inside the container.

*   **TaskStatsCalculator**: Encapsulates the logic for calculating task statistics shown on the dashboard.
*   **OpenAiResponseTextExtractor**: Handles the complexities of parsing JSON or text responses from the AI, ensuring the advisor classes remain focused on their primary role.

## Database Schema

The application uses SQLite for simplicity and portability in the MVP phase.
*   **tasks**: Stores task details, priority, status, and deadlines.
*   **task_ai_suggestions**: Stores the cached AI suggestions linked to each task, preventing redundant API calls.

## Error Handling and Validation

*   **Custom Requests**: `TaskRequest` handles complex validation logic, such as the hotfix that prevents setting deadlines in the past.
*   **Logging**: Standard Laravel logging is used to track AI communication errors and system exceptions.
