<?php

declare(strict_types=1);

require_once __DIR__ . "/../utils/database/products.php";
require_once __DIR__ . "/../utils/middleware.php";

return connectToDB(function ($event, $conn) {
    $productsRepository = new Products($conn);

    switch ($event['event']) {
        case 'down':
            $productsRepository->migrateDown();
            break;

        case 'up':
        default:
            $productsRepository->migrateUp();
            break;
    }
});
