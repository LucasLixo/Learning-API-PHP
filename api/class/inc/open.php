<?php

function openCSV(string $file): string|array
{
    $csvFile = __DIR__ . '/../../db/' . $file . '.csv';

    if (!file_exists($csvFile) || !is_readable($csvFile)) {
        return 'CSV file not found or not readable.';
    }

    $data = array();

    if (($handle = fopen($csvFile, 'r')) !== false) {
        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $data[] = $row;
        }
        fclose($handle);
    } else {
        return 'Error opening file.';
    }

    return $data;
}

?>