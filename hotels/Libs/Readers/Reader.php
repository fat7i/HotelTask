<?php

namespace Hotels\libs\Readers;

use Hotels\Exceptions\ReaderException;

class Reader
{
    /**
     * @var $filePath path of data file
     */
    private $filePath;

    /**
     * @var $options array of filters and storing
     */
    private $options;

    /**
     * @var CsvReaderAdapter|JsonReaderAdapter|XmlReaderAdapter
     */
    private $dataReader;

    /**
     * Reader constructor.
     * @param $filePath path of data file
     * @param null $options array of filters and storing
     * @throws ReaderException
     */
    public function __construct($filePath, $options = null)
    {
        $this->filePath = $filePath;

        $this->options = $options;

        $this->dataReader = $this->setAdapter();
    }

    /**
     * @return array of hotels data
     */
    public function read ()
    {
        return $this->dataReader->read($this->filePath, $this->options);
    }

    /**
     * @return CsvReaderAdapter|JsonReaderAdapter|XmlReaderAdapter
     * @throws ReaderException
     */
    public function setAdapter ()
    {
        $fileInfo = pathinfo($this->filePath);

        $fileType = $fileInfo['extension'];

        switch ($fileType)
        {
            case "json":
            case "js":
                $readerAdapter = new JsonReaderAdapter();
                break;
            case "xml":
                $readerAdapter = new XmlReaderAdapter();
                break;
            case "csv":
                $readerAdapter = new CsvReaderAdapter();
                break;
            default:
                throw new ReaderException('No reader adapter for '.$fileType.' files');
                break;
        }

        return $readerAdapter;
    }
}