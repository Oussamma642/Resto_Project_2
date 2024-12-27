<?php

include_once 'clsMenu.php';

class clsDeleteDish{
    
    private static function _CheckForms(){
        return isset($_GET['id']);
    }

    public static function DeleteItem(){
        if (self::_CheckForms()){
            $delete = clsMenu::deleteMenuItem($_GET['id']);

            if($delete){
                $_SESSION['Message'] = "Item has been deleted succesfully";
            }
            else{
                $_SESSION['Message'] = "Failed to delete This Item";
            }
        }
        else{
            $_SESSION['Message'] = "Missing field, check forms";
        }

    header("location:../../Dishses.php");
    }
}

clsDeleteDish::DeleteItem();