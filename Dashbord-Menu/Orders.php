<?php

include_once 'Classes/UserClasses/clsUser.php';

session_start();

if (!isset($_SESSION['currUser']))
{
    header("location:../Authentication.php");
}

$currUser = $_SESSION['currUser'];

// Check if user has Permission on this page:
if (!$currUser->CheckAccessPermission(Permissions::Orders))
{
    header("location:Home.php");
}


include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\OrderClasses\LstOrders.php';
$orders = OrderList();

/* Show the message of the modification on an order within alert JS function */
// Check if a message is set in the session
if (isset($_SESSION['Message'])) {
    // Retrieve the message from the session
    $message = $_SESSION['Message'];

    // Display the message in a JavaScript alert
    echo "<script type='text/javascript'>alert('$message');</script>";

    // Clear the message after displaying it so it doesn't show again on refresh
    unset($_SESSION['Message']);
}

// Nbr_Orders_Pending
$nbrPending = clsOrders::nbrOrder_Pending();

// Nbr_Orders_Completed
$nbrCompleted = clsOrders::nbrOrder_Completed();

//Nbr_Orders_Canceled
$nbrCanceled = clsOrders::nbrOrder_Canceled();

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

    .modal-dialog-custom {
        max-width: 80%;
        /* Définit la largeur à 80% de l'écran */
    }

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
                            <h4><?=$nbrCanceled?></h4>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-reload"></span>
                        <div class="mt-4">
                            <h5>Pending</h5>
                            <h4><?=$nbrPending?></h4>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-check-box"></span>
                        <div class="mt-4">
                            <h5>Completed</h5>
                            <h4><?=$nbrCompleted?></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped mt-4" style="margin-bottom:150px">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Delivery Method</th>
                                    <th>Adress</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($orders as $or)
                                    {   
                                          // Choix de la classe CSS en fonction du statut
            $rowClass = '';
            if ($or['status'] === 'completed') {
                $rowClass = 'table-success'; // Vert pour confirmed
            } elseif ($or['status'] === 'canceled') {
                $rowClass = 'table-danger'; // Rouge pour canceled
            } elseif ($or['status'] === 'pending') {
                $rowClass = 'table-warning'; // Jaune pour pending
            }
                                    ?>
                                <tr class="<?= $rowClass ?>">
                                    <td><?=$or['last_name']?></td>
                                    <td><?=$or['email']?></td>
                                    <td><?=$or['order_date']?></td>
                                    <td><?=$or['delivery_method']?></td>
                                    <td><?=$or['delivery_address']?></td>
                                    <td><?=$or['status']?></td>

                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#modifyOrder"
                                            onclick="fetchOrderDetails(<?=$or['order_id']?>, '<?=$or['email']?>', '<?=$or['last_name']?>')">
                                            See details
                                        </button>
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
            <!-- Modify Order -->
            <div class="modal fade" id="modifyOrder" tabindex="-1" aria-labelledby="modifyModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-custom">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modifyModalLabel">Modify User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <table class="table table-bordered mt-4">
                                <thead>
                                    <tr>
                                        <th>Dish Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody id="orderDetails">

                                </tbody>
                            </table>

                            <div class="container mt-4">
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-4" id="orderTotal">
                                        <!-- Infos come from js -->
                                    </div>
                                    <div class="col-sm-4" id="links">
                                        <!-- Here the links of accept/cancel will be shwon from js -->
                                    </div>
                                    <div class="col-sm-2"></div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>

    <script>
    function fetchOrderDetails(orderId, email, lname) {
        const BASE_URL = `http://localhost/Resto_Project/Dashbord-Menu/Classes/OrderClasses`;

        const fetchDetails = async () => {


            const response = await fetch(`${BASE_URL}/order_items.php?orderId=${orderId}`);
            const data = await response.json();

            let detailsTable = '';

            for (let i = 0; i < data.length; i++) {
                detailsTable += `
            <tr>
                <td>${data[i].DishName}</td>
                <td>${data[i].price}</td>
                <td>${data[i].quantity}</td>
            </tr>
            `;
            }

            document.getElementById('orderDetails').innerHTML = detailsTable;

            // Total Amount 
            const totalResponse = await fetch(`${BASE_URL}/order_total.php?orderId=${orderId}`);

            if (!totalResponse.ok) throw new Error('Failed to fetch total amount');

            const totalData = await totalResponse.json();

            if (totalData.error) {
                console.error(totalData.error);
                document.getElementById('orderTotal').innerHTML = 'Error fetching total amount';
                return;
            }
            document.getElementById('orderTotal').innerHTML =
                `<p style="font-size:30px" id="orderTotal">Total Amount: <b>$${totalData.total_amount}</b> </p>`;

            // Add the links:
            document.getElementById('links').innerHTML = `
            <a href="./Classes/OrderClasses/ModifyOrder.php?id=${orderId}&status=completed&email=${email}&lname=${lname}" class="btn btn-outline-danger">Accept</a>
                    
            <a href="./Classes/OrderClasses/ModifyOrder.php?id=${orderId}&status=canceled&email=${email}&lname=${lname}" class="btn btn-outline-danger">Cancel</a>       
                `;
        }
        fetchDetails();
    }
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>