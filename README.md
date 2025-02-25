# Microservicios Laravel

## Descripción

Este proyecto consiste en una arquitectura de microservicios utilizando Laravel. Cada servicio está diseñado para manejar una parte específica de la aplicación, permitiendo una mayor escalabilidad y mantenibilidad.

## Estructura del Proyecto

## Servicios

### Auth Service

Este servicio se encarga de la autenticación y autorización de usuarios.

#### Endpoints

- `POST /api/v1/auth/register`: Registro de nuevos usuarios.
- `POST /api/v1/auth/login`: Inicio de sesión de usuarios.
- `POST /api/v1/auth/logout`: Cierre de sesión de usuarios.
- `GET /api/v1/auth/user`: Obtener información del usuario autenticado.

### Inventory Service

Este servicio maneja la gestión de inventarios.

- `GET /api/v1/products`: Listar todos los productos en inventario.
- `POST /api/v1/products`: Agregar un nuevo producto al inventario.
- `PUT /api/v1/products/{id}`: Actualizar información de un producto específico.
- `DELETE /api/v1/products/{id}`: Eliminar un producto del inventario.

### Mail Service

Este servicio se encarga del envío de correos electrónicos.

#### Endpoints

- `POST /api/v1/mail/send`: Enviar un correo electrónico.

### Order Service

Este servicio maneja la gestión de pedidos.

#### Endpoints

- `GET /api/v1/orders`: Listar todos los pedidos.
- `POST /api/v1/orders`: Crear un nuevo pedido.
- `GET /api/v1/orders/{id}`: Obtener detalles de un pedido específico.
- `PUT /api/v1/orders/{id}`: Actualizar un pedido específico.
- `DELETE /api/v1/orders/{id}`: Eliminar un pedido.

## Instalación

1. Clona el repositorio:
    ```sh
    git clone https://github.com/tu-usuario/microlaravel.git
    ```

2. Navega a cada servicio e instala las dependencias:
    ```sh
    cd auth-service
    composer install
    npm install

    cd ../inventory-service
    composer install
    npm install

    cd ../mail-service
    composer install
    npm install

    cd ../order-service
    composer install
    npm install
    ```

3. Configura los archivos `.env` en cada servicio.

4. Configura las variables de entorno y levanta los servicios con Docker Compose:
    ```sh
    docker-compose up -d
    ```

## Uso

Cada servicio expone una serie de endpoints que pueden ser utilizados para interactuar con la aplicación.

Asegurate de que las `APP_KEY` y `JWT_SECRET` sean las mismas en cada servicio, generalas con:
```bash
php artisan key:generate
```
```bash
php artisan jwt:secret
```

