


-- Insert sample data into 'reservations' table with all statuses set to 'pending'
INSERT INTO reservations (user_id, reservation_date, time_slot, number_of_guests, status) VALUES
(1, '2024-11-01', '18:30:00', 2, 'pending'),
(2, '2024-11-02', '19:00:00', 4, 'pending'),
(3, '2024-11-03', '20:00:00', 3, 'pending'),
(4, '2024-11-04', '18:45:00', 5, 'pending'),
(5, '2024-11-05', '19:15:00', 2, 'pending'),
(6, '2024-11-06', '20:30:00', 6, 'pending'),
(7, '2024-11-07', '18:00:00', 2, 'pending'),
(8, '2024-11-08', '19:45:00', 4, 'pending'),
(9, '2024-11-09', '20:15:00', 3, 'pending'),
(10, '2024-11-10', '18:30:00', 1, 'pending');

INSERT INTO reservations (user_id, reservation_date, time_slot, number_of_guests, status, nbrTable)
VALUES (
    (SELECT user_id FROM users WHERE email = 'gregoremendell@gmail.com'),  -- Récupération de l'user_id
    '2024-12-05',   -- Date de la réservation
    '18:00',        -- Créneau horaire (format HH:MM)
    4,              -- Nombre de convives
    'pending',      -- Statut initial de la réservation
    1               -- Numéro de la table (exemple)
);
