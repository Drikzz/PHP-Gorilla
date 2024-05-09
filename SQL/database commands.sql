CREATE DATABASE gorilla_db

CREATE TABLE customers 
	(customer_id INT PRIMARY KEY,
	first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	phone_number VARCHAR(13) NOT NULL);
	
CREATE TABLE addresses (
  address_id INT PRIMARY KEY AUTO_INCREMENT,
  customer_id INT NOT NULL,
  street_address VARCHAR(255) NOT NULL,
  city VARCHAR(255) NOT NULL,
  state_province VARCHAR(100) NOT NULL,
  postal_code VARCHAR(20) NOT NULL,
  country VARCHAR(50) NOT NULL,
  FOREIGN KEY (customer_id) REFERENCES Customers(customer_id)
);

CREATE TABLE t_shirts (
  tshirt_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(10,2) NOT NULL,
  image_url VARCHAR(255) NOT NULL,
  size VARCHAR(2) NOT NULL,
  gender VARCHAR(6) NOT NULL,
  quantity INT NOT NULL,
  discount INT NOT NULL,
  category VARCHAR(255) NOT NULL);

  -- ALTER table for t_shirts
-- ALTER TABLE t_shirts
-- ADD size VARCHAR(2) NOT NULL,
-- ADD gender VARCHAR(6) NOT NULL,
-- ADD quantity INT NOT NULL,
-- ADD discount INT NOT NULL,
-- ADD category VARCHAR(255) NOT NULL;

CREATE TABLE Inventory (
  tshirt_id INT NOT NULL,
  size VARCHAR(10) NOT NULL,
  color VARCHAR(50) NOT NULL,
  stock_level INT NOT NULL,
  PRIMARY KEY (tshirt_id, size, color),
  FOREIGN KEY (tshirt_id) REFERENCES T_Shirts(tshirt_id)
);

CREATE TABLE Orders (
  order_id INT PRIMARY KEY AUTO_INCREMENT,
  customer_id INT NOT NULL,
  product_name VARCHAR(255) NOT NULL,
  prod_quantity INT NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
  order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status VARCHAR(50) NOT NULL,

  address_id INT NOT NULL,
  payment_method_id INT NOT NULL,
  shipping_method_id INT NOT NULL,

  CONSTRAINT fk_order1 FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
  CONSTRAINT fk_order2 FOREIGN KEY (address_id) REFERENCES Addresses(address_id),
  CONSTRAINT fk_order3 FOREIGN KEY (payment_method_id) REFERENCES Payment_Methods(payment_method_id),
  CONSTRAINT fk_order4 FOREIGN KEY (shipping_method_id) REFERENCES Shipping_Methods(shipping_method_id));

--CHANGE THIS SHITT--

-- Payment_Methods table
CREATE TABLE Payment_Methods (
  payment_method_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL
);

-- Shipping_Methods table
CREATE TABLE Shipping_Methods (
  shipping_method_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  cost DECIMAL(10,2) NOT NULL
);

-- Order_Items table (Composite Primary Key)
CREATE TABLE Order_Items (
  order_id INT PRIMARY AUTO_INCREMENT,
  tshirt_id INT PRIMARY,
  image_url VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  size VARCHAR(2) NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  CONSTRAINTS fk_OI1 FOREIGN KEY (order_id) REFERENCES Orders(order_id),
  CONSTRAINTS fk_OI2FOREIGN KEY (tshirt_id) REFERENCES T_Shirts(tshirt_id)
);