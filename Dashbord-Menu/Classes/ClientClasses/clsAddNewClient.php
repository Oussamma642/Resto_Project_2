<?php

include_once 'clsClient';

class clsAddNewClient
{
    public static function AddNewClient()
    {
        if (isset($_POST['firstName']) && 
        isset($_POST['lastName']) && 
        isset($_POST['email']) && 
        isset($_POST['password']) && 
        isset($_POST['phoneNumber'])) {

            $newUser = new clsClient(
                null, 
                trim($_POST['firstName']), 
                trim($_POST['lastName']), 
                trim($_POST['email']), 
                trim($_POST['password']), 
                trim($_POST['phoneNumber']), 
                'client', 
                0
            );
            
                $_SESSION['addClientStatus'] = ($newUser->Save())? 
                "The Client has been succufully added" : 
                "Failed to Add the user";
            
            unset($newUser);
        } 
        else 
            $_SESSION['addClientStatus'] = "Missing fields, please check your form.";
        
        header("location:../Dashbord-Menu/index.php");
        exit();
        
    }
}