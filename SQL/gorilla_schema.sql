CREATE TABLE Customers (
    customer_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone_number VARCHAR(13) NOT NULL,
    city VARCHAR(255) NOT NULL,
    country VARCHAR(50) NOT NULL,
    street_address VARCHAR(255) NOT NULL
);

CREATE TABLE Tshirts (
    tshirt_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    baseprice DECIMAL(10,2) NOT NULL,
    discounted_price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    size VARCHAR(2) NOT NULL,
    gender VARCHAR(6) NOT NULL,
    quantity INT NOT NULL,
    discount DECIMAL(10,2) NOT NULL,
    category VARCHAR(255) NOT NULL
);

CREATE TABLE Cart_Items (
    cart_id INT PRIMARY KEY AUTO_INCREMENT,
    image_url VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    size VARCHAR(10) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    tshirt_id INT NOT NULL,
    customer_id INT NOT NULL,
    CONSTRAINT fk_cartitems_1 FOREIGN KEY (tshirt_id) REFERENCES Tshirts(tshirt_id),
    CONSTRAINT fk_cartitems_2 FOREIGN KEY (customer_id) REFERENCES Customers(customer_id)
);

CREATE TABLE CustomerOrders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT NOT NULL,
    tshirt_id INT NOT NULL,
    quantity INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) NOT NULL,
    city VARCHAR(255) NOT NULL,
    country VARCHAR(50) NOT NULL,
    street_address VARCHAR(255) NOT NULL,
    CONSTRAINT fk_customer_order_customer FOREIGN KEY (customer_id) REFERENCES Customers(customer_id),
    CONSTRAINT fk_customer_order_tshirt FOREIGN KEY (tshirt_id) REFERENCES Tshirts(tshirt_id)
);

CREATE TABLE AllOrders (
    allorder_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    tshirt_id INT NOT NULL,
    quantity INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) NOT NULL,
    city VARCHAR(255) NOT NULL,
    country VARCHAR(50) NOT NULL,
    street_address VARCHAR(255) NOT NULL,
    CONSTRAINT fk_all_order_customer FOREIGN KEY (order_id) REFERENCES CustomerOrders(order_id),
    CONSTRAINT fk_all_order_tshirt FOREIGN KEY (tshirt_id) REFERENCES Tshirts(tshirt_id)
);
