<?php

namespace App\Services;

require __DIR__ . "/../../vendor/autoload.php";

use App\Traits\LoggerTrait;

class RentalService
{
    use LoggerTrait;

    function ServiceGetTools($data)
    {
        $rawData = $data->getAllEquipment();
        $count = 1;
        foreach ($rawData as $d) {
            echo $count++ . ". {$d["name"]}\n";
            echo "Tipe\t: " . $d["tipe"] . "\n";
            echo "Price\t: " . PriceHelper::formatPrice($d["price"]) . "\n";
        }
    }

    function ServiceCheckStatus($name, $data)
    {
        $target = str_replace(' ', '', strtolower($name));

        $status = null;
        foreach ($data as $d) {

            if (str_replace(' ', '', strtolower($d["name"])) !== $target) {
                continue;
            }

            if ($d["status"] === "Dipinjam") {
                echo "Status Barang : {$d["status"]}\n";
                return;
            }

            $status = true;
            echo "Status Barang : {$d["status"]}\n";
        }

        if (!$status) {
            error_log("Error: Barang Tidak ditemukan!!!\n");
        }
    }

    function ServiceRentTool($name, $model)
    {
        $data = $model->getAllEquipment();
        $target = str_replace(' ', '', strtolower($name));
        $tempData = [];

        $status = null;
        foreach ($data as $d) {
            if (str_replace(' ', '', strtolower($d["name"])) !== $target) {
                array_push($tempData, $d);
                continue;
            }

            if ($d["status"] === "Dipinjam") {
                echo "Invalid, Barang sedang dipinjam\n";
                return;
            }

            $status = true;
            $d["status"] = "Dipinjam";
            array_push($tempData, $d);

            $rentPrice = $d["tipe"] === "Hardware" ? $d["price"] * 0.25 : $d["price"] * 0.5;
            echo "Rent Price : " . PriceHelper::formatPrice($rentPrice);
        }

        if (!$status) {
            die("Error: Barang Tidak ditemukan!!!\n");
        }

        $model->updateEquipments($tempData);
        echo "\nData successfully updated\n";
    }
}

class PriceHelper
{
    static function formatPrice($value)
    {
        $priceFormat = "IDR " . number_format($value, 0, ".", ".");
        return $priceFormat;
    }
}
