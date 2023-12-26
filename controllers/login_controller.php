<?php
    if(isset($_POST['submit'])){
        session_unset();
        session_destroy();
    }
    
    if(isset($_POST['submit'])){
        User::getUser($_POST["email"], $_POST["password"]);
    } 