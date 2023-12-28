<?php

class User
{
    public $id;
    public $email;
    public $username;
    private $password;

    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->setPassword($password);
    }

    static function getAll()
    {
        global $db;
        $result = $db->query("SELECT * FROM user");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function edit()
    {
        global $db;
        return $db->query("UPDATE user SET email = '$this->email', name = '$this->username' WHERE user_id = '$this->id'");
    }

    public function setPassword($pwd)
    {
        $this->password = password_hash($pwd, PASSWORD_DEFAULT);
    }

    static function getUser($email, $password) {
        global $db;
        $stmt = $db->prepare("SELECT id_user, name, password FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($userId, $username, $hashedPass);
        $stmt->fetch();
        $stmt->close();
    
        if (!$hashedPass) {
            echo "Invalid email or password.";
        } else {
            if (password_verify($password, $hashedPass)) {
                $_SESSION["user_id"] = $userId;
                $_SESSION["username"] = $username;
    
                header("Location: index.php?page=home1");
                exit;
            } else {
                echo "Invalid email or password.";
            }
        }
    }
    

    function insertUser(){
        global $db;
        $db->query("INSERT INTO user (name, email, password) VALUES 
        ('$this->username', '$this->email', '$this->password')");
    }
}