<?php

namespace Hotels\Libs\Writers;


/**
 * Class AbstractWriter
 * @package Hotels\libs\writers
 */
abstract class AbstractWriter
{
    /**
     * @var $data The hotels data that will saved into file
     */
    protected $data;

    /**
     * @var $fileType Where the files will be exported
     */
    protected $filePath;

    /**
     * AbstractWriter constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->filePath = storage_path(env('OUTPUT_DIR')).'/';

        $this->data = $data;
    }
}