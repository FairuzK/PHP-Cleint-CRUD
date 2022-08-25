<?php

// Validating of the data entered by the user.
// I start with initailizing the values
$name="";
$email="";
$address="";
$error_message="";
$success_message="";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $name=$_POST["name"];
    $email=$_POST["email"];
    $address=($_POST["address"]);

    function validate ($data){
        $data=trim($data);
        $data=htmlspecialchars($data);
        $data=stripslashes($data);
        return $data;
    }
    
    //Checking for empty Inputs by the User
    do{
        if(empty($name) || empty($email) || empty($address)){
            $error_message = "All flieds are required.";
            break;
        }
        //Connecting and inserting values to the database
        include 'db.php';
        $sql="INSERT INTO client(name,email,address) VALUES('$name','$email','$address') ";
        $result=$conn->query($sql);
        if(!$result){
            $error_message="Invalid Query".$conn->error;
            break;
        }

         //Initializing creating client
        $name="";
        $email="";
        $address="";
        $success_message="Client added Successfully";
        header("location: /Crud/index.php");
        exit;
    }while(false);
   
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Create</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"><link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="user-create">   
        <form class="col-6" method="POST" >
            <h1 class="mb-3">Register Client</h1>
            <?php
             if(!empty($error_message)){
                echo "
                  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        $error_message
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>
                ";
             }
            ?>
            <div class="mb-2">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name ?>" >
            </div>
            <div class="mb-2">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $email ?>" >
            </div>
            <div class="mb-2">
                <label>Address</label>
                <input type="text" class="form-control" name="address" value="<?php echo $address ?>" >
            </div>
            <?php
             if(!empty($success_message)){
                echo "
                  <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        $success_message
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>
                ";
             }
            ?>
            <div class="mb-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-secondary" href="/Crud/index.php">Cancel</a>
            </div>
        </form>
        </div>
    </div>
 
    
</body>
</html>