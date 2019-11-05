<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/login.php");
	exit;
}

$myid = $_GET["hid"];
$unused = $myid;
$value;
$conn = mysqli_connect('localhost','root','','shopping') or die(mysql_error()); 
$query = "SELECT * FROM users WHERE Customer_name = '".$myid."'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) 
{
	while ($row = mysqli_fetch_array($result))
	{
		
		$tillNo = $row["TillNumber"];
		
		//echo $row["TillNumber"];
	}
}
if (isset($_POST["add_to_cart"])) 
{
	if (isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if (!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'	=> $_GET["id"],
				'item_name'		=> $_POST["hidden_name"],
				'item_price'	=> $_POST["hidden_price"],
				'item_quantity'	=> $_POST["quantity"]
		  	);
			$_SESSION["shopping_cart"][$count] = $item_array;
			echo '<script> alert("Item  Added")</script>';
			echo '<script> alert('.$myid.')</script>';
		}
		else
		{
			echo '<script> alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'	=> $_GET["id"],
			'item_name'		=> $_POST["hidden_name"],
			'item_price'	=> $_POST["hidden_price"],
			'item_quantity'	=> $_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
	
 }
 if (isset($_GET["action"])) 
 {
 	if ($_GET["action"] == "delete") 
 	{
 		foreach ($_SESSION["shopping_cart"] as $keys => $values) 
 		{
 			if ($values["item_id"] == $_GET["id"] )
 			{
 				unset($_SESSION["shopping_cart"][$keys]);
 				echo '<script>alert("Item Removed")</script>';
 			//	echo '<script>window.location="index1.php"</script>';
 			}
 		}
 	}
 }

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


    <link href="../Content/fourGrid.css" rel="stylesheet" />
</head>
<body>


<div class="container">
<p style="padding-top:15px;">
<a href="../login/logout.php" class="btn btn-danger">Sign Out of Your Account</a>
<a href="../login/reset-password.php" class="btn btn-warning">Reset Your Password</a>
</p>


    
	<div id="checkout_area"></div>
	<div class="row">
	<strong>Contact and Billing Information</strong>
	<div style="height:20px;"></div>


	<div class="row">
  <div class="col-md-8">
  <form method="POST" action="" >
					
						<div style="height:15px;"></div>
						<div class="form-group input-group">
            <span style="width:150px;" class="input-group-addon">Full Name:</span>
            <input type="text" style="width:330px; text-transform:capitalize;" class="form-control" name="name" required >
           </div>
						<div class="form-group input-group">
            <span style="width:150px;" class="input-group-addon">Address:</span>
             <input type="text" style="width:330px; text-transform:capitalize;" class="form-control" name="address" required >
            </div>
						<div class="form-group input-group">
            <span style="width:150px;" class="input-group-addon">Phone Number:</span>
            <input type="text" style="width:330px;" class="form-control" name="contact" required >
		   </div>
		   
		   				<div class="form-group input-group">
            <span style="width:150px;" class="input-group-addon">Location:</span>
            <select class="form-control" name="location" style="width:330px;" required>
                                            <option value="50">Nyeri CBD</option>
                                            <option value="100">King'ong'o</option>
											<option value="150">Kamakwa</option>
											<option value="100">Skuta</option>
											<option value="120">Ring Road</option>
											<option value="200">Dedan Kimathi University</option>
                                        </select>
           </div>
	
		   
		   
  <div style="height:10px;" class="col-md-12"></div>
  <strong >Review Your Order</strong>
<table class="table table-bordered">
				<tr>
					<th width="40%">Item Name</th>
					<th width="10%">Quantity</th>
					<th width="20%"> Price</th>
					<th width="15%">Total</th>
					<th width="5%">Action</th>
				</tr>
        <?php 
					if (!empty($_SESSION["shopping_cart"])) 
					{
						$total = 0;
						foreach ($_SESSION["shopping_cart"] as $keys => $values) 
						{
							?>
							<tr>
								<td> <?php echo $values["item_name"];  ?> </td>
								<td> <?php echo $values["item_quantity"];  ?> </td>
								<td> <?php echo $values["item_price"];  ?> </td>
								<td> <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?> </td>
								<td> <a href="checkout.php?action=delete&id=<?php echo $values ["item_id"]; ?>&hid=<?php echo $unused; ?>"><span class="text-danger">Delete</span></a> </td>
							</tr>
							<tr>
							
							<td colspan="2" align="right"> Delovery Location</td>

							<td align="right" colspan="2"> <b>
							<form name="location" method="POST">	
							<select  name="location" style="width:330px; height:30px; border-color:aliceblue" required>
                                            <option $value="50">Nyeri CBD</option>
                                            <option value="100">King'ong'o</option>
											<option value="150">Kamakwa</option>
											<option value="100">Skuta</option>
											<option value="120">Ring Road</option>
											<option value="200">Dedan Kimathi University</option>
										</select>
									
									</b></td>
							<td>
							<div class="regerv_btn" style="margin-bottom:2%"> <input  type="submit" name="location" class="regerv_btn_iner" style="color:white"> </td>
							</div>

                        </tr> 
						<tr>
							<td colspan="3" align="right">Delivery Fee</td>
							<td align="right" colspan="2"><b>Ksh <?php echo number_format($total, 2); ?> </b></td>
							
						</tr>

					<!-- <?php 
						$total = $total + ($values["item_quantity"] * $values ["item_price"] + $_POST['address']);

						}
					?> -->
					}	
						<tr>
							<td colspan="3" align="right">Total</td>
							<td align="right" colspan="2"><b>Ksh <?php echo number_format($total, 2); ?> </b></td>
							
						</tr>


					<?php
					}
			    ?>
				
			</table>

				</div> 

		
				
		
        <div class="col-md-4" style="text-align:left;">
        <strong> <u> Payment Instructions </u> </strong> <br>
		1. Go to M-Pesa menu <br>
		2. Click on Lipa na M-Pesa  <br>
		3. Click on Buy Goods and Services <br>
		4. Enter till no <strong><?php echo $tillNo; ?></strong> <br>
		5. Enter Ammount Due <br>
		6. Wait for the M-Pesa message <br>
		6. Input the MPesa transaction ID Bellow <br>
		7. Click Pay Now. <br>
    <input type="text" name="confirmationid" placeholder="MPESA Confirmation ID" class="form-control"  required>
	
        
        <a href="index.php?hid=<?php echo $unused; ?>"><button type="button" class="btn btn-success"></i> Continue Shopping</button></a>
        <input type="submit" class="btn btn-success" name="checkout"/>
		</form>

 



		


	<?php
      
    //   $cname = $_POST['name'];
    //   $address = $_POST['address'];
    //   $mobile = $_POST['contact'];
	//   $pid = $_POST['confirmationid'];
	//   $location = $_POST['location'];
	if (isset($_POST["checkout"])) 
	
	if (!empty($_SESSION["shopping_cart"])) 
	{						
		foreach ($_SESSION["shopping_cart"] as $keys => $values) 
	{
		$query = "insert into orders (product_name,quantity,product_price,Total,Customer_Name,Hotel_name,Phone_Number,Address,Status,paymentid) values('".$values["item_name"]."', '".$values["item_quantity"]."', '".$values["item_price"]."','".$total."','$cname','".$unused."','$mobile','$address','Paid','$pid')";
		mysqli_query($conn,$query) or die(mysqli_error($conn));	
								
	}
     	echo "<script>alert('Your Order Has Successfully Been Submitted');</script>";
        $_SESSION["shopping_cart"]="";
        header('location: ../index.php');
	}
	if (isset($_POST["location"]))
	{
		$query = "insert into locations (Price) values('$location')";
		mysqli_query($conn,$query) or die(mysqli_error($conn));
	}
	?>
					<!-- <form method = "post" action="">
					<span class="pull-right" style="margin-right:15px;"><input type="text" name="fname" placeholder="MPESA Confirmation ID"  required=""></span><br/>
          <span class="pull-right" style="margin-right:15px;"> <input type="submit" class="btn btn-success" value="Checkout" name = "checkout"></span><br/>
          <span class="pull-right" style="margin-right:15px;"><a href="index.php?hid=<?php echo $unused; ?>">Continue Shopping</a></span><br/>
					</form> -->







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