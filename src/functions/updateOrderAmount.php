<?php

declare(strict_types=1);

require_once __DIR__ . "/../utils/database/products.php";
require_once __DIR__ . "/../utils/middleware.php";

return httpErrorHandler(connectToDB(function ($event, $conn) {
    $number = (int)$event["pathParameters"]["number"];
    $amount = (int)$event["queryStringParameters"]["amount"];

    $productsRepository = new Products($conn);

    $productsRepository->updateOrderAmount($number, $amount);

    return formatResponse(200, [
        'ok' => TRUE
    ]);
}));
