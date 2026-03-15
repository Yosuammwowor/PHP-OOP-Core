<?php

class Equipment
{
    private $db, $nama, $price, $status;

    function __construct()
    {
        try {
            $this->db = fopen(__DIR__ . "/Storage.json", "r+");

            if (!$this->db) {
                throw new Exception("Error: File Connection failed");
            }

            echo "File Connection Success!!!";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // function getAllEquipment() {

    // }

}

$test = new Equipment();
