<?php

include_once 'clsUser.php';

class clsLogin
{
    public static function Login()
    {
        $currUser = clsUser::Find($_POST['email'], $_POST['pswd']);
        
        if ($currUser != null) 
        {
            $_SESSION['currUser'] = $currUser;
            header("Location:Dashbord-Menu/Home.php");
            exit(); // Stop further execution after redirect
        } 
        else 
        {
            $_SESSION['MessageCnx'] = 'Email/Password is invalid!!';
            header("Location:./Authentication.php");
            exit(); // Stop further execution after redirect
        }
    }
}