<?php
include('../includes/database.php');



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="admin/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style.css">

    
    <style>
      /* Apply the custom font to the text inside the .bg-light div */
      .bg-light {
        font-family: 'Caveat', Algerian;
        font-family: 'Whisper', Algerian;
      }

      body{
        background-color:#f7f4e6;
      }
      
      
  </style>
</head>
<body >
    
<div class="container-fluid ">
  <h2 class="text-center "><strong><i>New admin registration </i></strong></h2>
  <div class="row d-flex align-items-center justify-content-center">
    <div class="col-lg-12 col-xl-6">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4" >
          <!-- username feild -->
          <label for="admin_name" class="form-label">Admin name</label>
          <input type="text" id="user_username" class="form-control" placeholder="enter your username" autocomplete="off" required="required" name="admin_name">
        </div>

        <div class="form-outline mb-4">
          <!-- email feild -->
          <label for="admin_email" class="form-label">Email</label>
          <input type="text" id="admin_email" class="form-control" placeholder="enter your email" autocomplete="off" required="required" name="admin_email">
        </div>

        <!-- image -->
        <div class="form-outline mb-4">
          <label for="admin_image" class="form-label">Admin image</label>
          <input type="file" id="admin_image" class="form-control" placeholder="enter your image" autocomplete="off" required="required" name="admin_image">
        </div>

        <div class="form-outline mb-4">
          <!-- email feild -->
          <label for="admin_password" class="form-label">password</label>
          <input type="password" id="admin_password" class="form-control" placeholder="enter your password" autocomplete="off" required="required" name="admin_password">
        </div>

        <div class="form-outline mb-4">
          <!-- email feild -->
          <label for="conf_admin_password" class="form-label">Confirm password</label>
          <input type="password" id="conf_admin_password" class="form-control" placeholder="confirm password" autocomplete="off" required="required" name="conf_admin_password">
        </div>

        

        <div class="form-outline mb-4" >
          <!-- contact feild -->
          <label for="admin_mobile" class="form-label">Contact</label>
          <input type="text" id="admin_mobile" class="form-control" placeholder="enter your contact" autocomplete="off" required="required" name="admin_mobile">
        </div>

        <div class="mt-4 pt-2">
          <input type="submit" value="Register" class="bg-secondary py-2 px-3 border-1" name="admin_register">

          <p class="small fw-bold mt-2 pt-1 mb-4">Already have an account ?<a href="admin_login.php" class="text-danger"> Login </a></p>
        </div>


      </form>
    </div>
  </div>
</div>
<!-- <div>
  <img src="../images/cart.png" alt="" srcset="">
</div> -->






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>


<?php
if(isset($_POST['admin_register'])){
$admin_name=$_POST['admin_name'];
$admin_email=$_POST['admin_email'];

$admin_password=$_POST['admin_password'];
$hash_password=password_hash($admin_password,PASSWORD_DEFAULT);
$conf_admin_password=$_POST['conf_admin_password'];

$admin_mobile=$_POST['admin_mobile'];
$admin_image=$_FILES['admin_image']['name'];
$admin_image_tmp=$_FILES['admin_image']['tmp_name'];



//select 

$select_query = "SELECT * FROM `admin_table` WHERE admin_name=?";
$stmt_select = mysqli_prepare($con, $select_query);
mysqli_stmt_bind_param($stmt_select, "s", $admin_name);
mysqli_stmt_execute($stmt_select);
$result_query = mysqli_stmt_get_result($stmt_select);
$rows_count = mysqli_num_rows($result_query);

if ($rows_count > 0) {
    echo "<script> alert('admin name already exists') </script>";


mysqli_stmt_close($stmt_select);

}
else if($admin_password!=$conf_admin_password){
  echo "<script> alert('Password do not match') </script>";

}else{

  //insert query
move_uploaded_file($admin_image_tmp,"./admin_images/$admin_image");

$insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_password, admin_image, admin_mobile) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $insert_query);

mysqli_stmt_bind_param($stmt, "sssss", $admin_name, $admin_email, $hash_password, $admin_image, $admin_mobile);

if (mysqli_stmt_execute($stmt)) {
    echo "<script> alert('Data inserted successfully') </script>";
} else {
    die('Error: ' . mysqli_error($con));
}

mysqli_stmt_close($stmt);






}

//selecting cart items 

  $_SESSION['admin_name']=$admin_name;
 
  echo "<script> window.open('./index1.php','_self')</script>";



}


?>