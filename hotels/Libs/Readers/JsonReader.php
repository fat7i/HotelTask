<?php

namespace Hotels\libs\Readers;

use Hotels\Exceptions\FileException;


class JsonReader extends AbstractReader
{

    /**
     * Read File contents then parse a contents string into an array of hotels data, then validate, filter and sort
     * @return array of hotels data
     * @throws FileException if the file not found or can't read it
     */
    public function read ()
    {
        try
        {
            $contents = file_get_contents(storage_path($this->filePath));
        }
        catch (\Exception $e)
        {
            throw new FileException('File not found: '. $e->getMessage());
        }

        //-- convert hotels data to array
        $data = json_decode($contents, true);

        //-- validate hotels data
        $this->data = $this->validate($data);

        //-- applying filters
        $this->data = $this->filter();

        //-- sort hotels array
        $this->data = $this->sort();


        return $this->data;
    }
}