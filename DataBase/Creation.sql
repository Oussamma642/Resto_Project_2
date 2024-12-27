
CREATE DATABASE Restaurant;
USE Restaurant;


CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'client') NOT NULL,
    phone_number VARCHAR(20),
    permissions int,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT into users(first_name, last_name, email, password, role, phone_number, permissions)
VALUES ('Oussama', 'AIT-MOHAMED', 'user1@gmail.com', '1111', 'admin', '06060606', -1);

INSERT into users (first_name, last_name, email, password, role, phone_number, permissions)
VALUES ('', '', '@gmail.com', '4444', 'client', '06060606', 0);
VALUES ('Oussama', 'SAMI-MOHAMED', 'gregoremendell@gmail.com', '9999', 'client', '0652155542', 0);

CREATE TABLE menu_items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    picturePath VARCHAR(255),  -- Correction de la longueur pour l'image
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    reservation_date DATE NOT NULL,
    time_slot TIME NOT NULL,
    number_of_guests INT NOT NULL,  -- Suppression du CHECK
    status ENUM('pending', 'confirmed', 'canceled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);


CREATE TABLE reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    reservation_date DATE NOT NULL,
    time_slot TIME NOT NULL,
    nbrTables int not null check (nbrTables <=20),
    number_of_guests INT NOT NULL check (number_of_guests <= 4 * nbrTables),  -- Suppression du CHECK
    status ENUM('pending', 'confirmed', 'canceled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);


ALTER TABLE reservations
ADD COLUMN nbrTable INT;

ALTER TABLE reservations
MODIFY COLUMN nbrTable INT DEFAULT 1;

ALTER TABLE reservations
ADD CONSTRAINT check_nbrTable CHECK (nbrTable BETWEEN 1 AND 20);

ALTER TABLE reservations
MODIFY COLUMN number_of_guests INT NOT NULL;

ALTER TABLE reservations
ADD CONSTRAINT check_number_of_guests CHECK (number_of_guests <= 4 * nbrTable);


CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'completed', 'canceled') DEFAULT 'pending',
    delivery_method ENUM('takeaway', 'delivery') NOT NULL,
    delivery_address VARCHAR(255),
    description TEXT DEFAULT NULL,  -- Colonne description pour les commandes spécifiques
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);


CREATE TABLE order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,  -- Référence à la commande
    item_id INT NOT NULL,   -- Référence à l'article du menu
    quantity INT NOT NULL,  -- Quantité commandée
    price DECIMAL(10, 2) NOT NULL,  -- Prix de l'article au moment de la commande
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES menu_items(item_id) ON DELETE CASCADE
);

CREATE TABLE contacts (
    contact_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,  -- Référence à l'utilisateur qui a écrit le message
    email VARCHAR(150) NOT NULL,
    subject VARCHAR(255) NOT NULL,  -- Objet du message de contact
    message TEXT NOT NULL,
    status ENUM('pending', 'resolved', 'archived') DEFAULT 'pending', -- Statut du message
    response text DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date de création
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Dernière mise à jour
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
);

INSERT INTO contacts (user_id, email, subject, message) 
VALUES (32, '@gmail.com', 'Subject', 'Bonjour bro how are you doing');

CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    rating INT NOT NULL,  -- Suppression de CHECK, s'assurer de le valider au niveau de l'application
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);
w
create table OuvertureFermeture()
{
    id int primary key AUTO_INCREMENT,
    ouverture time,
    fermeture time,
    Dy VARCHAR(30)
}

alter table users
add column permissions int DEFAULT -1;