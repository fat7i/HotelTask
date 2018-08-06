<?php

namespace Hotels\libs\Readers;

use Hotels\Contracts\DataReaderInterface;

class CsvReaderAdapter implements DataReaderInterface
{
    /**
     * @param $filePath path of data file
     * @param null $options array of filters and storing
     * @return array array of hotels data
     * @throws \Hotels\Exceptions\FileException
     */
    public function read($filePath, $options = null)
    {
        return (new CsvReader($filePath, $options))->read();
    }
}