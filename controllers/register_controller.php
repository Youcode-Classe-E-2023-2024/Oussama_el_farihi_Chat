<?php

class RegisterController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (UserModel::register($name, $email, $password)) {
                // Registration successful, redirect to login page
                header('Location: ?page=login');
                exit();
            } else {
                // Registration failed, display an error message
                $error_message = "Registration failed. Please try again.";
            }
        }

        // Load the registration view
        include('views/register_view.php');
    }
}
 
?>