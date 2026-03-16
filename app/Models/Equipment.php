<?php

namespace App\Models;

class Equipment
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = fopen(__DIR__ . "/Storage.json", "r+");

            if (!$this->db) {
                throw new \Exception("Error: File Connection failed");
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAllEquipment()
    {
        rewind($this->db);

        $size = filesize(__DIR__ . "/Storage.json");

        if ($size > 0) {
            $file = fread($this->db, $size);
            return json_decode($file, true);
        }

        return [];
    }

    public function __destruct()
    {
        fclose($this->db);
        echo "Database connection close";
    }
}
