<?php

namespace App\Models;

class Equipment
{
    private static $db;
    // private $name, $price, $status;

    function __construct()
    {
        try {
            self::$db = fopen(__DIR__ . "/Storage.json", "r+");

            if (!self::$db) {
                throw new \Exception("Error: File Connection failed");
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    function getAllEquipment()
    {
        $file = fread(self::$db, 1024);

        $res = json_decode($file, true);

        return $res;
    }
}
