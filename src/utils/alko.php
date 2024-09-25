<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

function getAlkoProducts()
{
    ini_set('memory_limit', '516M');

    $xlsxContent = file_get_contents(getenv('ALKO_PRICES_URL'));
    if ($xlsxContent === FALSE) {
        throw new Exception("Error fetching alko products.");
    }

    $tempFile = tmpfile();
    fwrite($tempFile, $xlsxContent);
    $tempFilePath = stream_get_meta_data($tempFile)['uri'];

    $spreadsheet = IOFactory::load($tempFilePath);
    fclose($tempFile);

    $sheet = $spreadsheet->getActiveSheet();
    $rows = array_slice($sheet->toArray(), 4);

    return $rows;
}
