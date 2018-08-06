<?php

namespace Hotels\Libs\Writers;

use Hotels\Exceptions\FileException;


class JsonWriter extends AbstractWriter
{

    /**
     * Write data into file
     * @return string
     * @throws FileException
     */
    public function write ()
    {
        $filename = $this->filePath . 'hotels-'. time().'.json';

        $fp = fopen($filename, 'w');

        $json = json_encode($this->data);

        try {
            fwrite($fp, $json);
        } catch (\Exception $e) {
            throw new FileException('Can not save file!.');
        }
        fclose($fp);

        return $filename;
    }
}