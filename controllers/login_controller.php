<?php
    if(isset($_POST['submit'])){
        User::getUser($_POST["email"], $_POST["password"]);
    } 
?> 