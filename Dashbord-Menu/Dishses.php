<?php

include_once '.\Classes\MenuClasses\clsMenu.php';
include_once '.\Classes\MenuClasses\clsModifyDish.php';
include_once '.\Classes\MenuClasses\clsAddNewDish.php';

include_once 'Classes/UserClasses/clsUser.php';
session_start();

if (!isset($_SESSION['currUser']))
{
  header("location:./Authentication.php");  
}

$currUser = $_SESSION['currUser'];

// Check if user has Permission on this page:
if (!$currUser->CheckAccessPermission(Permissions::DishesMenu))
{
    header("location:Home.php");
}

// List Menus
$Menu = clsMenu::ListMenu();

if (isset($_SESSION['Message'])) {
    // Retrieve the message from the session
    $message = $_SESSION['Message'];

    // Display the message in a JavaScript alert
    echo "<script type='text/javascript'>alert('$message');</script>";

    // Clear the message after displaying it so it doesn't show again on refresh
    unset($_SESSION['Message']);
}    


if (isset($_POST['modifyMenu']))
{
    clsModifyDish::ModifyDish();
}

if (isset($_POST['addMenu']))
{
    clsAddNewDish::AddDish();
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


        <div class="container" style="margin-top:100px">
            <div class="row">
                <!-- Button to trigger Add New Dish Modal -->
                <button type="button" class="btn btn-danger ml-3" data-toggle="modal" data-target="#addMenu">
                    Add New Dish
                </button>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Picture</th>
                                <th>Price</th>
                                <th>Modify Item</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php

foreach($Menu as $M){
    ?>
                            <tr>
                                <td style="vertical-align: middle;"><?=$M['name']?></td>
                                <td style="vertical-align: middle;"><?=$M['description']?></td>
                                <td style="vertical-align: middle;"><img
                                        style="width:200px;height:200px; object-fit: cover; border-radius:10px"
                                        src="<?=$M['picturePath']?>" alt=""></td>
                                <td style="vertical-align: middle;"><?=$M['price']?></td>
                                <td style="vertical-align: middle;">
                                    <div class="dropdown">
                                        <button class="dropbtn">Handle Status</button>
                                        <div class="dropdown-content">

                                            <a data-toggle="modal" data-target="#modifyMenu"
                                                onclick="populateForm(<?= htmlspecialchars(json_encode($M)) ?>)">
                                                <button class="btn btn-danger">Modify
                                                    Item</button>
                                            </a>
                                            <a onclick="return confirm('Are you sure you want to delete this item?');"
                                                href="./Classes/MenuClasses/clsDeleteDish.php?id=<?=$M['item_id']?>">
                                                <button class="btn btn-danger">Delete
                                                    Item</button>
                                            </a>
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

    </div>


    <!-- Add New Dish Modal -->
    <div class="modal fade" id="addMenu" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMenuLabel">Add New Dish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addForm" method="post" enctype="multipart/form-data">
                        <!-- Dish Name -->
                        <div class="form-group">
                            <label for="addName"><b>Dish Name:</b></label>
                            <input type="text" class="form-control" id="addName" name="Name" required>
                        </div>
                        <!-- Description-->
                        <div class="form-group">
                            <label for="addDescription"><b>Description:</b></label>
                            <input type="text" class="form-control" id="addDescription" name="Description" required>
                        </div>
                        <!-- Picture -->
                        <div class="form-group">
                            <label for="addPhoto"><b>Picture:</b></label>
                            <input type="file" class="form-control" id="addPhoto" accept="image/*" name="photo"
                                required>
                        </div>
                        <!-- Price -->
                        <div class="form-group">
                            <label for="addPrice"><b>Price:</b></label>
                            <input type="number" class="form-control" id="addPrice" name="Price" required>
                        </div>
                        <!-- Submit -->
                        <button type="submit" name="addMenu" class="btn btn-primary">Add Dish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Modify Modal -->
    <div class="modal fade" id="modifyMenu" tabindex="-1" aria-labelledby="modifyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyModalLabel">Modify Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modifyForm" method="post" enctype="multipart/form-data">

                        <!-- User ID -->
                        <div class="form-group">
                            <label for="id"><b>Item ID:</b></label>
                            <input type="text" readonly class="form-control" id="id" name="id">
                        </div>

                        <!-- Dish Name -->
                        <div class="form-group">
                            <label for="Name"><b>Dish Name:</b></label>
                            <input type="text" class="form-control" id="Name" name="Name" required>
                        </div>
                        <!-- Description-->
                        <div class="form-group">
                            <label for="Description"><b>Description:</b></label>
                            <input type="text" class="form-control" id="Description" name="Description" required>
                        </div>

                        <!-- Picutre -->
                        <div class="form-group">
                            <label for="photo"><b>Picture:</b></label>
                            <div>
                                <img id="oldImage" src="" alt="Old Image"
                                    style="width:200px;height:200px;object-fit: cover; border-radius:10px;">
                            </div>
                            <input type="file" class="form-control" id="photo" accept="image/*" name="photo" required>
                            <input type="hidden" id="oldImagePath" name="oldImagePath">
                        </div>
                        <!-- Price -->
                        <div class="form-group">
                            <label for="Price"><b>Price:</b></label>
                            <input type="number" class="form-control" id="Price" name="Price" required>
                        </div>
                        <!-- Submit -->
                        <button type="submit" name="modifyMenu" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
    function populateForm(user) {
        document.getElementById('id').value = user.item_id;
        document.getElementById('Name').value = user.name;
        document.getElementById('Description').value = user.description;
        document.getElementById('Price').value = user.price;
        var oldImage = document.getElementById('oldImage');
        oldImage.src = user.picturePath;

        document.getElementById('oldImagePath').value = user.picturePath;
        // Further logic to populate permissions if needed
    }
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>