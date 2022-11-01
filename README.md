**First, create database db_shopping
```sh
CREATE DATABASE db_shopping;
```

**Second, Create Two Tables named: Category and Products
```sh
CREATE TABLE category(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(225) NOT null,
    status tinyint DEFAULT 1
);
```

```sh
CREATE TABLE products(
	id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(225),
    status tinyint DEFAULT 0,
    price float,
    sale_price float CHECK(sale_price <= price),
    category_id int,
    image varchar(225),
    FOREIGN KEY (category_id) REFERENCES category(id)
);
```
