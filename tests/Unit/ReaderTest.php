<?php

namespace Tests\Unit;

use Hotels\libs\Readers\CsvReaderAdapter;
use Hotels\libs\Readers\JsonReaderAdapter;
use Hotels\libs\Readers\XmlReaderAdapter;
use Tests\TestCase;

class ReaderTest extends TestCase
{
    /**
     * Assert if the input folder is exist,
     * assert if the input folder has a data files
     */
    public function testInputFolderIsExist()
    {
        $folderPath = storage_path('/app/data/input');

        //-- assert if folder exist
        $this->assertTrue(file_exists($folderPath), "Input Folder is not exist, Please create ". $folderPath);
        //-- assert if folder has a files
        $this->assertTrue((count(scandir($folderPath)) > 2),"Input Folder ({$folderPath}) is Empty");
    }

    /**
     * Test reading data from JSON file
     * @throws \Hotels\Exceptions\FileException
     */
    public function testReadJsonFile()
    {
        $filePath = 'app/data/input/hotels.json';

        $output = (new JsonReaderAdapter())->read($filePath);

        //- assert the $output is array
        $this->assertInternalType('array',$output);
        //-- assert if $output array have a hotel array keys
        $this->assertTrue( (['name', 'address', 'stars', 'contact', 'phone','uri']===array_keys($output[0])));
    }

    /**
     * Test reading data from XML file
     * @throws \Hotels\Exceptions\FileException
     */
    public function testReadXmlFile()
    {
        $filePath = 'app/data/input/hotels.xml';
        $output = (new XmlReaderAdapter())->read($filePath);

        //- assert the $output is array
        $this->assertInternalType('array',$output);
        //-- assert if $output array have a hotel array keys
        $this->assertTrue( (['name', 'address', 'stars', 'contact', 'phone','uri']===array_keys($output[0])));
    }

    /**
     * Test reading data from CSV file
     * @throws \Hotels\Exceptions\FileException
     */
    public function testReadCsvFile()
    {
        $filePath = 'app/data/input/hotels.csv';
        $output = (new CsvReaderAdapter())->read($filePath);

        //- assert the $output is array
        $this->assertInternalType('array',$output);
        //-- assert if $output array have a hotel array keys
        $this->assertTrue( (['name', 'address', 'stars', 'contact', 'phone','uri']===array_keys($output[0])));
    }


}
