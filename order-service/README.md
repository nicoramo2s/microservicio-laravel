# Order Service

Este servicio maneja la gestión de pedidos en la aplicación.

## Requisitos

- PHP >= 8
- Composer
- Laravel Framework

## Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/nicoramo2s/microservicio-laravel.git
    ```

2. Navega al directorio del servicio de pedidos:
    ```bash
    cd order-service
    ```

3. Instala las dependencias:
    ```bash
    composer install
    ```

4. Copia el archivo `.env.example` a `.env` y configura las variables de entorno según sea necesario:
    ```bash
    cp .env.example .env
    ```

5. Ejecuta las migraciones de la base de datos:
    ```bash
    php artisan migrate
    ```

## Uso

Para iniciar el servidor de desarrollo, ejecuta:
```bash
php artisan serve
```
El servicio estará disponible en http://localhost:8000.