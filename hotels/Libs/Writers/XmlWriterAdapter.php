<?php

namespace Hotels\Libs\Writers;

use Hotels\Contracts\DataWriterInterface;

class XmlWriterAdapter implements DataWriterInterface
{
    /**
     * Write data into file
     * @param array $data
     * @return string
     * @throws \Hotels\Exceptions\FileException
     */
    public function write(array $data)
    {
        return (new XmlWriter($data))->write();
    }
}