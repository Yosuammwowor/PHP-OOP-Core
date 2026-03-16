<?php

require "vendor/autoload.php";

use App\Controllers\RentalController;
use App\Services\RentalService;
use App\Models\Equipment;

$equipment = new Equipment();
$service = new RentalService();

$controller = new RentalController($equipment, $service);
// $controller->getUser();
$controller->checkStatus("micv1");
