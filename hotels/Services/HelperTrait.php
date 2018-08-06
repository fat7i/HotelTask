<?php

namespace Hotels\Services;


trait HelperTrait
{

    /**
     * @return mixed array of data source files
     */
    public static function getDataFiles ()
    {
        $output = [];
        $input_dir = env('INPUT_DIR');

        $dir = storage_path($input_dir);

        $files = scandir($dir);

        foreach($files as $file)
        {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $output[] = ['filename' => $file, 'filepath' => $input_dir.'/'.$file];
        }

        return $output;
    }

}