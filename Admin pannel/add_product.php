<?php
include 'db_connect.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all form fields are set and not empty
    if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['image'])) {
        // Get the values from the form
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image_url = $_POST['image'];


        // Check for connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL query to insert product
        $stmt = $conn->prepare("INSERT INTO products (name, price, image_url) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $price, $image_url);

        // Execute the query
        if ($stmt->execute()) {
            echo "Product added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Please fill out all fields.";
    }
}
?>