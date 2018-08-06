<?php

namespace Tests\Unit;

use Hotels\libs\Readers\JsonReaderAdapter;
use Hotels\Libs\Writers\Writer;
use Tests\TestCase;

class WriterTest extends TestCase
{
    /**
     * Assert if output folder is exist,
     * assert if output folder is writable
     */
    public function testOutputFolderIsExist()
    {
        $folderPath = storage_path('/app/data/output');

        //-- assert if folder exist
        $this->assertTrue(file_exists($folderPath), "Output folder not exist: ". $folderPath);
        //-- assert if folder is writable
        $this->assertFileIsWritable($folderPath, "Output folder not writable: ". $folderPath);
    }

    /**
     * Test writing data into CSV file
     * @throws \Hotels\Exceptions\FileException
     */
    public function testWritingCsvFile()
    {
        $filePath = 'app/data/input/hotels.json';

        $output = (new JsonReaderAdapter())->read($filePath);

        //- assert the $output is array
        $this->assertInternalType('array',$output);

        $writer = new Writer('csv', $output);
        $filename = $writer->write();

        //-- assert if folder exist
        $this->assertTrue(file_exists($filename), "Can't find file: ". $filename);
    }

    /**
     * Test writing data into Xml file
     * @throws \Hotels\Exceptions\FileException
     */
    public function testWritingXmlFile()
    {
        $filePath = 'app/data/input/hotels.json';

        $output = (new JsonReaderAdapter())->read($filePath);

        //- assert the $output is array
        $this->assertInternalType('array',$output);

        $writer = new Writer('xml', $output);
        $filename = $writer->write();

        //-- assert if folder exist
        $this->assertTrue(file_exists($filename), "Can't find file: ". $filename);
    }

    /**
     * Test writing data into JSON file
     * @throws \Hotels\Exceptions\FileException
     */
    public function testWritingJsonFile()
    {
        $filePath = 'app/data/input/hotels.json';

        $output = (new JsonReaderAdapter())->read($filePath);

        //- assert the $output is array
        $this->assertInternalType('array',$output);

        $writer = new Writer('json', $output);
        $filename = $writer->write();

        //-- assert if folder exist
        $this->assertTrue(file_exists($filename), "Can't find file: ". $filename);
    }

    /**
     * Test writing data into Html file
     * @throws \Hotels\Exceptions\FileException
     */
    public function testWritingHtmlFile()
    {
        $filePath = 'app/data/input/hotels.json';

        $output = (new JsonReaderAdapter())->read($filePath);

        //- assert the $output is array
        $this->assertInternalType('array',$output);

        $writer = new Writer('html', $output);
        $filename = $writer->write();

        //-- assert if folder exist
        $this->assertTrue(file_exists($filename), "Can't find file: ". $filename);
    }

}
