<?php
// Start the session
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'db_connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        die("Invalid input.");
    }

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare SQL statement
    if ($stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE email = ?")) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Check if a user was found
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $hashed_password, $role);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Store user information in session
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                // Redirect based on user role
                if ($role == 'admin') {
                    header("Location: /Ziara/Admin pannel/admin-panel.html");
                } elseif ($role == 'customer') {
                    header("Location: /Ziara/index.html");
                } else {
                    header("Location:/Home.html");
                }
                exit();
            } else {
                echo "<script>alert('Invalid password!'); window.location.href='/Ziara/login/login.html';</script>";
            }
        } else {
            echo "<script>alert('No user found with this email!'); window.location.href='/Ziara/login/login.html';</script>";
        }

        // Close statement
        $stmt->close();
    } else {
        die("Database query failed: " . $conn->error);
    }

    // Close connection
    $conn->close();
}

// If the user is already logged in, display content based on role
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        echo "<h1>Admin Dashboard</h1>";
        // Additional admin content
    } elseif ($_SESSION['role'] == 'customer') {
        echo "<h1>Customer Homepage</h1>";
        // Additional customer content
    } else {
        echo "<h1>Welcome to our site</h1>";
        // Default content
    }
} else {
    header("Location: /Ziara/login/login.html");
    exit();
}
?>



