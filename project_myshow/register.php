<?php
$user = $_POST['username'];
$phone = $_POST['phone'];
$email = $_POST['emailid'];
$password = $_POST['passwd']; // This should match the input name in your form ('passwd')

// Database connectivity
$conn = new mysqli("localhost", "root", "", "ajaykumar"); // Corrected to mysqli and fixed 'localhost'
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // Correcting table name if necessary (assuming it's 'registration')
    $stmt = $conn->prepare("INSERT INTO registration_ (username, phone, emailid, password1) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $user, $phone, $email, $password); // Changed 'siss' to 'ssss' since phone is likely a string
    
     if ($stmt->execute()) {
         echo "Successfully registered!";
         header('Location: login.html');
     } else {
         echo "Error: " . $stmt->error;
    }
    
    $stmt->close(); // Close the statement
    $conn->close(); // Close the connection
}
?>
