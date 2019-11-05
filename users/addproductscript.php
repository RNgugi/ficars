<?php
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
        if(file_exists("upload/" . $filename)){
            echo $filename . " is already exists.";
        } else{
            move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $filename);
            echo "Your file was uploaded successfully.";
        } 
    } else{
        echo "Error: There was a problem uploading your file. Please try again."; 
    }
} else{
    echo "Error: " . $_FILES["photo"]["error"];
}



$sql = "INSERT INTO products (product_name, Category, Price, Photo, Supplier)
VALUES ('John', 'Doe', 'john@example.com')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>