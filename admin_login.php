<?php
include('../includes/database.php');
@session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      .bg-light {
        font-family: 'Caveat', Algerian;
        font-family: 'Whisper', Algerian;
      }
      body {
        overflow-x: hidden;
      }
    </style>
</head>
<body>
<div class="container-fluid">
  <h2 class="text-center mt-5">Admin Login</h2>
  <div class="row d-flex align-items-center justify-content-center">
    <div class="col-lg-12 col-xl-6" id="registration-form">
      <form action="" method="post">
        <div class="form-outline mb-4">
          <!-- Username field -->
          <label for="admin_name" class="form-label">Admin Name</label>
          <input type="text" id="admin_name" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="admin_name">
        </div>
        <div class="form-outline mb-4">
          <!-- Password field -->
          <label for="admin_password" class="form-label">Password</label>
          <input type="password" id="admin_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="admin_password">
        </div>
        <div class="mt-4 pt-2">
          <input type="submit" value="Login" class="bg-secondary py-2 px-3 border-1" name="admin_login">
          <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="admin_registration.php" class="text-danger">Register</a></p>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

<?php
if (isset($_POST['admin_login'])) {
    $admin_name = mysqli_real_escape_string($con, $_POST['admin_name']);
    $admin_password = $_POST['admin_password'];

    // Securely fetch admin data
    $stmt = $con->prepare("SELECT * FROM `admin_table` WHERE admin_name = ?");
    $stmt->bind_param("s", $admin_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row_data = $result->fetch_assoc();
        $stored_password = $row_data['admin_password'];

        // Verify password
        if (password_verify($admin_password, $stored_password)) {
            $_SESSION['admin_name'] = $admin_name;
            echo "<script>alert('Logged in successfully');</script>";
            echo "<script>window.open('index1.php','_self');</script>";
        } else {
            echo "<script>alert('Incorrect password!');</script>";
        }
    } else {
        echo "<script>alert('Admin not found!');</script>";
    }

    $stmt->close();
}
$con->close();
?>
