<?php

namespace Database\Seeders;

trait OpeneCommerceFileTrait
{
    /**
     * Load given users.csv
     *
     * @param string $filename
     * @return array
     */
    public function open_file($filename)
    {
        $file_path = storage_path("/data/$filename");
        $file = fopen($file_path, 'r');
        # Skipping first line
        fgets($file);
        while(!feof($file)){
            yield fgetcsv($file, 0);
        }
        fclose($file);
    }
}