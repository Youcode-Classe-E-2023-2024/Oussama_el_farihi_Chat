<?php

global $db;
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    
    $stmt = $db->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);
    $result = $stmt->execute();

    if ($result) {
        header('Location: ../views/login_view.php'); 
        exit();
    } else {
        $error_message = "Registration failed: " . $db->error;
        include('../views/register_view.php'); 
    }
}


?>