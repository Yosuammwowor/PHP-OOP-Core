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
        foreach ($rawData as $d) {
            echo "{$d["name"]} - Price: " . PriceHelper::formatPrice($d["price"]) . "\n";
        }
    }

    function ServiceCheckStatus($name, $data)
    {
        $target = str_replace(' ', '', strtolower($name));

        $status = false;
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
}

class PriceHelper
{
    static function formatPrice($value)
    {
        $priceFormat = "IDR " . number_format($value, 0, ".", ".");
        return $priceFormat;
    }
}
