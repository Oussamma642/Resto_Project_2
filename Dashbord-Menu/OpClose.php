<?php

include_once 'Classes/UserClasses/clsUser.php';

session_start();
if (!isset($_SESSION['currUser']))
{
    header("location:../Authentication.php");
}

$currUser = $_SESSION['currUser'];

// Check if user has Permission on this page:
if (!$currUser->CheckAccessPermission(Permissions::OpClose))
{
    header("location:Home.php");
}


include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\OpeningClosingClasses\clsOpeningClose.php';
$list = clsOpeningClose::ListOpCl();

if (isset($_POST['btn']))
{
    if (isset($_POST['open']) && isset($_POST['close']) && isset($_POST['id']) )
    {
        $status = clsOpeningClose::Modify($_POST['id'], $_POST['open'], $_POST['close']);
        header("location:OpClose.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="../css_1/style.css">
    <link rel="stylesheet" href="../css_1/bootstrap.css">

</head>

<style>
a {
    text-decoration: none;
    /* Retains the link’s original color */
}
</style>

<body>

    <input type="checkbox" id="sidebar-toggle">

    <div class="sidebar">
        <div class="sidebar-header mt-5">
            <h3 class="brand">
                <span class="ti-unlink"></span>
                <span>Admin-Menu</span>
            </h3>
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="Home.php">
                        <span class="ti-home"></span>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="ti-calendar"></span>
                        <span><a href="Reservations.php">Reservations</a></span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="ti-user"></span>
                        <span><a href="Users.php">Users</a></span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="ti-email"></span>
                        <span><a href="Contact.php">Contact</a></span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="ti-time"></span>
                        <span><a href="OpClose.php">Ouverture/Fermeture</a></span>
                    </a>
                </li>
                <li>
                    <a href="Logout.php">
                        <span class="ti-power-off"></span>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>



    <div class="main-content">

        <div class="container">
            <div class="row">
                <div class="col-sm-12 mt-5">

                    <h2 class="text-center">
                        Opening/Closing Time
                    </h2>

                    <table class="table table-striped mt-5 ">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Opening</th>
                                <th>Closing</th>
                                <th>Modify</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
    foreach($list as $l)
    {
        ?>
                            <form method="post">
                                <tr>
                                    <td> <?=$l['Dy']?></td>
                                    <td> <input class="form-control" name="open" type="time"
                                            value="<?=$l['ouverture']?>">
                                    </td>
                                    <td> <input class="form-control" name="close" type="time"
                                            value="<?=$l['fermeture']?>">
                                    </td>
                                    <td>
                                        <input type="hidden" name="id" value="<?= $l['id'] ?>">
                                        <input name='btn' type="submit" class="btn btn-danger" value="Modify">
                                    </td>
                                </tr>
                            </form>
                            <?php
    }
?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="table-responsive">
        </div>

    </div>

    </div>

</body>

</html>