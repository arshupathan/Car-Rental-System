<?php
include('../includes/database.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Area</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #E6E6FA;
            overflow-x: hidden;
        }

        .navbar {
            background-color: #ADD8E6;
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo {
            width: 50px;
            height: auto;
        }

        .button-column {
            width: 250px;
            padding: 15px;
            background-color: #E9A8F2;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .button-column .btn {
            display: block;
            width: 100%;
            text-align: left;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            text-decoration: none;
            padding: 10px;
            color: #333;
            background-color: #ADD8E6;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .button-column .btn:hover {
            background-color: #DDA0DD;
            color: white;
        }

        .admin_image {
            width: 100px;
            border-radius: 50%;
            border: 2px solid #ADD8E6;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION['admin_name'])) {
                            $admin_name = $_SESSION['admin_name'];
                        } else {
                            header('Location: admin_login.php');
                        }
                        ?>
                        <a href="#" class="nav-link">Welcome, <?php echo $admin_name; ?></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-3">
                <div class="text-center my-3">
                    <img src="../admin/admin_image/admin_img.webp" alt="Admin" class="admin_image">
                    <p><?php echo $admin_name; ?></p>
                </div>
                <div class="button-column">
                    <a href="../index.php" class="btn">Home</a>
                    <a href="insert_car.php" class="btn">Insert Car</a>
                    <a href="../rent.html" class="btn">View Products</a>
                    <a href="allpayment.html" class="btn">All Payments</a>
                    <a href="user_list.html" class="btn">List Users</a>
                    <a href="admin_logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="container my-3">
                    <?php
                    if (isset($_GET['insert_category'])) include('insert_categories.php');
                    if (isset($_GET['insert_Brands'])) include('insert_brands.php');
                    if (isset($_GET['view_products'])) include('view_products.php');
                    if (isset($_GET['edit_products'])) include('edit_products.php');
                    if (isset($_GET['delete_product'])) include('delete_product.php');
                    if (isset($_GET['view_categories'])) include('view_categories.php');
                    if (isset($_GET['view_brands'])) include('view_brands.php');
                    if (isset($_GET['edit_category'])) include('edit_category.php');
                    if (isset($_GET['edit_brand'])) include('edit_brand.php');
                    if (isset($_GET['delete_category'])) include('delete_category.php');
                    if (isset($_GET['delete_brands'])) include('delete_brands.php');
                    if (isset($_GET['list_orders'])) include('list_orders.php');
                    if (isset($_GET['delete_order'])) include('delete_order.php');
                    if (isset($_GET['list_payments'])) include('list_payments.php');
                    if (isset($_GET['delete_payment'])) include('delete_payment.php');
                    if (isset($_GET['list_users'])) include('list_users.php');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
