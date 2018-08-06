<?php

namespace Hotels\Libs\Writers;

use Hotels\Exceptions\WriterException;


/**
 * Class Writer
 * @package Hotels\Libs\writers
 */
class Writer
{

    /**
     * @var $data The hotels data that will saved into file
     */
    private $data;

    /**
     * @var $fileType Where the files will be exported
     */
    private $fileType;

    /**
     * @var CsvWriterAdapter|HtmlWriterAdapter|JsonWriterAdapter
     */
    private $dataWriter;

    /**
     * Writer constructor.
     * @param $fileType
     * @param $data
     */
    public function __construct($fileType, $data)
    {
        $this->data = $data;

        $this->fileType = $fileType;

        $this->dataWriter = $this->setAdapter();
    }

    /**
     * Set writer adapter based on file extension type
     * @return CsvWriterAdapter|HtmlWriterAdapter|JsonWriterAdapter
     */
    public function setAdapter()
    {
        switch ($this->fileType)
        {
            case "csv":
                $dataWriter = new CsvWriterAdapter();
                break;
            case "json":
                $dataWriter = new JsonWriterAdapter();
                break;
            case "html":
                $dataWriter = new HtmlWriterAdapter();
                break;
            case "xml":
                $dataWriter = new XmlWriterAdapter();
                break;
            default:
                throw new WriterException('No writer adapter for '.$this->fileType.' files');
                break;
        }

        return $dataWriter;
    }

    /**
     * Write data into file
     * @return string
     */
    public function write()
    {
        return $this->dataWriter->write($this->data);
    }
}