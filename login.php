<?php
	include('conn.php');
//	session_start();
	function check_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//$username=check_input($_POST['username']);
		$username=$_POST['username'];
		// if (!preg_match("/^[a-zA-Z0-9_]*$/",$username)) {
		// 	$_SESSION['msg'] = "Username should not contain space and special characters!"; 
		// 	header('location: index.php');
		// }
		// else{
			
		$fusername=$username;
		
		//$password = check_input($_POST["password"]);
		$password = $_POST["password"];
		//$fpassword=md5($password);
		$fpassword=$password;
		
		$query=mysqli_query($conn,"select * from users where Email='$fusername' and Passwords='$fpassword'");
		
		if(mysqli_num_rows($query)==0){
			$_SESSION['msg'] = "Login Failed, Invalid Input!";
			header('location: index.php');
		}
		else{
			
			$row=mysqli_fetch_array($query);
			//if ($row['Access_level']==1){
				$_SESSION['id']=$row['Customer_name'];
				?>
				<script>
					window.alert('Login Success, Welcome Admin!');
					window.location.href='admin/index.php?hid<?php echo $row['Customer_name']; ?>';
				</script>
				<?php
			//}
		
		}
		
		//}
	}
?>

<a href="#" class="primary-btn header-btn text-sentencecase" style="margin-left:60%; margin-top:10%%;font-size:36px;text-transform: capitalize;">FiCAR Party <i class='fas fa-wine-bottle' style='font-size:36px'></i></a>