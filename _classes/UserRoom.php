<?php

class UserRoom {
    private $userId;
    private $roomId;
    private $role;

    public function __construct($userId, $roomId, $role = 'member') {
        $this->userId = $userId;
        $this->roomId = $roomId;
        $this->role = $role;
    }

    public function addUserToRoom() {
        global $db;
        $query = "INSERT INTO user_room (id_user, id_room, role) VALUES (?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("iis", $this->userId, $this->roomId, $this->role);
        $stmt->execute();
        $stmt->close();
    }
}


?>