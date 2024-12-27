<?php

include_once 'clsReservation.php';

class clsModifyReservation 
{
    private static function CheckForms(): bool
    {
        if (isset($_GET['id']) && isset($_GET['status']) && isset($_GET['email']) && isset($_GET['lname'])) {
            if (in_array($_GET['status'], ['pending', 'confirmed', 'canceled'])) {
                return true;
            }
        }
        return false;
    }

    public static function ModifyReservation(): void
    {
        if (self::CheckForms()) 
        {
            session_start();
         
            // public static function ModifyReservation($id, $status, $email, $lname) : bool

            $_SESSION['Message'] = (clsReservation::ModifyReservation($_GET['id'], $_GET['status'], $_GET['email'], $_GET['lname'])) ? 
            "The status changed succufully!!" :
            "Failed to change the status!!";
        } 
        else 
        {
            $_SESSION['Message'] = "Missing filed, check your form!";
        }
        header("location:../../Reservations.php");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    clsModifyReservation::ModifyReservation();
}