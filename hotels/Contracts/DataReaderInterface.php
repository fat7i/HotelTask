<?php

namespace Hotels\Contracts;

interface DataReaderInterface
{
    public function read ($filePath, $options = null);
}
