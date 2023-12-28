<?php

$users = User::getAll();
$rooms = Room::getAllRooms();

if(isset($_POST['submitF'])){
    $creatorId = $_SESSION['user_id'];

    $picture_name = $_FILES['picture']['name'];
    $picture_tmp = $_FILES['picture']['tmp_name'];
    move_uploaded_file($picture_tmp, "./assets/img/$picture_name");
    
    $newRoom = new Room($_POST["name_room"], $creatorId, $picture_name);
    $newRoom->save();

    $selectedUsers = $_POST['users'];
    foreach($selectedUsers as $userId) {

        $newUserRoom = new UserRoom($userId, $newRoom->getId());
        $newUserRoom->addUserToRoom();
    }
    $newUserRoom = new UserRoom($creatorId, $newRoom->getId(), 'admin');
        $newUserRoom->addUserToRoom();

        header("Location: index.php?page=home1");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id']) && isset($_POST['room_id']) && isset($_POST['messageInput'])){
    $userId = $_POST['user_id'];
    $roomId = $_POST['room_id'];
    $content = $_POST['messageInput'];

    $message = new Message($content, $userId, $roomId);
    $message->save();
    header("Location: index.php?page=home1&room=$roomId");
    exit();
}


// if(isset($_POST['submitM'])) {
//     $userId = $_POST['user_id'];
//     $roomId = $_POST['room_id'];
//     $content = $_POST['messageInput'];
    
    
//     $message = new Message($content, $userId, $roomId);
//     $message->save();
//     header("Location: index.php?page=home1&room=$roomId");
//     exit();
    
// }

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();

    header("Location: index.php?page=login");
}


?>