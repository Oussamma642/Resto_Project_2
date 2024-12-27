<?php

class clsDeleteUser
{
    public static function DeleteUser()
    {
        include_once 'clsUser.php';
        
        session_start();

        $currUser = $_SESSION['currUser'];
        
        if (isset($_GET['id']))
        {
            $reult = $currUser->DeleteUser($_GET['id']);
            $_SESSION['deleteStatus'] = ($reult)? "The user has been succufully deleted" : "Failed to delete this user";
        }
        else
        {
            $_SESSION['deleteStatus'] = "The user has not been found";
        }

        header("location:../../Users.php");

    }
}

clsDeleteUser::DeleteUser();