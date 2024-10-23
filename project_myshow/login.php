<?php

$email = $_POST['emailcheck'];
$password = $_POST['passwordcheck']; // This should match the input name in your form ('passwd')

// Database connectivity
$conn =new mysqli("localhost", "root", "", "ajaykumar"); // Corrected to mysqli and fixed 'localhost'
if ($conn->connect_error) {
    die("Failed to connect: " . $conn->connect_error);
} else {
    // // Correcting table name if necessary (assuming it's 'registration')
    $stmt = $conn->prepare("SELECT emailid,password1 FROM registration_ where  emailid= ?");// INSERT INTO registration_ (username, phone, emailid, password1) VALUES (?, ?, ?, ?)");
   
    $stmt->bind_param("s",$email); // Changed 'siss' to 'ssss' since phone is likely a string
    $stmt->execute();
    $result = $stmt->get_result();
    //  if ($stmt->execute()) {
    
    //  } else {
    
    //      echo "Error: " . $stmt->error;
    //}
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dbPassword = $row['password1'];
        echo $dbPassword;
        // Verify the provided password against the hashed password from the database
        if ($password = $dbPassword) {
            echo "Login successful!";
            header('Location: demo1.html');
            // Optionally set session variables or redirect to another page
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email address.";
    }
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
    // $stmt->close(); // Close the statement
    // $conn->close(); // Close the connection
}
?>
