<?php

$users = User::getAll();

if(isset($_POST['submitF'])){
    $creatorId = $_SESSION['user_id'];
    $newRoom = new Room($_POST["name_room"], $creatorId);
    $newRoom->save();

    $selectedUsers = $_POST['users'];
    foreach($selectedUsers as $userId) {

        $newUserRoom = new UserRoom($userId, $newRoom->getId());
        $newUserRoom->addUserToRoom();
    }
    $newUserRoom = new UserRoom($creatorId, $newRoom->getId(), 'admin');
        $newUserRoom->addUserToRoom();

}
?>