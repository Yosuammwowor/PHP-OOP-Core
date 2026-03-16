<?php

namespace App\Controllers;

require __DIR__ . "/../../vendor/autoload.php";

use App\Models\Equipment;
use App\Services\RentalService;

class RentalController
{
    private $equip, $service;

    public function __construct(Equipment $equip, RentalService $service)
    {
        $this->equip = $equip;
        $this->service = $service;
    }

    public function getTools()
    {
        $rawData = $this->equip->getAllEquipment();
        foreach ($rawData as $data) {
            echo "{$data["name"]} - Price: {$data["price"]}\n";
        }
    }

    public function checkStatus($name)
    {
        $data = $this->equip->getAllEquipment();
        $service = $this->service;

        $service->ServiceCheckStatus($name, $data);
    }
}
