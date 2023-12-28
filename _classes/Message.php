<?php

class Message {
    private $id;
    private $content;
    private $sendDate;
    private $userId;
    private $roomId;

    public function __construct($content, $userId, $roomId, $sendDate = null) {
        $this->content = $content;
        $this->userId = $userId;
        $this->roomId = $roomId;
        $this->sendDate = $sendDate ?: date('Y-m-d H:i:s');
    }

    public function save() {
        global $db;
        $stmt = $db->prepare("INSERT INTO message (contenu, date_envoi, id_user, id_room) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $this->content, $this->sendDate, $this->userId, $this->roomId);
        $stmt->execute();
        $stmt->close();
    }

    static function getMessagesByRoom($roomId) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM message WHERE id_room = ?");
        $stmt->bind_param("i", $roomId);
        $stmt->execute();
        $result = $stmt->get_result();
        $messages = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $messages;
    }
}

?>