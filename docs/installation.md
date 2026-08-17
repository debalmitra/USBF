# Installation

This guide explains how to install and run Usoftech Framework.

Docker is the recommended development environment.

The framework itself does not depend on Docker. Docker simply provides a
consistent PHP, web server and database environment.

---

## 1. Requirements

Before starting, make sure you have:

- Git (if cloning the repository)
- Docker
- Docker Compose

PHP and Composer are also required when working directly on the host.

Check Docker:

```bash
docker --version
```

Check Docker Compose:

```bash
docker compose version
```

If both commands work, Docker is ready.

---

# 2. Get the Project

Clone the repository:

```bash
git clone <repository>
```

Move into the project directory:

```bash
cd usoftech-framework
```

If you already have the project files, simply open a terminal in the
project root.

The project root should contain:

```text
composer.json
composer.lock
.env.example
compose/
core/
docs/
public/
views/
```

---

# 3. Create the Environment File

Copy the example environment file:

```bash
cp .env.example .env
```

On Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Open `.env` and configure the application.

Example:

```ini
APP_DEBUG=true

DB_TYPE=mysql
DB_HOST=127.0.0.1
DB_NAME=your_database
DB_USER=your_username
DB_PASSWORD=your_password
DB_PORT=3306
```

For Docker, the database host normally needs to match the database
service name defined in `compose/compose.yml`.

Do not copy database settings blindly. Use the values defined by your
Docker Compose configuration.

Never commit a real `.env` file containing passwords or other secrets.

---

# 4. Docker Files

Docker configuration is kept inside:

```text
compose/
├── Dockerfile
└── compose.yml
```

## Dockerfile

The `Dockerfile` defines the application container environment.

It can define:

- PHP version
- Apache
- PHP extensions
- Composer
- Required server configuration

## compose.yml

The `compose.yml` file defines the development services.

A typical environment contains:

```text
Application
     ↓
PHP + Apache
     ↓
MySQL / MariaDB
```

The actual service names, ports and database settings are defined by the
project's `compose.yml`.

---

# 5. Build the Environment

From the project root:

```bash
docker compose -f compose/compose.yml build
```

This builds the Docker images.

When the `Dockerfile` changes, rebuild the image before starting the
application.

---

# 6. Start the Application

Start the environment in the background:

```bash
docker compose -f compose/compose.yml up -d
```

Build and start at the same time:

```bash
docker compose -f compose/compose.yml up -d --build
```

The second command is useful after changing the Dockerfile.

---

# 7. Check the Containers

Check the project's Compose services:

```bash
docker compose -f compose/compose.yml ps
```

You can also see all running Docker containers:

```bash
docker ps
```

To see stopped containers too:

```bash
docker ps -a
```

The application and database containers should show as running.

---

# 8. Open the Application

The Docker web server should use:

```text
public/
```

as its document root.

The request flow is:

```text
Browser
   ↓
Docker
   ↓
Apache
   ↓
public/
   ↓
index.php
   ↓
Master
   ↓
Router
```

Open the application using the host and port configured in
`compose/compose.yml`.

Do not expose the project root as the web root.

The following directories should remain outside direct web access:

```text
core/
config/
docs/
views/
vendor/
```

---

# 9. Install Composer Dependencies

If Composer dependencies are installed during the Docker build, no
additional command is required.

Otherwise, run Composer inside the application container.

For a service named `app`:

```bash
docker compose -f compose/compose.yml exec app composer install
```

If the service has a different name, use the service name from
`compose.yml`.

To regenerate the Composer autoloader:

```bash
docker compose -f compose/compose.yml exec app composer dump-autoload
```

---

# 10. Check PHP

Check the PHP version inside the application container:

```bash
docker compose -f compose/compose.yml exec app php -v
```

This is useful because the PHP version inside Docker is the version that
actually runs the application.

---

# 11. Check Composer

Check Composer inside the application container:

```bash
docker compose -f compose/compose.yml exec app composer --version
```

---

# 12. Open a Container Shell

To work directly inside the application container:

```bash
docker compose -f compose/compose.yml exec app bash
```

If Bash is not available:

```bash
docker compose -f compose/compose.yml exec app sh
```

Once inside the container, normal commands can be used.

For example:

```bash
php -v
```

or:

```bash
composer --version
```

Exit the container:

```bash
exit
```

---

# 13. View Logs

View all service logs:

```bash
docker compose -f compose/compose.yml logs
```

Follow the logs:

```bash
docker compose -f compose/compose.yml logs -f
```

To view only the application service:

