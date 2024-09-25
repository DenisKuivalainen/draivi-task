<?php

declare(strict_types=1);

require_once __DIR__ . "/../utils/database/products.php";
require_once __DIR__ . "/../utils/middleware.php";
require_once __DIR__ . "/../utils/alko.php";
require_once __DIR__ . "/../utils/currency.php";

return connectToDB(function ($event, $conn) {
    $productsRepository = new Products($conn);

    $EURGBP = getEurToGbp();
    $alkoProducts = getAlkoProducts();

    foreach ($alkoProducts as $p) {
        $number = (int)$p[0];
        $name = $p[1];
        $bottlesize = $p[3] ?? "";
        $price = (float)$p[4];
        $price_gbp = $price * $EURGBP;

        $productsRepository->addProduct($number, $name, $bottlesize, $price, $price_gbp);
    }
});
