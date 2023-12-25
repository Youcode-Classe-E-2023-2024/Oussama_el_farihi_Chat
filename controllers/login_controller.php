<?php

class LoginController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = UserModel::login($email, $password);

            if ($user) {
                // Successful login
                $_SESSION['user_id'] = $user['id_user']; // Store user ID in session
                header('Location: chat_room.php'); // Redirect to chat room or another page
                exit();
            } else {
                // Invalid credentials, display an error message
                $error_message = "Invalid email or password";
            }
        }

        // Load the login view
        include('views/login_view.php');
    }
}

?>