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
                        <span class="glyphicon glyphicon-lock"></span><?php echo "$myid"; ?> <i class="fa fa-caret-down"></i>
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
            Orders
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table width="100%" class="table table-striped table-bordered table-hover" id="prodTable" border="10">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                //$myid = $_GET["hid"];
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
                $query = "SELECT * FROM orders WHERE Hotel_name='".$hname."' AND Status = 'Paid'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) 
                {
                    while ($row = mysqli_fetch_array($result))
                    {
                      ?>
                            <tr>
                            <td> <?php echo $row["Product_name"]; ?> </td>
                            <td> <?php echo $row["Product_price"];  ?> </td>
                            <td> <?php echo $row["quantity"];  ?> </td>
                            <td> <?php echo $row["Customer_Name"];  ?> </td>
                            <td> <?php echo $row["Phone_Number"];  ?> </td>
                            <td> <?php echo $row["Status"];  ?> </td>
                            <td> 
                            
                            <form method="post" action = "completeorder.php?phone=<?php echo $row["Phone_Number"];  ?>&hid=<?php echo $unused; ?>">     
                            <input type = "Submit" name = "submit" value ="Complete Order" class="btn btn-primary">
                            </form>
                            </td>                            
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
            <center> <p style="color: black;">&copy;Powered By Brightwits Technologies and .NET Framework</p></center>
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



    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>

</body>
</html>

