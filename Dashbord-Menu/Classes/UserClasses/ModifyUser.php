<?php
include_once 'clsUser.php';

class clsModifyUser
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
    
    public static function ModifyUser()
    {
        if (isset($_POST['id']) && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phoneNumber']) && isset($_POST['permissions'])) {

            $perms = $_POST['permissions'];
                        
            if (in_array(-1, $perms)) 
                self::$_permissions = -1; 
            else 
                self::handlePermissions($perms);
                
            $updatedUser = new clsUser(
                $_POST['id'], 
                trim($_POST['firstName']), 
                trim($_POST['lastName']), 
                trim($_POST['email']), 
                trim($_POST['password']), 
                trim($_POST['phoneNumber']), 
                'admin', 
                self::$_permissions
            );
                $_SESSION['updateUserStatus'] = ($updatedUser->Update())? 
                "The user has been succufully updated" : 
                "Failed to update the user";
            unset($updatedUser);
        } 
        else 
            $_SESSION['updateUserStatus'] = "Missing fields, please check your form.";
        
        header("location:../Dashbord-Menu/Users.php");
        exit();
    }
}