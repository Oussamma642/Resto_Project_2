<?php

// include_once '../UserClasses/clsUser.php';

include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\UserClasses\clsUser.php';

include_once 'clsReservation.php';

class clsAddNewReservation{
    
    private static function _CheckForms(){

        return (
            isset($_POST['lastName']) &&
            isset($_POST['email']) &&
            isset($_POST['phoneNumber']) &&
            isset($_POST['nbrGuests']) &&
            isset($_POST['date']) &&
            isset($_POST['time']) 
        );
    }

    public static function AddNewReservation()
    {
        if (self::_CheckForms()) {
            // Initialisation de l'ID utilisateur
            $usrId = null;
    
            // Recherche de l'utilisateur existant
            $currUser = clsUser::Find($_POST['email'], '0000');
    
            if ($currUser === null) {  
                // Si l'utilisateur n'existe pas, le créer
                $currUser = new clsUser(
                    null, 
                    trim($_POST['firstName']), 
                    trim($_POST['lastName']), 
                    trim($_POST['email']), 
                    '0000', 
                    trim($_POST['phoneNumber']), 
                    'client', 
                    0
                );
    
                $currUser->Save();
            } 

            $usrId = $currUser->getUserId();
    
            // Calcul du nombre de tables nécessaires
            $nbrGuests = (int) $_POST['nbrGuests'];
            $nbrTables = ($nbrGuests > 4) ? ceil($nbrGuests / 4) : 1;
    
            // Ajouter la réservation
            $result = clsReservation::AddNewReservation(
                $usrId,
                $_POST['date'],
                $_POST['time'],
                $nbrGuests,
                $nbrTables
            );
    
            // Vérifier si la réservation a été ajoutée avec succès
            if ($result) {
                echo '<script> console.log("Réservation ajoutée avec succès.") </script>';
            } else {
                echo '<script> console.error("Erreur : impossible d\'ajouter la réservation.") </script>';
            }
    
            // Nettoyage
            unset($currUser);
        }
    }
}