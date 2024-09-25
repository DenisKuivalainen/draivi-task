<?php

declare(strict_types=1);

require_once __DIR__ . "/../utils/database/products.php";
require_once __DIR__ . "/../utils/middleware.php";

return httpErrorHandler(connectToDB(function ($event, $conn) {
    $productsRepository = new Products($conn);

    $products = $productsRepository->getAll();

    return formatResponse(200, [
        'ok' => TRUE,
        'data' => $products
    ]);
}));
