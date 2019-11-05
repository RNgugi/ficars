<?php
     session_start();

     // Check if the user is logged in, if not then redirect him to login page
     if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
     {
         header("location: login.php");
         exit;
     }
     $myid = $_GET["hid"];
     $unused = $myid;
     
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$query = "SELECT * FROM users WHERE username = '".$myid."'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) 
{
	while ($row = mysqli_fetch_array($result))
	{
		
		$Customer_name = $row["Customer_name"];
		
		//echo $row["TillNumber"];
	}
}


// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $pname = $_POST["product_name"];
    $category = $_POST["category"];
    $price = $_POST["price"];

// Check if file was uploaded without errors
if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["photo"]["name"];
    $filetype = $_FILES["photo"]["type"];
    $filesize = $_FILES["photo"]["size"];

    // Verify file extension
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

    // Verify file size - 5MB maximum
    $maxsize = 5 * 1024 * 1024;
    if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

    // Verify MYME type of the file
    if(in_array($filetype, $allowed)){
        // Check whether file exists before uploading it
        if(file_exists("../img/" . $filename)){
            echo $filename . " is already exists.";
        } else{
            move_uploaded_file($_FILES["photo"]["tmp_name"], "../img/" . $filename);
            echo "Your file was uploaded successfully.";
        } 
    } else{
        echo "Error: There was a problem uploading your file. Please try again."; 
    }
} else{
    echo "Error: " . $_FILES["photo"]["error"];
}



$sql = "INSERT INTO products (product_name, Category, Price, Photo, Supplier)
VALUES ('$pname', '$category', '$price','../img/$filename','$Customer_name')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}
mysqli_close($conn);



?>



<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <title>FiCAR Foods</title>
    <link rel="shortcut icon" href="../img/favicon.png" />
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet" />
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet" />

</head>
<body>
    <div class="container">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="https://www.candlecode.com">Ficar Foods</a>
              
            </div>

            <ul class=" nav navbar-nav">
                <li>
                    <a href="index.php?hid=<?php echo $unused; ?>"><i class="fa fa-product-hunt fa-fw"></i> Orders</a>
                    
                </li>
                <li>
                    <a href="products.php?hid=<?php echo $unused; ?>"><i class="fa fa-product-hunt fa-fw"></i> My Products</a>
                    
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="fa fa-copy fa-fw"></span> Reports <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="sales.php"><span class="fa fa-money fa-fw"></span>  Sales Report</a></li>
                        <li class="divider"></li>
                        <li><a href="inventory.php"><span class="fa fa-barcode"></span>  Inventory Report</a></li>
                    </ul>
                </li>
            </ul>
            <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="glyphicon glyphicon-lock"></span><?php echo "$myid"; ?><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#account" data-toggle="modal"><span class="glyphicon glyphicon-lock"></span>  My Account</a></li>
                        <li class="divider"></li>
                        <li><a href="#profile" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>  My Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="#logout" data-toggle="modal"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <div class="container">

<div style="height:50px;"></div>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Products

            <span class="pull-right">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addproduct"><i class="fa fa-plus-circle"></i> Add Product</button>
                </span>
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table width="100%" class="table table-striped table-bordered table-hover" id="prodTable" border="10">
            <thead>
                <tr>

                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
               // $myid = $_GET["hid"];
                $conn = mysqli_connect('localhost','root','','shopping') or die(mysql_error()); 
                $query = "SELECT * FROM users WHERE username='".$myid."'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) 
                {
                  
                    while ($row = mysqli_fetch_array($result))
                    {
                        $hname = $row["Customer_name"];
                    }


                }
                $query = "SELECT * FROM products WHERE Supplier='".$hname."' ";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) 
                {
                  
                    while ($row = mysqli_fetch_array($result))
                    {
                      ?>
                            <tr>
                            <td> <?php echo $row["product_name"]; ?> </td>
                            <td> <?php echo $row["Category"];  ?> </td>
                            <td> <?php echo $row["Price"];  ?> </td>
                            <td> Delete product </td>                            
                            </tr>
                            <?php	
        }	
            
    }
    ?>
            </tbody>
        </table>
    </div>
</div>


<hr />
        <footer>
            <center> <p style="color: black;">&copy; @DateTime.Now.Year - Powered By Brightwits Technologies and .NET Framework</p></center>
        </footer>
    </div>



    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

            <!-- Add Product -->
            <div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <center><h4 class="modal-title" id="myModalLabel">Add New Product</h4></center>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                               <form method="post" action="" enctype = "multipart/form-data">
                                
                                    <div class="container-fluid">
                                        <div style="height: 15px;"></div>
                                        <div class="form-group input-group">
                                            <span style="width: 120px;" class="input-group-addon">Name:</span>
                                            <input type="text" style="width: 400px; text-transform: capitalize;" class="form-control" name="product_name" required>
                                        </div>
                                        <div class="form-group input-group">
                                            <span style="width: 120px;" class="input-group-addon">Category:</span>
                                            <select style="width: 400px;" class="form-control" name="category">
                                                <option value="Main Dish">Main Dish</option>
                                                <option value="Fruits and Salads">Fruits and Salads</option>
                                                <option value="Beverages">Beverages</option>
                                                <option value="Dessert">Dessert</option>
                                                <option value="Traditional Foods">Traditional Foods</option>
                                                <option value="Vegetarian">Vegetarian</option>
                                            </select>
                                        </div>
                                        <div class="form-group input-group">
                                            <span style="width: 120px;" class="input-group-addon">Price:</span>
                                            <input type="text" style="width: 400px;" class="form-control" name="price" required>
                                        </div>

                                        <div class="form-group input-group">
                                            <span style="width: 120px;" class="input-group-addon">Photo:</span>
                                            <input type="file" style="width: 400px;" class="form-control" id="fileSelect" name="photo" required>
                                        </div>

                                        <input type="hidden" name="Supplier" value="<?php echo $Customer_name; ?>" />
                                    </div>


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                        <input type="submit" name="submit" value="Save" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal -->

    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>

</body>
</html>

