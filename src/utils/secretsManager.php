<?php

use Aws\Sdk;
use Aws\Exception\AwsException;

function getSecret(string $secretArn)
{
    $sdk = new Sdk([
        'region'   => getenv('REGION'),
    ]);

    $client = $sdk->createSecretsManager();

    try {
        $result = $client->getSecretValue(['SecretId' => $secretArn]);

        if (isset($result['SecretString'])) {
            return json_decode($result['SecretString'], true);
        }
    } catch (AwsException $e) {
        // Output error message if fails
        echo "Error retrieving secret: " . $e->getMessage();
        return null;
    }
}
