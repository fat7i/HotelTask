<?php

namespace Hotels\Libs\Writers;

use Hotels\Contracts\DataWriterInterface;

class CsvWriterAdapter implements DataWriterInterface
{
    /**
     * @param array $data
     * @return string
     * @throws \Hotels\Exceptions\FileException
     */
    public function write(array $data)
    {
        return (new CsvWriter($data))->write();
    }
}