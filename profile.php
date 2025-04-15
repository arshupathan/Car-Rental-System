<?php
include('../includes/database.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" />

    <link rel="stylesheet" href="admin/style.css">
    <style>

    /* General Styles */
body {
    font-family: 'Poppins', sans-serif; /* Modern and clean font */
    margin: 0;
    padding: 0;
    background-color: #F3F4F7; /* Light Gray background */
}

/* Navbar Styles */
.navbar {
    background-color: #454545; /* Dark Gray */
    padding: 10px 20px;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin: 0 10px;
    font-weight: 500;
}

.navbar a:hover {
    color: #FFD700; /* Gold */
    text-decoration: underline;
}

/* Sidebar Styles */
.sidebar {
    background-color: #9C27B0; /* Purple */
    color: white;
    padding: 15px;
    height: 100%;
}

.sidebar a {
    color: white;
    text-decoration: none;
    display: block;
    padding: 10px;
    font-size: 14px;
}

.sidebar a:hover {
    color: #FFD700; /* Gold */
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 5px;
}

/* Profile Section */
.profile-section {
    background-color: #E0BBE4; /* Light Purple */
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin: 20px 0;
}

.profile-section .text-center {
    text-align: center;
}

/* Profile Image */
.profile_img {
    height: 150px;
    width: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Button Styles */
.btn-custom {
    background-color: #FF4081; /* Pink */
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-custom:hover {
    background-color: #F50057; /* Darker Pink */
}

/* Custom Backgrounds */
.bg-light {
    background-color: #FFB6C1; /* Light Pink */
    font-family: 'Caveat', cursive; /* Stylish handwritten font */
}

/* Utility Classes */
.text-center {
    text-align: center;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .profile_img {
        height: 120px;
        width: 120px;
    }

    .profile-section {
        padding: 20px;
    }

    .btn-custom {
        font-size: 14px;
        padding: 8px 16px;
    }
}
</style>
</head>
<body>

<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <img src="../user/car-logo.png" alt="Logo" class="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../rent.html">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="user_registration.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contact.html">Contacts</a></li>
                    <li class="nav-item"><a class="nav-link" href="../rent.html">Rent</a></li>
                    <li class="nav-item"><a class="nav-link" href="../payment.php">Payment</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="navbar-nav me-auto">
            <?php
            if (!isset($_SESSION['username'])) {
                echo "<li class='nav-item'><a class='nav-link' href='/PrimeModelHub/admin/index1.php'>Welcome Admin</a></li>";
            } else {
                echo "<li class='nav-item'><a class='nav-link' href='/PrimeModelHub/index.php'>Welcome " . $_SESSION['username'] . "</a></li>";
            }
            if (!isset($_SESSION['username'])) {
                echo "<li class='nav-item'><a class='nav-link' href='/PrimeModelHub/user/user_login.php'>Login</a></li>";
            } else {
                echo "<li class='nav-item'><a class='nav-link' href='/PrimeModelHub/user/user_logout.php'>Logout</a></li>";
            }
            ?>
        </ul>
    </nav>

    <div class="bg-light text-center py-5">
        <h3>Welcome to PrimeModelHub</h3>
        <p>Drive the Extraordinary</p>
    </div>

    <div class="row">
        <div class="col-md-3 sidebar">
            <ul class="navbar-nav text-center">
                <li class="nav-item bg-info">
                    <a class="nav-link text-light" href="#"><h4>Your Profile</h4></a>
                </li>
                <?php
                $username = $_SESSION['username'];
                $user_image_query = "SELECT * FROM user_table WHERE username='$username'";
                $result = mysqli_query($con, $user_image_query);
                $row = mysqli_fetch_assoc($result);
                $user_image = $row['user_image'];
                echo "<li class='nav-item'>
                    <img src='./user_images/$user_image' alt='Profile Image' class='profile_img my-3'>
                 </li>";
                ?>
                <li class="nav-item"><a class="nav-link text-light" href="../rent.html"><h5>Rent</h5></a></li>
                <li class="nav-item"><a class="nav-link text-light" href="profile.php?edit_account"><h5>Edit Account</h5></a></li>
                <li class="nav-item"><a class="nav-link text-light" href="../payment.php"><h5>Payment</h5></a></li>
                <li class="nav-item"><a class="nav-link text-light" href="profile.php?delete_account"><h5>Delete Account</h5></a></li>
                <li class="nav-item"><a class="nav-link text-light" href="user_logout.php"><h5>Logout</h5></a></li>
            </ul>
        </div>

        <div class="col-md-9">
            <div class="profile-section">
                <?php
                if (isset($_GET['my_orders'])) {
                    include('user_orders.php');
                }
                if (isset($_GET['delete_account'])) {
                    include('delete_account.php');
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
