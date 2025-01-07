<?php

include_once 'clsContact.php';

class clsModifyContact
{
    public static function ModifyContact()
    {
        if (
            isset($_POST['contactId']) &&
            isset($_POST['name']) && 
            isset($_POST['email']) && 
            isset($_POST['subject']) &&
            isset($_POST['reponse']) &&
            !empty(trim($_POST['reponse']))
        ) 
        
        {
            $cnt_id = ($_POST['contactId']);
            $mod = clsContact::ModifyContact($cnt_id, $_POST['reponse'],$_POST['email'] , 'resolved');
            if ($mod) {
                clsContact::SendMail($_POST['email'], $_POST['name'] , $_POST['subject'], $_POST['reponse']);
                return true;
            }
            
        } 
        else {
            return false;
        }
        header("location:../Dashbord-Menu/Contact.php");
        exit();
    }
}