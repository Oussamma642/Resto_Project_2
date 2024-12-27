

DELIMITER //

CREATE PROCEDURE Modify_OuvertureFermeture(
    IN ID INT,
    IN ouv TIME,
    IN ferm TIME
)
BEGIN
    UPDATE OuvertureFermeture
    SET ouverture = ouv,
        fermeture = ferm
    WHERE id = ID;
END //

DELIMITER ;
