### README for API Routes

This document provides an overview of the API routes available in the application. The routes are defined in the api.php file and are loaded by the `RouteServiceProvider` within a group assigned the "api" middleware group.

#### Authentication

- **GET /api/user**
  - **Middleware**: `auth:sanctum`
  - **Description**: Retrieve the authenticated user's information.
  - **Response**: Returns the authenticated user's details.

#### Order Sales

- **GET /api/order-sales**
  - **Description**: Retrieve a list of all order sales.
  - **Response**: Returns a JSON array of order sales.

- **POST /api/order-sales**
  - **Description**: Create a new order sale.
  - **Request Body**:
    - `customer_name` (string): The name of the customer.
    - `user_id` (integer): The ID of the user associated with the order sale.
  - **Response**: Returns the created order sale.

- **GET /api/order-sales/{id}**
  - **Description**: Retrieve a specific order sale by ID.
  - **Response**: Returns the details of the specified order sale.

- **PUT /api/order-sales/{id}**
  - **Description**: Update a specific order sale by ID.
  - **Request Body**:
    - `customer_name` (string): The name of the customer.
  - **Response**: Returns the updated order sale.

- **DELETE /api/order-sales/{id}**
  - **Description**: Delete a specific order sale by ID.
  - **Response**: Returns a 204 No Content status on successful deletion.

#### Products

- **GET /api/products**
  - **Description**: Retrieve a list of all products.
  - **Response**: Returns a JSON array of products.

- **POST /api/products**
  - **Description**: Create a new product.
  - **Request Body**:
    - `name` (string): The name of the product.
    - `price` (decimal): The price of the product.
    - `order_sale_id` (integer): The ID of the order sale associated with the product.
    - `user_id` (integer): The ID of the user associated with the product.
  - **Response**: Returns the created product.

- **GET /api/products/{id}**
  - **Description**: Retrieve a specific product by ID.
  - **Response**: Returns the details of the specified product.

- **PUT /api/products/{id}**
  - **Description**: Update a specific product by ID.
  - **Request Body**:
    - `name` (string): The name of the product.
    - `price` (decimal): The price of the product.
  - **Response**: Returns the updated product.

- **DELETE /api/products/{id}**
  - **Description**: Delete a specific product by ID.
  - **Response**: Returns a 204 No Content status on successful deletion.

### Running the Application

To run the application, you need to have Docker and Docker Compose installed. Follow the steps below to get started:

1. Clone the repository:
    ```sh
    git clone https://github.com/your-repo/ballastlane.git
    cd ballastlane
    ```

2. Build and start the Docker containers:
    ```sh
    docker-compose up -d
    ```

3. Install dependencies and configure the application:
    ```sh
    make configure
    ```

4. Run database migrations:
    ```sh
    make migrate
    ```

5. Seed the database (optional):
    ```sh
    make seed
    ```

6. Run the tests:
    ```sh
    make test
    ```

### Makefile Commands

The Makefile provides several commands to manage the application:

- `make configure`: Install dependencies and configure the application.
- `make test`: Run the tests.
- `make migrate`: Run database migrations.
- `make migrate-rollback`: Rollback the last database migration.
- `make seed`: Seed the database.
- `make load-initial`: Run migrations and seed the database.
- `make recreate`: Stop, remove, and recreate the Docker containers.

### Curl Examples

#### Register a User
```sh
curl -X POST http://localhost/api/register \
    -H "Content-Type: application/json" \
    -d '{
        "name": "John Doe",
        "email": "john@example.com",
        "password": "password",
    }'
```

#### Login a User
```sh
curl -X POST http://localhost/api/login \
    -H "Content-Type: application/json" \
    -d '{
        "email": "john@example.com",
        "password": "password"
    }'
```
#### Logout
```sh
curl -X POST http://localhost/api/logout \
    -H "Content-Type: application/json" \
```

#### Create an Order Sale
```sh
curl -X POST http://localhost/api/order-sales \
    -H "Content-Type: application/json" \
    -d '{
        "customer_name": "John Doe",
        "user_id": 1
    }'
```

#### Create a Product
```sh
curl -X POST http://localhost/api/product \
    -H "Content-Type: application/json" \
    -d '{
        "name": "Sample Product",
        "price": 100,
        "order_sale_id": 1,
        "user_id": 1
    }'
```

### Notes

- All routes are prefixed with `/api`.
- The `auth:sanctum` middleware is used for authentication on the `/api/user` route.

This document provides a summary of the available API routes and their respective functionalities. For more details, refer to the api.php file and the respective controllers.