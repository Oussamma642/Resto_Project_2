
INSERT INTO orders (user_id, order_date, status, delivery_method, delivery_address, description)
VALUES
(1, NOW(), 'pending',  'takeaway', NULL, 'Commande spéciale sans livraison'),
(2, NOW(), 'pending',  'delivery', '123 Rue de Paris, Paris', NULL),
(3, NOW(), 'pending',  'takeaway', NULL, 'Commande pour anniversaire'),
(4, NOW(), 'pending',  'delivery', '456 Avenue du Marché, Lyon', NULL),
(5, NOW(), 'pending',  'takeaway', NULL, NULL),
(6, NOW(), 'pending',  'delivery', '789 Boulevard des Fleurs, Marseille', NULL),
(7, NOW(), 'pending',  'takeaway', NULL, 'Sans gluten'),
(8, NOW(), 'pending',  'delivery', '1010 Rue du Lac, Bordeaux', NULL),
(9, NOW(), 'pending',  'takeaway', NULL, NULL),
(10, NOW(), 'pending', 'delivery', '11 Rue de la Mer, Nice', NULL);
