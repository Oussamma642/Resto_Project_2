<?php

include_once 'clsMenu.php';

class clsAddNewDish {

    private static function _CheckForms(){
        // Vérifie si tous les champs nécessaires sont présents et que le fichier photo est bien téléchargé
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            if (
                isset($_POST['Name']) && 
                isset($_POST['Description']) && 
                isset($_POST['Price'])
            ) {
                return true;
            }
        }
        return false;
    }

    public static function AddDish() {
        // Vérifie les données du formulaire
        if (self::_CheckForms()) {

            // Récupère les détails du fichier téléchargé
            $fileTmpPath = $_FILES['photo']['tmp_name'];
            $fileName = $_FILES['photo']['name'];
            $fileSize = $_FILES['photo']['size'];
            $fileType = $_FILES['photo']['type'];

            // Dossier pour les photos téléchargées
            $uploadDir = 'uploads/';
            
            // Crée le dossier s'il n'existe pas
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Génère un nom unique pour éviter les conflits
            $fileNameNew = uniqid('img_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

            // Déplace le fichier téléchargé dans le dossier de destination
            $destPath = $uploadDir . $fileNameNew;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Chemin relatif du fichier téléchargé
                $relativePath = 'uploads/' . $fileNameNew;

                // Appelle la méthode pour ajouter l'élément de menu
                $m = clsMenu::addMenuItem($_POST['Name'], $_POST['Description'], $relativePath, $_POST['Price']);
                
                // Si l'insertion a réussi, redirige vers la page des plats
             
            }
        
        }
    
        header("location:../Dashbord-Menu/Dishses.php");

    }
}

?>