DROP DATABASE IF EXISTS Project;
CREATE DATABASE Project;

USE Project; 

Create table admin(
Id int primary key auto_increment,
Name varchar(100) not null,
Email varchar(100) not null,
Password varchar(100) not null,
Role varchar(50) null default ‘member’
);

CREATE TABLE category(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    status TINYINT NULL DEFAULT '1'
);

CREATE TABLE product(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE, 
    price FLOAT NOT NULL,
    sale FLOAT NULL DEFAULT '0',
    image VARCHAR(200) NOT NULL,
    category_id INT NOT NULL,
    status TINYINT NULL DEFAULT '1',
    FOREIGN KEY(category_id) REFERENCES category(id) 
);

CREATE TABLE customer(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    address VARCHAR(255) NULL,
    status TINYINT NULL DEFAULT '1'
);

CREATE TABLE orders(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NULL,
    email VARCHAR(100) NULL, 
    phone VARCHAR(100) NULL,
    address VARCHAR(255) NULL,
    customer_id INT NOT NULL,
    status TINYINT NULL DEFAULT '1',
    order_note VARCHAR(255) NULL,
    FOREIGN KEY (customer_id) REFERENCES customer(id)
);

CREATE TABLE order_detail(
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price FLOAT NOT NULL,
    PRIMARY KEY (order_id, product_id),
    FOREIGN KEY(order_id) REFERENCES orders(id),
    FOREIGN KEY(product_id) REFERENCES product(id)
);

CREATE TABLE favorite(
    customer_id INT NOT NULL,
    product_id INT NOT NULL,
    PRIMARY KEY (customer_id, product_id),
    FOREIGN KEY(customer_id) REFERENCES customer(id),
    FOREIGN KEY(product_id) REFERENCES product(id)
);

CREATE TABLE comments(
    customer_id INT NOT NULL,
    product_id INT NOT NULL,
    comment TEXT NOT NULL,
    status TINYINT NULL DEFAULT '1',
    PRIMARY KEY (customer_id, product_id),
    FOREIGN KEY(customer_id) REFERENCES customer(id),
    FOREIGN KEY(product_id) REFERENCES product(id)
);

CREATE TABLE ratings(
    customer_id INT NOT NULL,
    product_id INT NOT NULL,
    stars FLOAT NOT NULL,
    PRIMARY KEY (customer_id, product_id),
    FOREIGN KEY(customer_id) REFERENCES customer(id),
    FOREIGN KEY(product_id) REFERENCES product(id)
);

CREATE TABLE rentals(
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    PRIMARY KEY (order_id, product_id),
    FOREIGN KEY(order_id) REFERENCES orders(id),
    FOREIGN KEY(product_id) REFERENCES product(id)
);

Insert into admin(name,email,password,Role) values
('admin root','admin@gmail.com','123456','admin'),
('Trần Văn Nam','namtv@gmail.com','123456','number');



Insert into 'category' ('id','name','status') values
(1,'Burger',1),
(2,'pizza',1),
(3,'Khoai tây chiên'1);



Insert into 'product' ('id','name','price','sale','image','description','category_id','status') values
(1,'Burger gà',40000,20,),
(2,'Pizza hải sản',200000,15,)










