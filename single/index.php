<?php
session_start();

$myid = $_GET["hid"];
$unused = $myid;

$conn = mysqli_connect('localhost','root','','shopping') or die(mysql_error()); 
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
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>FiCAR Foods | Hotel</title>
    <link rel="shortcut icon" href="../img/favicon.png" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="../css/linearicons.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/nice-select.css">
    <link rel="stylesheet" href="../css/animate.min.css">
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .genric-btn :default {
            background-color: #f44a40;
        }
    </style>
    <link rel="shortcut icon" href="../img/favicon.png" />
</head>
<body>

    <header id="header" id="home">
        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="../index.php">
                    <img class="img-fluid" src="../img/logo.png"/>
                    </a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="../index.php">Home</a></li>
                        <li><a href="#dish">Main Dishes</a></li>
                        <li><a href="#chefs">Traditional Food</a></li>
                        <li><a href="#blog">Beverages</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="#login">Login</a></li>
                        <li><a href="../login/login.php?hid=<?php echo $unused; ?> ">View Cart</a></li>

                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </div>
    </header><!-- #header -->
<!-- start banner Area -->

                <?php
                    $conn = mysqli_connect('localhost','root','','shopping') or die(mysql_error()); 
                    $query = "SELECT * FROM users WHERE Customer_name = '".$myid."'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) 
                    {
                        while ($row = mysqli_fetch_array($result))
                        {
                ?>

                
<section class="banner-area relative" id="home">
            <div class="container">
                <div class="row fullscreen d-flex align-items-center justify-content-start">
                    <div class="banner-content col-lg-8 col-md-12">
                         <h4 class="text-white text-uppercase">Wide Options of Choice</h4>
                        <h1>
                        <?php echo $row["Customer_name"]; ?>
                        </h1>
                        <p class="text-white">
                        <?php echo $row["Description"]; ?>
                        </p>
                        <a href="#dish" class="primary-btn header-btn text-uppercase">Check Our Menu</a>
                    </div>
                </div>
            </div>
        </section>
                <?php
                        }
                    }
                ?>

    <!-- End banner Area -->
    <!-- Start top-dish Area -->
    <section class="top-dish-area section-gap" id="dish" style="padding-bottom:5%; padding-top: 5%">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Main Dishes</h1>
                        <p>Our mouth watering dishes by the best chefs in town</p>
                    </div>
                </div>
            </div>
            

                    <div class="row">






		<?php
			$query = "SELECT * FROM products WHERE Supplier = '".$myid."' ";
			$result = mysqli_query($conn, $query);
			if (mysqli_num_rows($result) > 0) 
			{
				while ($row = mysqli_fetch_array($result))
				{
					?>

					<div class="col-md-4 single-dish col-md-4" style="background-color: whitesmoke; padding:10px;">
						<form method="POST" action="index.php?add&id=<?php echo $row["Id"]; ?>&hid=<?php echo $unused; ?>">
							<center>
                            <div class="thumb">                            
							<img class="img-fluid" src="<?php echo $row["Photo"]; ?>" style="background-size: cover; height: 250px; width: 280px; border-radius:10px;"/><br />
                            </div>
							<h4 class="text-info"> <?php echo $row["product_name"]; ?> </h4>
							<h4 class="text-danger">Ksh <?php echo $row["Price"]; ?> </h4>
							<input type="text" name="quantity" class="form-control" value="1" />
							<input type="hidden" name="hidden_name" value="<?php echo $row["product_name"]; ?>" />
							<input type="hidden" name="hidden_price" value="<?php echo $row["Price"]; ?>" />
							<input type="submit" name="add_to_cart" style="margin-top: 5px;" class="btn btn-success" value="Add to Cart" />			</center>		
						</form>
			
					</div>



		<?php	
			}	
				
		}
		?>

</div>
            </div>
    </section>
    <!-- End top-dish Area -->
    <!-- Start Traditional Area -->
    
    <!-- End Traditional Area -->
    <!-- Start beverages Area -->

    <!-- End beverages Area -->
    <!-- <center><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">View items</button></center>		 -->


