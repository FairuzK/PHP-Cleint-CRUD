
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Crud project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="col-8">
        <h1 class="text center mb-4">Client Dashboard</h1>
        <a href="create.php" type="button" class="btn btn-primary btn-sm mb-3">New Client</a>
        <table class="table table-hover table-secondary">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Address</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
            <?php 
            include 'db.php';
            $sql="SELECT * FROM client";
            $result=$conn->query($sql);
            if(!$result){
                die("No Results found".$conn->error);
            }

            while($row=$result->fetch_assoc()){
                echo "
                <tr>
                    <td>$row[ID]</td>
                    <td>$row[Name]</td>
                    <td>$row[Email]</td>
                    <td>$row[Address]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/Crud/edit.php?ID=$row[ID]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/Crud/delete.php?ID=$row[ID]'>Delete</a>
                    </td>
                </tr>
                ";
            }

            ?>
            </tbody>
        </table>
        </div>
    </div>
    
</body>
</html>