<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "shop";
$conn = mysqli_connect($host, $user, $password, $dbName);

//Create
//====================================================

if (isset($_POST['send'])) {
    $name = $_POST['Name'];
    $address =  $_POST['Address'];
    $phone =  $_POST['Phone'];
    $insert = "INSERT INTO `customers` VALUES(NULL,'$name','$address','$phone' )";
    $i = mysqli_query($conn, $insert);

    if ($i) {
        echo "<div class='alert alert-danger col-6 mx-auto' >
    Insert True to Database.
  </div>";
    } else {
        echo "<div class='alert alert-danger col-6 mx-auto' >
    Insert False Try Again.
  </div>";
    }
}

//Read
//====================================================
$select = "SELECT * FROM `customers`";
$s = mysqli_query($conn, $select);

//Delete
//====================================================

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = "DELETE FROM `customers` WHERE id = $id ";
    $d = mysqli_query($conn, $delete);
    header("Refresh:0; url=index.php");
}
//Update
//====================================================
$name = "";
$address = "";
$phone = "";
$update = false;
if (isset($_GET['edit'])) {
    $update = true;
    $id = $_GET['edit'];
    $select = "SELECT * FROM `customers` WHERE id = $id ";
    $s = mysqli_query($conn, $select);

    $row = mysqli_fetch_assoc($s);
    $name =    $row['name'];
    $address = $row['address'];
    $phone =   $row['phone'];

    if (isset($_POST['update'])) {
        $name = $_POST['Name'];
        $address =  $_POST['Address'];
        $phone =  $_POST['Phone'];
        $update = "UPDATE  `customers` SET name ='$name' , address ='$address' , phone = '$phone' WHERE id =$id";
        $u = mysqli_query($conn, $update);
        header("Refresh:0; url=index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>

<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav> -->
    <h1 class="text-center text-info">CURD with PHP</h1>
    <div class="container col-6 my-3">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="">Customer Name</label>
                        <input name="Name" value="<?php echo $name ?>" type="text" placeholder="Your Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Customer Address</label>
                        <input name="Address" value="<?php echo $address ?>" type="text" placeholder="Your Address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Customer Phone</label>
                        <input name="Phone" value="<?php echo $phone ?>" type="text" placeholder="Your Phone" class="form-control">
                    </div>
                    <?php if ($update) : ?>
                        <button name="update" class="btn btn-light w-50 btn-block m-2 mx-auto"> Update Data</button>
                    <?php else : ?>
                        <button name="send" class="btn btn-info w-50 btn-block m-2 mx-auto"> Send Data</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <div class="container col-6 my-3">
        <div class="card">
            <div class="card-body">
                <table class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>

                    <?php foreach ($s as $customer) { ?>
                        <tr>
                            <td> <?php echo $customer['id'] ?> </td>
                            <td> <?php echo $customer['name'] ?> </td>
                            <td> <?php echo $customer['address'] ?> </td>
                            <td> <?php echo $customer['phone'] ?> </td>
                            <td colspan="2"> <a onclick="return confirm('are you sure')" href="index.php?delete=<?php echo $customer['id'] ?>" class="btn btn-danger">Delete</a> </td>
                            <td> <a href="index.php?edit=<?php echo $customer['id'] ?>" class="btn btn-info"> Edit</a></td>
                        </tr>

                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>