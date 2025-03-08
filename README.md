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
    - `total_amount` (decimal): The total amount of the order sale.
    - `user_id` (integer): The ID of the user associated with the order sale.
  - **Response**: Returns the created order sale.

- **GET /api/order-sales/{id}**
  - **Description**: Retrieve a specific order sale by ID.
  - **Response**: Returns the details of the specified order sale.

- **PUT /api/order-sales/{id}**
  - **Description**: Update a specific order sale by ID.
  - **Request Body**:
    - `customer_name` (string): The name of the customer.
    - `total_amount` (decimal): The total amount of the order sale.
    - `user_id` (integer): The ID of the user associated with the order sale.
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
    - `order_sale_id` (integer): The ID of the order sale associated with the product.
    - `user_id` (integer): The ID of the user associated with the product.
  - **Response**: Returns the updated product.

- **DELETE /api/products/{id}**
  - **Description**: Delete a specific product by ID.
  - **Response**: Returns a 204 No Content status on successful deletion.

### Notes

- All routes are prefixed with `/api`.
- The `auth:sanctum` middleware is used for authentication on the `/api/user` route.
- The `OrderSaleController` and `ProductController` handle the respective resource routes for order sales and products.

This document provides a summary of the available API routes and their respective functionalities. For more details, refer to the api.php file and the respective controllers.