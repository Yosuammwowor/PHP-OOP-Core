<?php

require "vendor/autoload.php";

use App\Controllers\RentalController;
use App\Models\Equipment;

$equipment = new Equipment();

$controller = new RentalController($equipment);
$controller->getUser();
