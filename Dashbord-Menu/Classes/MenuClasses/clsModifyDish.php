<?php

include_once 'clsMenu.php';

class clsModifyDish{

    private static function _CheckForms(){
     
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK){
            if (
                isset($_POST['Name']) && 
                isset($_POST['Description']) && 
                isset($_POST['Price'] )){
                    return true;
                }
        }
        return false;
    }

    public static function ModifyDish(){

        if (self::_CheckForms())
        {
        
            // Détails du fichier
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $fileSize = $_FILES['photo']['size'];
        $fileType = $_FILES['photo']['type'];
            
        $uploadDir = 'uploads/'; // Dossier "uploads" dans le même répertoire que le script
        // Créer le dossier s'il n'existe pas
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        // Générer un nom unique pour éviter les conflits
        $fileNameNew = uniqid('img_', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

        // Déplacer le fichier téléchargé dans le dossier de destination
        $destPath = $uploadDir . $fileNameNew;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // Chemin relatif (à enregistrer dans la base de données)
            // $relativePath = 'uploads/' . $fileNameNew;
            //($itemId, $name, $description, $picturePath, $price) {

            $relativePath = 'uploads/' . $fileNameNew;

            $m =  clsMenu::ModifyItem($_POST['id'], $_POST['Name'] ,$_POST['Description'], $relativePath, $_POST['Price']);
            
            if($m){
                header("location:../../Dishses.php");
            }
        } 
    }
}
}

?>