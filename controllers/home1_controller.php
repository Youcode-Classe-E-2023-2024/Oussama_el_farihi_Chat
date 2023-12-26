<?php

$users = User::getAll();

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

}
?>