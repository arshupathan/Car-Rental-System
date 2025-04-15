<?php
include('../includes/database.php'); // Include the database connection file
@session_start(); // Start the session to track user login status

// Function to get user IP address (simplified version)
function getIPAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous">
    <style>
    /* Custom styles for the page */
    .bg-light {
        font-family: 'Caveat', Algerian;
        font-family: 'Whisper', Algerian;
    }

    body {
        overflow-x: hidden;
        background-color: #b6ddf0; /* Adding background color */
    }
</style>


</head>
<body>
    
<div class="container-fluid">
  <h2 class="text-center mt-5">LOGIN</h2>
  <div class="row d-flex align-items-center justify-content-center">
    <div class="col-lg-12 col-xl-6" id="registration-form">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4">
          <!-- Username field -->
          <label for="user_username" class="form-label">Username</label>
          <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username">
        </div>

        <div class="form-outline mb-4">
          <!-- Password field -->
          <label for="user_password" class="form-label">Password</label>
          <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password">
        </div>

        <div class="mt-4 pt-2">
          <input type="submit" value="Login" class="bg-secondary py-2 px-3 border-1" name="user_login">
          <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_registration.php" class="text-danger">Register</a></p>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<?php
// Check if the login form is submitted
if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
  
    // Query to check if the username exists in the database
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);

    // If the username exists
    if ($row_count > 0) {
        $row_data = mysqli_fetch_assoc($result);

        // Check if the password is correct
        if (password_verify($user_password, $row_data['user_password'])) {
            $_SESSION['username'] = $user_username; // Set session for the logged-in user

            // Redirect to profile page
            echo "<script>alert('Logged in successfully')</script>";
            echo "<script>window.open('profile.php','_self')</script>";
        } else {
            echo "<script>alert('Invalid credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid credentials')</script>";
    }
}
?>

</body>
</html>
