

CREATE TABLE Customers 
	(customer_id INT PRIMARY KEY AUTO_INCREMENT,
	first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	phone_number VARCHAR(13) NOT NULL,
  city VARCHAR(255) NOT NULL,
  country VARCHAR(50) NOT NULL,
  street_address VARCHAR(255) NOT NULL);

CREATE TABLE Tshirts (
  tshirt_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  image_url VARCHAR(255) NOT NULL,
  size VARCHAR(2) NOT NULL,
  gender VARCHAR(6) NOT NULL,
  quantity INT NOT NULL,
  discount INT NOT NULL,
  category VARCHAR(255) NOT NULL);

CREATE TABLE Orders (
  order_id INT PRIMARY KEY AUTO_INCREMENT,
  customer_id INT NOT NULL,
  cart_id INT NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
  order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  status VARCHAR(50) NOT NULL,
  city VARCHAR(255) NOT NULL,
  country VARCHAR(50) NOT NULL,
  street_address VARCHAR(255) NOT NULL,
  CONSTRAINT fk_order_customer FOREIGN KEY (customer_id) REFERENCES Customers(customer_id));
  
  ALTER TABLE Orders
  ADD CONSTRAINT fk_order_cart FOREIGN KEY (cart_id) REFERENCES Cart_Items(cart_id);

CREATE TABLE Cart_Items (
  cart_id INT PRIMARY KEY AUTO_INCREMENT,
  image_url VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  size VARCHAR(10) NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  order_id INT NULL,
  tshirt_id INT NOT NULL,
  customer_id INT NOT NULL,
  CONSTRAINT fk_cartitems1 FOREIGN KEY (order_id) REFERENCES Orders(order_id),
  CONSTRAINT fk_cartitems2 FOREIGN KEY (tshirt_id) REFERENCES Tshirts(tshirt_id) ON DELETE CASCADE,
  CONSTRAINT fk_cartitems_3 FOREIGN KEY (customer_id) REFERENCES Customers(customer_id));