```bash
docker compose -f compose/compose.yml logs -f app
```

Use the actual service name defined in `compose.yml`.

Logs are one of the first places to check when the application does not
start correctly.

---

# 14. Restart the Environment

Restart the running services:

```bash
docker compose -f compose/compose.yml restart
```

Or stop and start them again:

```bash
docker compose -f compose/compose.yml down
docker compose -f compose/compose.yml up -d
```

---

# 15. Stop the Environment

Stop and remove the project containers:

```bash
docker compose -f compose/compose.yml down
```

This normally removes the containers and Compose network.

Project files on the host are not removed.

---

# 16. Rebuild After Changes

When the Dockerfile changes:

```bash
docker compose -f compose/compose.yml up -d --build
```

For a completely fresh Docker image build:

```bash
docker compose -f compose/compose.yml build --no-cache
```

Then start the environment:

```bash
docker compose -f compose/compose.yml up -d
```

Use `--no-cache` only when a normal rebuild is not enough.

---

# 17. Reset the Docker Environment

To stop the services and remove their containers:

```bash
docker compose -f compose/compose.yml down
```

To also remove the Compose volumes:

```bash
docker compose -f compose/compose.yml down -v
```

**Be careful with `-v`.**

If the database uses a Docker volume, removing the volume can remove the
database data stored in that volume.

Only use this command when you intentionally want to reset the database
environment.

---

# 18. Daily Development Workflow

After the first installation, the normal workflow is simple.

Start:

```bash
docker compose -f compose/compose.yml up -d
```

Check:

```bash
docker compose -f compose/compose.yml ps
```

Develop and test the application.

View logs when required:

```bash
docker compose -f compose/compose.yml logs -f
```

Stop when finished:

```bash
docker compose -f compose/compose.yml down
```

If Docker configuration changed:

```bash
docker compose -f compose/compose.yml up -d --build
```

---

# 19. Common Docker Commands

The most useful commands are:

| Purpose | Command |
|---|---|
| Build | `docker compose -f compose/compose.yml build` |
| Start | `docker compose -f compose/compose.yml up -d` |
| Build + Start | `docker compose -f compose/compose.yml up -d --build` |
| Stop | `docker compose -f compose/compose.yml down` |
| Restart | `docker compose -f compose/compose.yml restart` |
| Status | `docker compose -f compose/compose.yml ps` |
| Logs | `docker compose -f compose/compose.yml logs` |
| Follow logs | `docker compose -f compose/compose.yml logs -f` |
| Shell | `docker compose -f compose/compose.yml exec app bash` |
| PHP version | `docker compose -f compose/compose.yml exec app php -v` |
| Composer install | `docker compose -f compose/compose.yml exec app composer install` |
| Rebuild without cache | `docker compose -f compose/compose.yml build --no-cache` |
| Remove volumes | `docker compose -f compose/compose.yml down -v` |

The `app` service name is an example. Always use the actual service name
defined in `compose.yml`.

---

# 20. First Successful Test

After starting Docker, verify the following:

### Containers

```bash
docker compose -f compose/compose.yml ps
```

The required services should be running.

### Application

Open the configured application URL in a browser.

### Framework

The welcome page should load.

### Database

If the application uses the database, verify that the database
connection works.

### Documentation

Open the Framework Guide and verify that the Markdown documentation
loads correctly.

---

# 21. Manual Installation Without Docker

Docker is recommended, but it is not required.

The framework can also run using a normal PHP environment.

Install:

- PHP 8.2+
- Composer
- Apache or Nginx
- MySQL or MariaDB when required

Install Composer dependencies:

```bash
composer install
```

Configure `.env`.

Configure the web server document root to:

```text
public/
```

Then open the application through the configured web server.

---

# 22. Important Web Root Rule

The most important installation rule is:

> `public/` is the web root.

Do not configure the project root as the public web directory.

Correct:

```text
project/
├── core/
├── docs/
├── vendor/
├── views/
└── public/    ← web root
```

Incorrect:

```text
project/       ← do not expose the whole project
```

Keeping `public/` as the web root protects framework source files,
configuration, documentation and Composer dependencies from direct
browser access.

---

# Installation Complete

Once Docker is running and the application opens successfully, the
framework is ready for development.

The basic process is:

```text
Install
   ↓
Configure .env
   ↓
Build Docker
   ↓
Start Docker
   ↓
Check containers
   ↓
Open application
   ↓
Start building
```

Usoftech Framework is intentionally designed so that installation stays
simple.

Once the environment is running, application development can focus on
the actual project rather than framework setup.
