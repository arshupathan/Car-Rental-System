<?php 
include('../includes/database.php'); // Ensure the path is correct
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <style>
        .bg-light {
            font-family: 'Caveat', Algerian;
        }
        body {
            background-color: #b6ddf0;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <h2 class="text-center"><strong><i>New User Registration</i></strong></h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Username -->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your username" required name="user_username">
                </div>
                <!-- Email -->
                <div class="form-outline mb-4">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" id="user_email" class="form-control" placeholder="Enter your email" required name="user_email">
                </div>
                <!-- Image -->
                <div class="form-outline mb-4">
                    <label for="user_image" class="form-label">User Image</label>
                    <input type="file" id="user_image" class="form-control" required name="user_image">
                </div>
                <!-- Password -->
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" required name="user_password">
                </div>
                <!-- Confirm Password -->
                <div class="form-outline mb-4">
                    <label for="conf_user_password" class="form-label">Confirm Password</label>
                    <input type="password" id="conf_user_password" class="form-control" placeholder="Confirm your password" required name="conf_user_password">
                </div>
                <!-- Address -->
                <div class="form-outline mb-4">
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" id="user_address" class="form-control" placeholder="Enter your address" required name="user_address">
                </div>
                <!-- Contact -->
                <div class="form-outline mb-4">
                    <label for="user_contact" class="form-label">Contact</label>
                    <input type="text" id="user_contact" class="form-control" placeholder="Enter your contact" required name="user_contact">
                </div>
                <!-- Submit Button -->
                <div class="mt-4 pt-2">
                    <input type="submit" value="Register" class="bg-secondary py-2 px-3 border-1" name="user_register">
                    <p class="small fw-bold mt-2 pt-1 mb-4">Already have an account? <a href="user_login.php" class="text-danger">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

<?php
if (isset($_POST['user_register'])) {
    $user_username = mysqli_real_escape_string($conn, $_POST['user_username']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $user_password = $_POST['user_password'];
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = mysqli_real_escape_string($conn, $_POST['user_address']);
    $user_contact = mysqli_real_escape_string($conn, $_POST['user_contact']);
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];

    // Validate email format
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
        exit();
    }

    // Validate contact format (10 digits)
    if (!preg_match('/^[0-9]{10}$/', $user_contact)) {
        echo "<script>alert('Invalid contact number');</script>";
        exit();
    }

    // Password mismatch check
    if ($user_password !== $conf_user_password) {
        echo "<script>alert('Passwords do not match');</script>";
        exit();
    }

    // Check for existing username
    $select_query = "SELECT * FROM user_table WHERE username=?";
    $stmt_select = mysqli_prepare($conn, $select_query);
    mysqli_stmt_bind_param($stmt_select, "s", $user_username);
    mysqli_stmt_execute($stmt_select);
    $result_query = mysqli_stmt_get_result($stmt_select);

    if (mysqli_num_rows($result_query) > 0) {
        echo "<script>alert('Username already exists');</script>";
    } else {
        // Hash password
        $hash_password = password_hash($user_password, PASSWORD_DEFAULT);

        // Ensure upload directory exists
        $upload_directory = "./user_images/";
        if (!is_dir($upload_directory)) {
            mkdir($upload_directory, 0755, true);
        }

        // Move uploaded file
        $upload_path = $upload_directory . $user_image;
        move_uploaded_file($user_image_tmp, $upload_path);

        // Insert new user
        $insert_query = "INSERT INTO user_table (username, user_email, user_password, user_image, user_address, user_mobile) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt_insert, "ssssss", $user_username, $user_email, $hash_password, $user_image, $user_address, $user_contact);

        if (mysqli_stmt_execute($stmt_insert)) {
            echo "<script>alert('Registration successful');</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
