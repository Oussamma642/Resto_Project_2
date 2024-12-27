<?php


include_once 'clsComment.php';

class clsModifyComment{

    private static function _checkForms(){

        return isset($_GET['id']) && isset($_GET['status']);
    
    }

    public static function ModifyComment()
    {   
        if (self::_checkForms()){
            $result = clsComment::ModifyComment($_GET['id'], $_GET['status']);

            if ($result) {
                $_SESSION['Message'] = "The comment has been seuccufully" . " " . $status;
            } else {
                $_SESSION['Message'] = "Failed to update comment status";
            }
        }
        else {
            $_SESSION['Message'] = "Missing required parameters";
        }
        
        header("location:../../Comments.php");
    }
}

clsModifyComment::ModifyComment();



// include_once 'clsComment.php'; // Vérifiez que le fichier inclut la classe appropriée

// class clsModifyComment {

//     // Vérifie la présence des paramètres nécessaires
//     private static function _checkForms() {
//         return isset($_GET['id']) && isset($_GET['status']);
//     }

//     // Méthode principale pour modifier le commentaire
//     public static function ModifyComment() {

//         if (self::_checkForms()) {
//             $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);            
//             $status = filter_var($_GET['status'], FILTER_SANITIZE_STRING);

//             try {
//                 $result = clsComment::ModifyComment($id, $status); // Assurez-vous que clsComment est la classe correcte
//                 if ($result) {
//                     $_SESSION['Message'] = "The comment has been seuccufully" . " " . $status;
//                 } else {
//                     $_SESSION['Message'] = "Failed to update comment status";
//                 }
//             } catch (Exception $e) {
//                 echo "Error: " . $e->getMessage();
//             }
//         } else {
//             $_SESSION['Message'] = "Missing required parameters";
//         }
        
//         header("location:../../Comments.php");
//     }
// }

// clsModifyComment::ModifyComment();

// echo $_GET['id'] . '  '. $_GET['status'] . '<br>';