<?php

namespace Hotels;

use Illuminate\Http\Request;
use Hotels\libs\readers\Reader;
use Hotels\Libs\writers\Writer;


class Hotel
{

    public static function export (Request $request)
    {
        $options = $request->all();

        //-- read, validate, filter and sort hotels data
        $filePath = $request->read_from;
        $reader = new Reader($filePath, $options);
        $hotelsData = $reader->read();


        //-- write data into file
        $fileType = $request->write_to;
        $writer = new Writer($fileType, $hotelsData);
        $filename = $writer->write();

        return $filename;
    }

}
