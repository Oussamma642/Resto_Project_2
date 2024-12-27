<?php

include_once 'Classes/UserClasses/clsUser.php';

session_start();

if (!isset($_SESSION['currUser']))
{
    header("location:../Authentication.php");
}

$currUser = $_SESSION['currUser'];

if (!$currUser->CheckAccessPermission(Permissions::Reservation))
{
    header("location:Home.php");
}

include_once '.\Classes\ReservationClasses\clsLstReservation.php';

$reservations = clsListReservation::LstReservation();

/* Show the message of the modification on a reservation within alert JS function */

if (isset($_SESSION['Message'])) {
    // Retrieve the message from the session
    $message = $_SESSION['Message'];

    // Display the message in a JavaScript alert
    echo "<script type='text/javascript'>alert('$message');</script>";

    // Clear the message after displaying it so it doesn't show again on refresh
    unset($_SESSION['Message']);
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

    <style>
    /* Style of Button Handle Staut  */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropbtn {
        width: 100px;
        /* border-radius: 30%; */
        border-radius: 10%;

        width: 150px;
        height: 50px;

    }

    .dropdown:hover .dropbtn {

        border-radius: 0%;
        background-color: rgb(156, 85, 85);
        color: white;
    }
    </style>


</head>

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
                        <span class="ti-agenda"></span>
                        <span><a href="Orders.php">Orders</a></span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="ti-clipboard"></span>
                        <span><a href="Dishses.php">Dishes Menu</a></span>
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
                        <span class="ti-comment"></span>
                        <span><a href="Comments.php">Comments</a></span>
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
                        <span><a href="OpClose.php">Opening/Closing Time</a></span>
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

        <header>
            <div class="search-wrapper mt-2">
                <span class="ti-search"></span>
                <input type="search" placeholder="Search">
            </div>

        </header>

        <main>

            <h2 class="dash-title">Overview</h2>

            <div class="dash-cards">
                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-close"></span>
                        <div class="mt-4">
                            <h5>Canceled</h5>
                            <h4>30</h4>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-reload"></span>
                        <div class="mt-4">
                            <h5>Pending</h5>
                            <h4>19</h4>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-check-box"></span>
                        <div class="mt-4">
                            <h5>Confirmed</h5>
                            <h4>20</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <h1 class="dash-title">Reservations Field</h1> -->

            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-bordered mt-3" style="margin-bottom:150px">
                            <thead>
                                <tr>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Reservation Date</th>
                                    <th>Time</th>
                                    <th>Tables</th>
                                    <th>Guests Number</th>
                                    <th>Status</th>
                                    <th>Handle Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
        foreach ($reservations as $r) {
            // Choix de la classe CSS en fonction du statut
            $rowClass = '';
            if ($r['status'] === 'confirmed') {
                $rowClass = 'table-success'; // Vert pour confirmed
            } elseif ($r['status'] === 'canceled') {
                $rowClass = 'table-danger'; // Rouge pour canceled
            } elseif ($r['status'] === 'pending') {
                $rowClass = 'table-warning'; // Jaune pour pending
            }
        ?>
                                <tr class="<?= $rowClass ?>">
                                    <td><?= $r['last_name'] ?></td>
                                    <td><?= $r['email'] ?></td>
                                    <td><?= $r['reservation_date'] ?></td>
                                    <td><?= $r['time_slot'] ?></td>
                                    <td><?= $r['nbrTable'] ?></td>
                                    <td><?= $r['number_of_guests'] ?></td>
                                    <td><?= $r['status'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropbtn">Handle Status</button>
                                            <div class="dropdown-content">
                                                <a
                                                    href="./Classes/ReservationClasses/clsModifyReservation.php?status=pending&id=<?= $r['reservation_id'] ?>&email=<?= $r['email'] ?>&lname=<?= $r['last_name'] ?>">Pending</a>
                                                <a
                                                    href="./Classes/ReservationClasses/clsModifyReservation.php?status=confirmed&id=<?= $r['reservation_id'] ?>&email=<?= $r['email'] ?>&lname=<?= $r['last_name'] ?>">Confirm</a>
                                                <a
                                                    href="./Classes/ReservationClasses/clsModifyReservation.php?status=canceled&id=<?= $r['reservation_id'] ?>&email=<?= $r['email'] ?>&lname=<?= $r['last_name'] ?>">Cancel</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
        }
        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>

</html>