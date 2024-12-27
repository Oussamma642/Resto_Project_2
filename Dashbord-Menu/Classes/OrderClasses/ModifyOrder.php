<?php


function ModifyOrder()
{
    include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\OrderClasses\MainClass.php';
    session_start();


    if (isset($_GET['id']) && isset($_GET['status']) && isset($_GET['email']) && isset($_GET['lname']))
    {

        if (clsOrders::ModifyOrder($_GET['id'], $_GET['status'], $_GET['email'],$_GET['lname']))
        {
            $_SESSION['Message'] = "The Order has been " . $_GET['status'] ." succufully!!";
        } 
    }
    else
    {
        $_SESSION['Message'] = "The Order is unkown!!";
    }
    // Redirect back to Reservations.php
    header("Location: ../../Orders.php");
    exit();  // Make sure no further code is executed after the redirect
}
ModifyOrder();

// if (isset($_GET['id']) && isset($_GET['status']) && isset($_GET['email']) && isset($_GET['lname'])){
//     echo "Yes<br>";
//     echo $_GET['id'] . "<br>";
//     echo $_GET['status'] . "<br>";
//     echo $_GET['email'] . "<br>";
//     echo $_GET['lname'] . "<br>";
// }
// else
// echo "NO";