<?php

class News
{
    private $db = null;
    private function __construct()
    {
        $this->db = Database::getInstance();
    }

    public static function getInstance()
    {
        static $instance = null;

        if($instance === null){
            $instance = new News();
        }
        return $instance;
    }

    public function getAllNews()
    {
        $array = [];
        $sql = $this->db->query('SELECT * FROM noticias');
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getNew($id)
    {
        $array = [];
        $sql = $this->db->prepare('SELECT * FROM noticias WHERE id = :id');
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }
        return $array;
    }
}