<?php

namespace Hotels\Contracts;

interface DataWriterInterface
{
    public function write (array $hotelsData);
}