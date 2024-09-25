<?php

function getEurToGbp()
{
    $url = getenv('CURRENCY_URL') . "?access_key=" . getenv('CURRENCY_APIKEY');
    $response = file_get_contents($url);
    if ($response === FALSE) {
        throw new Exception("Error fetching currency rates.");
    }

    $data = json_decode($response);
    $USDGBP = $data->quotes->USDGBP;
    $USDEUR = $data->quotes->USDEUR;

    return ($USDGBP / $USDEUR);
}
