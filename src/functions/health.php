<?php

declare(strict_types=1);

require_once __DIR__ . "/../utils/middleware.php";

return httpErrorHandler(function ($event) {
    return formatResponse(200, [
        'ok' => TRUE,
        'message' => 'Healthy so far :D',
    ]);
});
