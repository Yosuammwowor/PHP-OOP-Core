<?php

namespace App\Controllers;

require __DIR__ . "/../../vendor/autoload.php";

use App\Models\Equipment;

class RentalController
{
    private $equip;

    public function __construct(Equipment $equip)
    {
        $this->equip = $equip;
    }

    public function getUser()
    {
        // print_r($this->equip->getAllEquipment());
        $rawData = $this->equip->getAllEquipment();
        foreach ($rawData as $data) {
            echo "{$data["name"]} - Price: {$data["price"]}\n";
        }
    }
}
