INSERT INTO order_items (order_id, item_id, quantity, price)
VALUES
(1, 1, 2, 12.50), -- Commande 1, item 1, quantité 2
(1, 3, 1, 8.00),  -- Commande 1, item 3, quantité 1
(2, 2, 1, 15.00), -- Commande 2, item 2, quantité 1
(2, 4, 3, 6.00),  -- Commande 2, item 4, quantité 3
(3, 1, 1, 12.50), -- Commande 3, item 1, quantité 1
(3, 5, 2, 7.50),  -- Commande 3, item 5, quantité 2
(4, 2, 2, 15.00), -- Commande 4, item 2, quantité 2
(5, 3, 3, 8.00),  -- Commande 5, item 3, quantité 3
(6, 1, 1, 12.50), -- Commande 6, item 1, quantité 1
(6, 4, 2, 6.00),  -- Commande 6, item 4, quantité 2
(7, 3, 1, 8.00),  -- Commande 7, item 3, quantité 1
(8, 5, 2, 7.50),  -- Commande 8, item 5, quantité 2
(9, 2, 1, 15.00), -- Commande 9, item 2, quantité 1
(9, 3, 2, 8.00),  -- Commande 9, item 3, quantité 2
(10, 1, 1, 12.50),-- Commande 10, item 1, quantité 1
(10, 4, 1, 6.00); -- Commande 10, item 4, quantité 1


-- Insérer la commande pour l'utilisateur Oussama Sami-Mohamed
INSERT INTO orders (user_id, status, delivery_method, delivery_address, description)
VALUES (
    (SELECT user_id FROM users WHERE email = 'gregoremendell@gmail.com'), -- Récupérer user_id
    'pending',  -- Statut de la commande
    'unpaid',  -- Statut du paiement
    'takeaway',  -- Méthode de livraison
    'N/A',  -- Adresse de livraison (N/A pour takeaway)
    NULL  -- Description (aucune description spécifique)
);

-- Insérer un ou plusieurs articles dans la commande (exemple avec un article)
INSERT INTO order_items (order_id, item_id, quantity, price)
VALUES (
    (SELECT order_id FROM orders WHERE user_id = (SELECT user_id FROM users WHERE email = 'gregoremendell@gmail.com') ORDER BY order_date DESC LIMIT 1), -- Récupérer le dernier order_id de l'utilisateur
    1,  -- Item ID de l'article
    1,  -- Quantité commandée
    100.00  -- Prix de l'article
);
