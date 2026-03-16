<?php

namespace App\Services;

require __DIR__ . "/../../vendor/autoload.php";

class RentalService
{
    function ServiceCheckStatus($name, $data)
    {
        $target = str_replace(' ', '', strtolower($name));

        $status = false;
        foreach ($data as $d) {

            if (str_replace(' ', '', strtolower($d["name"])) !== $target) {
                continue;
            }

            if ($d["status"] === "Dipinjam") {
                echo "Status Barang : {$d["status"]}";
                return;
            }

            $status = true;
            echo "Status Barang : {$d["status"]}";
        }

        if (!$status) {
            error_log("Error: Barang Tidak ditemukan!!!");
        }
    }
}
