<?php

namespace Hotels\Libs\Writers;

use Hotels\Contracts\DataWriterInterface;

/**
 * Class HtmlWriterAdapter
 * @package Hotels\Libs\writers
 */
class HtmlWriterAdapter implements DataWriterInterface
{
    /**
     * Write data into file
     * @param array $data
     * @return string
     * @throws \Hotels\Exceptions\FileException
     */
    public function write(array $data)
    {
        return (new HtmlWriter($data))->write();
    }
}