<!-- Modal -->
 <div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog modal-lg">
   
     <!-- Modal content-->
     <div class="modal-content">
       <div class="modal-header">
         <h3 class="modal-title">Order details</h3>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
       <div class="modal-body">
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
								<td> <a href="index.php?action=delete&id=<?php echo $values ["item_id"]; ?>&hid=<?php echo $unused; ?>"><span class="text-danger">Remove</span></a> </td>
							</tr>

					<?php 
						$total = $total + ($values["item_quantity"] * $values ["item_price"]);

					}
					?>
						<tr>
							<td colspan="3" align="right">Total</td>
							<td align="right" colspan="2"><b>Ksh <?php echo number_format($total, 2); ?> </b></td>
							
						</tr>


					<?php
					}
			    ?>
				
			</table>
            <h3 class="modal-title">User Details</h3>    
<form method="post" action="">
<p><input type="text" required name="name" placeholder="Enter your name" class="form-control"/></p>
<p><input type="number" required name="mobile" placeholder="Enter your phone number" class="form-control"/></p>
<p><input type="text" required name="location" placeholder="Enter your location" class="form-control"/></p>
<input type="submit" class="btn btn-success form-control" value="Checkout" name = "checkout">
</form>
       </div>
       <div class="modal-footer" >
                   <?php

                   $name=$_POST["name"];
                   $mobile = $_POST["mobile"];
                   $location = $_POST["location"];

                   if (isset($_POST["checkout"])) 

                           if (!empty($_SESSION["shopping_cart"])) 
                           {
                              
                               foreach ($_SESSION["shopping_cart"] as $keys => $values) 
                               {
                                   $query = "insert into orders (product_name,quantity,Total,product_price,Customer_name,Hotel_name,Phone_Number,LongLat,Status) values('".$values["item_name"]."', '".$values["item_quantity"]."', '$total', '".$values["item_price"]."','$name','$unused','$mobile','$location','New')";
                                   mysqli_query($conn,$query) or die(mysqli_error($conn));
                                   
                               }
                               echo '<META HTTP-EQUIV="refresh" content="0;URL=checkout.php?hid='.$name.' ">';
                               
                           }
                           //header("location: checkout.php");
                   ?>
                   
                   
                 
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   </form>
       </div>
     </div>
     
   </div>
 </div>




<!-- Start video Area -->
    <!-- <section class="video-area">
        <div class="container">
            <div class="row justify-content-center align-items-center flex-column">
                <a class="play-btn" href="https://www.youtube.com/watch?v=PZ4pctQMdg4">
                    <img src="img/play-btn.png" alt="">
                </a>
                <h3 class="pt-20 pb-20 text-white">We Always serve the vaping hot and delicious foods</h3>
                <p class="text-white">Youtube video will appear in popover</p>
            </div>
        </div>
    </section> -->
    <!-- End video Area -->
    <!-- start footer Area -->
    <footer class="footer-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h4 class="text-white">About Us</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h4 class="text-white">Contact Us</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.
                        </p>
                        <p class="number">
                            012-6532-568-9746 <br>
                            012-6532-569-9748
                        </p>
                    </div>
                </div>
                <div class="col-lg-5  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h4 class="text-white">Newsletter</h4>
                        <p>You can trust us. we only send  offers, not a single spam.</p>
                        <div class="d-flex flex-row" id="mc_embed_signup">


                            <form class="navbar-form" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get">
                                <div class="input-group add-on">
                                    <input class="form-control" name="EMAIL" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required="" type="email">
                                    <div style="position: absolute; left: -5000px;">
                                        <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                    </div>
                                    <div class="input-group-btn">
                                        <button class="genric-btn"><span class="lnr lnr-arrow-right"></span></button>
                                    </div>
                                </div>
                                <div class="info mt-20"></div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <p class="footer-text m-0">Copyright &copy;
                    <script>document.write(new Date().getFullYear());</script> All rights reserved | Designed by BrightWits Technologies <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://brightwitstechnologies.co.ke" target="_blank">BrightWits</a></p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <div class="footer-social d-flex align-items-center">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->

    <script src="../js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="../js/vendor/bootstrap.min.js"></script>			
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="../js/easing.min.js"></script>			
			<script src="../js/hoverIntent.js"></script>
			<script src="../js/superfish.min.js"></script>	
			<script src="..//jquery.ajaxchimp.min.js"></script>
			<script src="../js/jquery.magnific-popup.min.js"></script>	
			<script src="../js/owl.carousel.min.js"></script>			
			<script src="../js/jquery.sticky.js"></script>
			<script src="../js/jquery.nice-select.min.js"></script>			
			<script src="../js/parallax.min.js"></script>	
			<script src="../js/mail-script.js"></script>	
			<script src="../js/main.js"></script>	
		</body>
	</html>



