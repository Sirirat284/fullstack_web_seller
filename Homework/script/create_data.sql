CREATE TABLE customer (
custID VARCHAR(10) PRIMARY KEY ,
first_name VARCHAR(255) NOT NULL,
last_name VARCHAR(255) NOT NULL,
gender ENUM('Male', 'Female', 'Other') NOT NULL,
phone_number VARCHAR(15),
address VARCHAR(255),
email VARCHAR(255)
);

CREATE TABLE product (
prodID VARCHAR(10) PRIMARY KEY ,
prodName VARCHAR(255) NOT NULL, 
prodType ENUM('Laptop' , 'PC') NOT NULL,
brand ENUM('asus','acer','apple','lenovo','dell','msi','hp') NOT NULL,
detail VARCHAR(255),
amount INT(5),
price INT(10),
pathphoto VARCHAR(255)
);

CREATE TABLE basket (
    custID VARCHAR(10),
    prodID VARCHAR(10),
    quantity INT(13)
);

CREATE TABLE hearder (
    hearID INT AUTO_INCREMENT PRIMARY KEY,
    custID VARCHAR(10),
    customer_name VARCHAR(255),
    shipping_name VARCHAR(255),
    payment_name VARCHAR(255),
    shipping_address VARCHAR(255),
    phone_number VARCHAR(15),
    status ENUM('กำลังเตรียมสินค้า' , 'จัดเตรียมสินค้าสำเร็จ' , 'กำลังจัดส่งสินค้า' , 'จัดส่งสำเร็จ' , 'ปิดการขาย') ,
    TaxID VARCHAR(255),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
    sent_date TIMESTAMP NULL,
    recipt_date TIMESTAMP NULL,
    success_date TIMESTAMP NULL
);
CREATE TABLE detail (
    detailID INT AUTO_INCREMENT PRIMARY KEY,
    hearID VARCHAR(10) ,
    prodID VARCHAR(10),
    quantity INT(5),
    totalprice INT(8),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

