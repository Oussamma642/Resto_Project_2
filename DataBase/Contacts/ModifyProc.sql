

CREATE TABLE contacts (
    contact_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL,
    subject VARCHAR(255) NOT NULL,  -- Objet du message de contact
    message TEXT NOT NULL,
    status ENUM('pending', 'resolved', 'archived') DEFAULT 'pending', -- Statut du message
    response text DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date de création
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Dernière mise à jour
);


drop procedure if exists UpdateContactResponse;
delimiter //

create procedure UpdateContactResponse(
        IN p_contact_id INT,         -- ID du contact à mettre à jour
        IN p_admin_response TEXT,    -- Réponse de l'admin
        IN p_status ENUM('pending', 'resolved', 'archived') -- Nouveau statut
    )
begin
    -- Mise à jour de la table contacts
    UPDATE contacts
    SET 
        response = p_admin_response, -- Ajout de la réponse de l'admin
        status = p_status,           -- Mise à jour du statut
        updated_at = CURRENT_TIMESTAMP -- Mise à jour de l'horodatage
    WHERE 
        contact_id = p_contact_id;   -- Filtrer par ID de contact

end //
delimiter ;

-- ***************************************************************************
DELIMITER //
CREATE PROCEDURE UpdateContactResponse(
    IN p_contact_id INT,         -- ID du contact à mettre à jour
    IN p_admin_response TEXT,    -- Réponse de l'admin
    IN p_email VARCHAR(100),
    IN p_status ENUM('pending', 'resolved', 'archived') -- Nouveau statut
)
BEGIN
    -- Mise à jour de la table contacts
    UPDATE contacts
    SET 
        response = p_admin_response, -- Ajout de la réponse de l'admin
        status = p_status,           -- Mise à jour du statut
        updated_at = CURRENT_TIMESTAMP -- Mise à jour de l'horodatage
    WHERE 
        contact_id = p_contact_id and email=p_email;   -- Filtrer par ID de contact

    -- Vérifier si l'enregistrement a été mis à jour
    IF ROW_COUNT() = 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Aucun contact trouvé avec cet ID';
    END IF;
END //

DELIMITER ;



