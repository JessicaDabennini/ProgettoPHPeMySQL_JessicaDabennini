-- Creating the products table
CREATE TABLE products (
id INT AUTO_INCREMENT PRIMARY KEY,
product_name VARCHAR(255) NOT NULL,
co2_saved DECIMAL(10, 2) NOT NULL
);

-- Creating the orders table
CREATE TABLE orders (
id INT AUTO_INCREMENT PRIMARY KEY,
sales_date DATE NOT NULL,
destination_country VARCHAR(255) NOT NULL,
product_id INT NOT NULL,
quantity INT NOT NULL,
FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Creating the total_co2_saved view
SELECT 
    SUM(p.co2_saved * o.quantity) AS total_co2
FROM 
    ordini as o
JOIN 
    prodotti as p ON o.prodotto_id = p.id
WHERE 
    o.sales_date BETWEEN :data_start AND :data_end
    AND o.destination_country = :destination_country
    AND p.product_name = :product_name;
