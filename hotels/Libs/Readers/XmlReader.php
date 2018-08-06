<?php

namespace Hotels\libs\Readers;

use Hotels\Exceptions\FileException;


class XmlReader extends AbstractReader
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
            $contents = simplexml_load_file(storage_path($this->filePath));
        }
        catch (\Exception $e)
        {
            throw new FileException('File not found: '. $e->getMessage());
        }


        //-- convert hotels data to array
        $data = [];
        foreach ($contents->hotel as $element)
        {
            $hotel = [];
            foreach($element->children() as $key => $val)
            {

                $hotel[$key] = $val->__toString();
            }
            $data[] = $hotel;
        }

        //-- validate hotels data
        $this->data = $this->validate($data);

        //-- applying filters
        $this->data = $this->filter();

        //-- sort hotels array
        $this->data = $this->sort();


        return $this->data;
    }


}