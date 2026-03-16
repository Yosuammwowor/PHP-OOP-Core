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
        $data = $this->equip;
        $service = $this->service;
        $service->ServiceGetTools($data);
        $service->logActivity("Log: Access to get all tools");
    }

    public function rentTool($name)
    {
        $data = $this->equip;
        $service = $this->service;

        $service->ServiceRentTool($name, $data);
        $service->logActivity("Log: Access to check tool status");
    }

    public function checkStatus($name)
    {
        $data = $this->equip->getAllEquipment();
        $service = $this->service;

        $service->ServiceCheckStatus($name, $data);
        $service->logActivity("Log: Access to check tool status");
    }
}
