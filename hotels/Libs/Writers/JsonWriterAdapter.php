<?php

namespace Hotels\Libs\Writers;

use Hotels\Contracts\DataWriterInterface;

/**
 * Class JsonWriterAdapter
 * @package Hotels\Libs\writers
 */
class JsonWriterAdapter implements DataWriterInterface
{
    /**
     * Write data into file
     * @param array $data
     * @return string
     * @throws \Hotels\Exceptions\FileException
     */
    public function write(array $data)
    {
        return (new JsonWriter($data))->write();
    }
}