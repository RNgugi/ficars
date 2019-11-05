<?php

	$phone = $_GET["phone"];
    $myid = $_GET["hid"];
    $unused = $myid;
    $status = "paid";
    $newstatus = "complete";
    $hname = $_GET["hname"];

    $conn = mysqli_connect('localhost','root','','shopping') or die(mysql_error());
    $query = "SELECT * FROM orders WHERE Phone_Number='".$phone."' AND status ='".$status."' ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) 
    {
        while ($row = mysqli_fetch_array($result))
        {
            $sql = "UPDATE orders SET status='$newstatus' WHERE Phone_Number=$phone";

            if ($conn->query($sql) === TRUE) 
            {
                 echo "Record updated successfully";
                 
            }            
            else 
            {
                 echo "Error updating record: " . $conn->error;
            }
        }
	}
	

// Send an sms to transporter start
$username='stine';
$key='qB01ASOlcE2Z9nCVUDQuoPtOzdZyyA3tvXI5jjlVxx3U7OhMLC';
$senderid='SMARTLINK';
$phonenumber='254718024761';
$message=urlencode('hello');
$live_url ='https://sms.movesms.co.ke/api/compose?username='.$username.'&api_key='.$key.'&sender='.$senderid.'&to='.$phonenumber.'&message='.$message.'&msgtype=5&dlr=0';
$parse_url=file($live_url);
$output1=  $parse_url[0];
echo $output1;
// Send an sms to transporter end

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Send an sms to receiver start
$username='stine';
$key='qB01ASOlcE2Z9nCVUDQuoPtOzdZyyA3tvXI5jjlVxx3U7OhMLC';
$senderid='SMARTLINK';
$phonenumber=$phone;
$message=urlencode('hello');
$live_url ='https://sms.movesms.co.ke/api/compose?username='.$username.'&api_key='.$key.'&sender='.$senderid.'&to='.$phonenumber.'&message='.$message.'&msgtype=5&dlr=0';
$parse_url=file($live_url);
$output1=  $parse_url[0];
echo $output1;
// Send an sms to receiver end

//Redirect back to orders page
header("location: index.php?hid=$unused");
?>