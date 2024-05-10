
-- CUSTOMER TABLE INSERT QUERY

INSERT INTO customers (first_name, last_name, username, password, email, phone_number, city, country, street_address) 
VALUES 
  ('John', 'Doe', 'johndoe123', 'password123', 'johndoe@example.com', '1234567890', 'New York', 'USA', '123 Main St'),
  ('Jane', 'Smith', 'janesmith', 'password456', 'janesmith@example.com', '0987654321', 'Los Angeles', 'USA', '456 Elm St'),
  ('Michael', 'Johnson', 'mike', 'pass123', 'mike@example.com', '9876543210', 'Canada', NULL, '789 Oak St'),
  ('Emily', 'Brown', 'emilyb', 'pass456', 'emily@example.com', '1239874560', 'London', 'UK', '456 Pine St'),
  ('Alex', 'Davis', 'alexd', 'pass789', 'alex@example.com', '4563217890', 'Berlin', 'Germany', NULL),
  ('Sophia', 'Wilson', 'sophiaw', 'pass987', 'sophia@example.com', NULL, 'Paris', 'France', '789 Maple St'),
  ('William', 'Martinez', 'willm', 'pass654', NULL, '4567890123', 'Madrid', 'Spain', '123 Oak St'),
  ('Olivia', 'Garcia', NULL, 'pass321', 'olivia@example.com', '7890123456', 'Rome', 'Italy', '456 Maple St'),
  ('Daniel', 'Rodriguez', 'danr', NULL, 'daniel@example.com', '9870123456', 'Sydney', 'Australia', '789 Pine St'),
  ('Emma', NULL, 'emma', 'pass999', 'emma@example.com', '6543210987', 'Tokyo', 'Japan', '456 Oak St');

-- T_SHIRTS TABLE INSERT QUERY

INSERT INTO t_shirts (name, description, price, image_url, size, gender, quantity, discount, category) 
VALUES 
  ('Plain White T-Shirt', 'Classic white t-shirt made from soft cotton fabric', 19.99, 'plain_white_tshirt.jpg', 'M', 'Unisex', 100, 0, 'Casual'),
  ('Black Graphic Tee', 'Black t-shirt featuring a cool graphic print on the front', 24.99, 'black_graphic_tshirt.jpg', 'L', 'Unisex', 50, 10, 'Graphic'),
  ('Striped Polo Shirt', 'Blue and white striped polo shirt with a collar', 29.99, 'striped_polo_shirt.jpg', 'S', 'Men', 80, 5, 'Casual'),
  ('Floral Print Blouse', 'Flowy blouse with a colorful floral print', 34.99, 'floral_print_blouse.jpg', 'M', 'Women', 60, 15, 'Blouse'),
  ('V-Neck Sweater', 'Warm sweater with a V-neck design, perfect for layering', 39.99, 'vneck_sweater.jpg', 'L', 'Men', 40, 20, 'Sweater'),
  ('Denim Jacket', 'Classic denim jacket with front pockets and metal buttons', 49.99, 'denim_jacket.jpg', 'XL', 'Unisex', 30, 10, 'Jacket'),
  ('Printed Hoodie', 'Hooded sweatshirt with a unique printed design', 44.99, 'printed_hoodie.jpg', 'M', 'Men', 70, 0, 'Hoodie'),
  ('Long Sleeve Shirt', 'White shirt with long sleeves, ideal for formal occasions', 34.99, 'longsleeve_shirt.jpg', 'S', 'Women', 90, 10, 'Shirt'),
  ('Sporty Tank Top', 'Black tank top made from moisture-wicking fabric', 19.99, 'sporty_tank.jpg', 'L', 'Women', 120, 0, 'Sportswear'),
  ('Plaid Flannel Shirt', 'Classic plaid flannel shirt in red and black color scheme', 29.99, 'plaid_flannel.jpg', 'XL', 'Men', 50, 15, 'Shirt');

-- ORDERS TABLE INSERT QUERY

INSERT INTO Orders (customer_id, prod_name, prod_quantity, total_price, status, city, country, street_address) 
VALUES 
  (1, 'Plain White T-Shirt', 2, 39.98, 'Pending', 'New York', 'USA', '123 Main St'),
  (2, 'Black Graphic Tee', 1, 24.99, 'Shipped', 'Los Angeles', 'USA', '456 Elm St'),
  (3, 'Striped Polo Shirt', 3, 89.97, 'Delivered', 'Toronto', 'Canada', '789 Oak St'),
  (4, 'Floral Print Blouse', 1, 34.99, 'Pending', 'London', 'UK', '456 Pine St'),
  (5, 'V-Neck Sweater', 2, 79.98, 'Shipped', 'Berlin', 'Germany', '123 Oak St'),
  (6, 'Denim Jacket', 1, 49.99, 'Delivered', 'Paris', 'France', '789 Maple St'),
  (7, 'Printed Hoodie', 2, 89.98, 'Pending', 'Madrid', 'Spain', '456 Elm St'),
  (8, 'Long Sleeve Shirt', 1, 34.99, 'Shipped', 'Rome', 'Italy', '789 Pine St'),
  (9, 'Sporty Tank Top', 3, 59.97, 'Delivered', 'Sydney', 'Australia', '456 Maple St'),
  (10, 'Plaid Flannel Shirt', 2, 59.98, 'Pending', 'Tokyo', 'Japan', '789 Oak St');


-- CART_ITEMS INSERT QUERY

INSERT INTO Cart_Items (image_url, name, size, quantity, price, order_id, tshirt_id) 
VALUES 
  ('plain_white_tshirt.jpg', 'Plain White T-Shirt', 'M', 2, 19.99, 1, 1),
  ('black_graphic_tshirt.jpg', 'Black Graphic Tee', 'L', 1, 24.99, 2, 2),
  ('striped_polo_shirt.jpg', 'Striped Polo Shirt', 'S', 3, 29.99, 3, 3),
  ('floral_print_blouse.jpg', 'Floral Print Blouse', 'M', 1, 34.99, 4, 4),
  ('vneck_sweater.jpg', 'V-Neck Sweater', 'L', 2, 39.99, 5, 5),
  ('denim_jacket.jpg', 'Denim Jacket', 'XL', 1, 49.99, 6, 6),
  ('printed_hoodie.jpg', 'Printed Hoodie', 'M', 2, 44.99, 7, 7),
  ('longsleeve_shirt.jpg', 'Long Sleeve Shirt', 'S', 1, 34.99, 8, 8),
  ('sporty_tank.jpg', 'Sporty Tank Top', 'L', 3, 19.99, 9, 9),
  ('plaid_flannel.jpg', 'Plaid Flannel Shirt', 'XL', 2, 29.99, 10, 10);
