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

    public static function getRoomMembers($roomId) {
        global $db;
        
        $members = array();

        $query = "SELECT u.name FROM user_room ur
                  INNER JOIN user u ON ur.id_user = u.id_user
                  WHERE ur.id_room = ?";
        
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $roomId);
        $stmt->execute();
        $stmt->bind_result($memberName);

        while ($stmt->fetch()) {
            $members[] = $memberName;
        }

        $stmt->close();

        return $members;
    }
}


?>