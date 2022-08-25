<?php

include 'db.php';
$id="";
$name="";
$email="";
$address="";
$error_message="";
$success_message="";

if($_SERVER['REQUEST_METHOD']=='GET'){
    //Show data about the user
    if(!isset($_GET["ID"])){
        header("Location: /Crud/index.php");
        exit;
    }
    $id=$_GET["ID"];
    $sql="SELECT * FROM client WHERE id=$id";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    if(!$row){
        header("Location: /Crud/index.php" );
        exit;
    }
    $id=$row["ID"];
    $name=$row["Name"];
    $email=$row["Email"];
    $address=$row["Address"];


}
else{
    //Updating user information here.
    $id=$_POST["ID"];
    $name=$_POST["Name"];
    $email=$_POST["Email"];
    $address=$_POST["Address"];

    do{
        if(empty($name) || empty($email) || empty($address)){
            $error_message="All flieds are required.";
            exit;
        }

        $sql= "UPDATE client SET Name='$name',Email='$email',Address='$address' WHERE ID=$id";

        $result=$conn->query($sql);
        if(!$result){
            $error_message ="Invalid query:  ".$conn->error;
            break;
        }
        $success_message="Client Successfully Updated";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="user-create">   
        <form class="col-6" method="POST" >
            <input type="hidden" name="ID" value="<?php echo $id; ?>">
            <h1 class="mb-3">Edit Client</h1>
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
                <input type="text" class="form-control" name="Name" value="<?php echo $name ?>" >
            </div>
            <div class="mb-2">
                <label>Email</label>
                <input type="email" class="form-control" name="Email" value="<?php echo $email ?>" >
            </div>
            <div class="mb-2">
                <label>Address</label>
                <input type="text" class="form-control" name="Address" value="<?php echo $address ?>" >
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