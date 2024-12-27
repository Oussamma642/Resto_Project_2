<?php

include_once 'Classes/UserClasses/clsUser.php';
session_start();

if (!isset($_SESSION['currUser']))
{
  header("location:./Authentication.php");  
}

$currUser = $_SESSION['currUser'];

// Check if user has Permission on this page:
if (!$currUser->CheckAccessPermission(Permissions::CommentsSection))
{   
    header("location:Home.php");
}

include_once '.\Classes\CommentsClasses\clsComment.php';

$comments = clsComment::ListComments();


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
    </style>

</head>

<body>

    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar ">
        <div class="sidebar-header mt-5">
            <h3 class="brand ">
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

        <header>
            <h1 style="padding-left: 30%;">Welcome <?=$currUser->getLastName() . ' ' . $currUser->getFirstName()?></h1>
        </header>


        <main>

            <div class="container-fluid mt-5">
                <h2 class="text-center mb-4">Pending Comments</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Handle Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment): ?>
                        <tr>
                            <td><?= htmlspecialchars($comment['FirstName']) ?></td>
                            <td><?= htmlspecialchars($comment['LastName']) ?></td>
                            <td><?= htmlspecialchars($comment['Comment']) ?></td>
                            <td><?= htmlspecialchars($comment['Status']) ?></td>
                            <td>
                                <a
                                    href="./Classes/CommentsClasses/clsModifyComment.php?status=accepted&id=<?=$comment['id']?>">
                                    <button type="button" class="btn btn-danger">Accept</button></a>

                                <a
                                    href="./Classes/CommentsClasses/clsModifyComment.php?status=rejected&id=<?=$comment['id']?>">
                                    <button type="button" class="btn btn-danger">Reject</button></a>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </main>

    </div>



</body>

</html>