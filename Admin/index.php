<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
	exit;
}
?>

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


    <link href="../Content/fourGrid.css" rel="stylesheet" />
</head>
<body>


    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Ficar Foods</a>
                <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
            </div>
            <!--Nav bar right-->
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="glyphicon glyphicon-lock"></span>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#account" data-toggle="modal"><span class="glyphicon glyphicon-lock"></span>  My Account</a></li>
                        <li class="divider"></li>
                        <li><a href="#logout" data-toggle="modal"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>


            <!--Nav bar side-->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-home fa-fw"></i> Home</a>
                         
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Master Files<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#"><span class="glyphicon glyphicon-user"></span> Users <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="customers.php"> <i class="fa fa-credit-card"></i> Customer</a>
                                          
                                        </li>
                                        <li>
                                            <a href="suppliers.php"> <i class="fa fa-truck"></i> Supplier</a>
                                        
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="allproducts.php"> <i class="fa fa-product-hunt"></i> Products</a>
                                    
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-copy fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../Admin/sales.php"><i class="fa fa-money fa-fw"></i> Sales Report</a>
                                </li>
                                <li>
                                    <a href="../Admin/inventory.php"><i class="fa fa-barcode fa-fw"></i> Inventory Report</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#logout" data-toggle="modal"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>


    </div>


    <div>




<div style="height:50px;"></div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div style="height:10px;"></div>

        <!--four-grids here-->
        <div class="four-grids">
            <div class="col-md-3 four-grid">
                <div class="four-agileits">
                    <div class="icon">
                        <i class="glyphicon glyphicon-user" aria-hidden="true"></i>
                    </div>
                    <div class="four-text">
                        <h3>Customers</h3>
                        <h4> 2,000 </h4>

                    </div>

                </div>
            </div>
            <div class="col-md-3 four-grid">
                <div class="four-agileinfo">
                    <div class="icon">
                        <i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
                    </div>
                    <div class="four-text">
                        <h3>Products</h3>
                        <h4>8,500</h4>

                    </div>

                </div>
            </div>
            <div class="col-md-3 four-grid">
                <div class="four-w3ls">
                    <div class="icon">
                        <i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
                    </div>
                    <div class="four-text">
                        <h3>Transactions</h3>
                        <h4>12,430</h4>

                    </div>

                </div>
            </div>
            <div class="col-md-3 four-grid">
                <div class="four-wthree">
                    <div class="icon">
                        <i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i>
                    </div>
                    <div class="four-text">
                        <h3>Suppliers</h3>
                        <h4>5,000</h4>

                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--//four-grids here-->
    </div>
</div>





















        <hr />
        <footer>
            <center> <p style="color: black;">&copy; Powered By Brightwits Technologies and .NET Framework</p></center>
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
    <script src="~/vendor/jquery/jquery.min.js"></script>
    <script src="~/vendor/bootstrap/js/bootstrap.min.js"></script>


    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Logging out...</h4></center>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <h5><center>Username: <strong>@Session["USER_NAME"]</strong></center></h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <a href="../Admin/logout.php" class="btn btn-danger"><i class="fa fa-sign-out"></i> Logout</a>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- My Account -->
    <div class="modal fade" id="account" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">My Account</h4></center>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form method="POST" action="update_account.php">
                            <div style="height:10px;"></div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="width:150px;">Username:</span>
                                <input type="text" style="width:350px;" value="admin" class="form-control" name="username">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="width:150px;">Password:</span>
                                <input type="password" style="width:350px;" value="21232f297a57a5a743894a0e4a801fc3" class="form-control" name="password">
                            </div><hr>
                            <p>Type current password to update:</p>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="width:150px;">Password:</span>
                                <input type="password" style="width:350px;" class="form-control" name="cpass" required>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="width:150px;">Re-type:</span>
                                <input type="password" style="width:350px;" class="form-control" name="repass" required>
                            </div>
                   
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Update</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    


</body>
</html>
