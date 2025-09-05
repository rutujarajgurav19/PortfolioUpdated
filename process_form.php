<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "portfolio";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $message = isset($_POST['message']) ? trim($_POST['message']) : "";

    // Check if fields are empty
    if (empty($name) || empty($email) || empty($message)) {
        die("Error: All fields are required.");
    }

    // Prepare and execute query
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!'); window.location.href='index.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement & connection
    $stmt->close();
    $conn->close();
} else {
    die("Invalid request.");
}
?>
