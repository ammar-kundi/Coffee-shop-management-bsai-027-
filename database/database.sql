-- Coffee Shop Menu Management System Database

CREATE TABLE menu_items (
    item_id INT PRIMARY KEY AUTO_INCREMENT,
    item_name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    availability VARCHAR(20) DEFAULT 'Available',
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data (optional)
INSERT INTO menu_items (item_name, category, price, description, availability) VALUES
('Espresso', 'Coffee', 2.50, 'Strong and bold black coffee', 'Available'),
('Cappuccino', 'Coffee', 3.50, 'Espresso with steamed milk and foam', 'Available'),
('Latte', 'Coffee', 3.75, 'Smooth espresso with velvety milk', 'Available'),
('Green Tea', 'Tea', 2.75, 'Fresh and healthy green tea', 'Available'),
('Chocolate Croissant', 'Pastry', 4.00, 'Buttery croissant with chocolate filling', 'Available');
