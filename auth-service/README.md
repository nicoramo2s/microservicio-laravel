# Auth Service

Este servicio es responsable de la autenticación y autorización de usuarios en la aplicación.

## Requisitos

- PHP >= 8
- Composer
- Laravel Framework

## Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/nicoramo2s/microservicio-laravel.git
    ```

2. Navega al directorio del proyecto:
    ```bash
    cd auth-service
    ```

3. Instala las dependencias:
    ```bash
    composer install
    ```

4. Copia el archivo `.env.example` a `.env` y configura las variables de entorno según sea necesario:
    ```bash
    cp .env.example .env
    ```

5. Copia las claves JWT_SECRET Y APP_KEY

6. Ejecuta las  demigraciones la base de datos:
    ```bash
    php artisan migrate
    ```

## Uso

Para iniciar el servidor de desarrollo, ejecuta:
```bash
php artisan serve
```
El servicio estará disponible en http://localhost:8000.