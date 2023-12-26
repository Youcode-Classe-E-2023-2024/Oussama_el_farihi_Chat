<?php

class Room
{
    private $id;
    private $name;
    private $creationDate;
    private $creatorId;
    private $picture_name;


    public function __construct($name, $creatorId, $picture_name, $creationDate = null)
    {
        $this->name = $name;
        $this->creatorId = $creatorId;
        $this->picture_name = $picture_name;
        $this->creationDate = $creationDate ?: date('Y-m-d H:i:s');
    }


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function getCreatorId()
    {
        return $this->creatorId;
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


    public function save()
    {
        global $db;
        $stmt = $db->prepare("INSERT INTO room (name_room, date_creation, id_createur, img) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $this->name, $this->creationDate, $this->creatorId, $this->picture_name);
        $stmt->execute();
        $this->id = $db->insert_id;
        $stmt->close();
    }



    static function getAllRooms()
    {
        global $db;
        $result = $db->query("SELECT * FROM room");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>