<?php
include_once 'clsUser.php';

class clsAddNewUser
{
    private static $_permissions = 0;

    private static function handlePermissions($perms)
    {
        $validPermissions = [1, 2, 4, 8, 16, 32, 64]; 
        foreach ($perms as $p) 
        {
            if (in_array($p, $validPermissions)) {
                self::$_permissions += $p;
            }
        }
    }
    
    public static function AddNewUser()
    {
        if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phoneNumber']) && isset($_POST['permissions'])) {

            $perms = $_POST['permissions'];
                        
            if (in_array(-1, $perms)) 
                self::$_permissions = -1; 
            else 
                self::handlePermissions($perms);
                
            $newUser = new clsUser(
                null, 
                trim($_POST['firstName']), 
                trim($_POST['lastName']), 
                trim($_POST['email']), 
                trim($_POST['password']), 
                trim($_POST['phoneNumber']), 
                'admin', 
                self::$_permissions
            );
            
                $_SESSION['addUserStatus'] = ($newUser->Save())? 
                "The user has been succufully added" : 
                "Failed to Add the user";
            
            unset($newUser);
        } 
        else 
            $_SESSION['addUserStatus'] = "Missing fields, please check your form.";
        
        header("location:../Dashbord-Menu/Users.php");
        exit();
        
    }
}