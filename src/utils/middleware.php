<?php

require_once __DIR__ . "/database/database.php";

function connectToDB($fn)
{
    return function ($event) use ($fn) {
        $database = new Database();
        $result = $fn($event, $database->conn);
        $database->close();

        return $result;
    };
}

function formatResponse(int $code, $body)
{
    return [
        'statusCode' => $code,
        'body' => json_encode($body),
        'headers' => [
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Headers' => '*',
            'Access-Control-Allow-Origin' => getenv('WEBPAGE_URL'),
            'Access-Control-Allow-Methods' => '*',
            'Access-Control-Allow-Credentials' => true,
        ]
    ];
}

function httpErrorHandler($fn)
{
    return function ($event) use ($fn) {
        try {
            return $fn($event);
        } catch (Exception $e) {
            return formatResponse(500, [
                "ok" => FALSE,
                "message" => "Error: " . $e->getMessage()
            ]);
        }
    };
}
