<?php

namespace Hotels\Libs\Writers;

use Hotels\Exceptions\FileException;


class CsvWriter extends AbstractWriter
{

    /**
     * Write data into file
     * @return string of full file path
     * @throws FileException
     */
    public function write()
    {
        $filename = $this->filePath . 'hotels-'. time().'.csv';

        $data = $this->arrayToCsv($this->data);

        $fp = fopen($filename, 'w');

        try {
            fwrite($fp, $data);
        } catch (\Exception $e) {
            throw new FileException('Can not save file!.');
        }
        fclose($fp);

        return $filename;
    }

    /**
     * Convert array into CSV string
     * @param array $array
     * @return null|string
     */
    function arrayToCsv(array &$array)
    {
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array)));
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        return ob_get_clean();
    }

}