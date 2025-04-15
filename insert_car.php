<?php
// Database connection
include('../includes/database.php');

if (isset($_POST['insert_car'])) {
    // Fetching form data
    $car_name = mysqli_real_escape_string($con, $_POST['car_name']);
    $car_description = mysqli_real_escape_string($con, $_POST['car_description']);
    $car_keywords = mysqli_real_escape_string($con, $_POST['car_keywords']);
    $car_brand = mysqli_real_escape_string($con, $_POST['car_brand']);
    $car_price = mysqli_real_escape_string($con, $_POST['car_price']);
    $car_status = 'true';

    // Accessing car image
    $car_image = $_FILES['car_image']['name'];

    // Temporary image path
    $temp_image = $_FILES['car_image']['tmp_name'];

    // Target directory for the image
    $target_dir = __DIR__ . "/car_images/";

    // Validate input fields
    if (
        empty($car_name) || empty($car_description) || empty($car_keywords) ||
        empty($car_brand) || empty($car_price) || empty($car_image)
    ) {
        echo "<script>alert('Please fill all the fields')</script>";
    } else {
        // Ensure the target directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Validate and move the uploaded file
        if (move_uploaded_file($temp_image, $target_dir . $car_image)) {
            // Insert query
            $insert_car = "INSERT INTO `cars` 
                (car_name, car_description, car_keywords, car_brand, car_image1, car_price, date, status) 
                VALUES ('$car_name', '$car_description', '$car_keywords', '$car_brand', '$car_image', '$car_price', NOW(), '$car_status')";

            $result_query = mysqli_query($con, $insert_car);

            if ($result_query) {
                echo "<script>alert('Car inserted successfully')</script>";
            } else {
                echo "<script>alert('Error inserting car: " . mysqli_error($con) . "')</script>";
            }
        } else {
            echo "<script>alert('Failed to upload the image. Please try again.')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Car - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Car</h1>
        <!-- Car insertion form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Car name -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="car_name" class="form-label">Car Name</label>
                <input type="text" name="car_name" id="car_name" class="form-control" placeholder="Enter car name" required>
            </div>

            <!-- Car description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="car_description" class="form-label">Car Description</label>
                <textarea name="car_description" id="car_description" class="form-control" placeholder="Enter car description" required></textarea>
            </div>

            <!-- Car keywords -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="car_keywords" class="form-label">Car Keywords</label>
                <input type="text" name="car_keywords" id="car_keywords" class="form-control" placeholder="Enter car keywords" required>
            </div>

            <!-- Car brand -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="car_brand" class="form-label">Car Brand</label>
                <input type="text" name="car_brand" id="car_brand" class="form-control" placeholder="Enter car brand" required>
            </div>

            <!-- Car image -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="car_image1" class="form-label">Car Image</label>
                <input type="file" name="car_image1" id="car_image1" class="form-control" required>
            </div>

            <!-- Car price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="car_price" class="form-label">Car Price</label>
                <input type="number" step="0.01" name="car_price" id="car_price" class="form-control" placeholder="Enter car price" required>
            </div>

            <!-- Submit button -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_car" class="btn btn-info mb-3 px-3" value="Insert Car">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
