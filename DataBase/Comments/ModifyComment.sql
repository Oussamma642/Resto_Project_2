
DELIMITER //

CREATE PROCEDURE Update_Comment_Status(
    IN commentId INT,
    IN newStatus ENUM('pending', 'accepted', 'rejected')
)
BEGIN
    -- Vérification de l'existence du commentaire
    IF EXISTS (
        SELECT 1
        FROM reviews
        WHERE review_id = commentId
    ) THEN
        -- Mise à jour du statut du commentaire
        UPDATE reviews
        SET 
            status = newStatus
        WHERE review_id = commentId;
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Comment not found';
    END IF;
END //

DELIMITER ;

