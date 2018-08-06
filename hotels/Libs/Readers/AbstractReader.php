<?php

namespace Hotels\libs\Readers;

use Validator;
use Hotels\Services\FilterTrait;
use Hotels\Services\SortTrait;

/**
 * Class AbstractReader
 * @package Hotels\libs\readers
 */
abstract class AbstractReader
{
    /**
     * @var $filePath path of data file
     */
    protected $filePath;
    /**
     * @var $options array of filters and storing
     */
    protected $options;

    /**
     * @var $data array of hotels data
     */
    protected $data;



    use FilterTrait, SortTrait;


    /**
     * AbstractReader constructor.
     * @param $filePath
     * @param $options
     */
    public function __construct($filePath, $options)
    {
        $this->filePath = $filePath;
        $this->options = $options;
    }

    /**
     * Read File contents then parse a contents string into an array of hotels data, then validate, filter and sort
     */
    public function read(){}

    /**
     * Validate if the hotel array has a valid data or not
     * @param $data array of hotels data
     * @return array
     */
    public function validate($data)
    {
        $output = [];
        $invalid = [];
        foreach ($data as $hotel)
        {
            // validate hotels data
            $isHotelValid = Validator::make($hotel, [
                'name' => 'required|is_pure_ascii',
                'stars' => 'required|integer|between:1,5',
                'uri' => 'url',
                'phone' => 'required|phone'
            ])->Passes();


            if ($isHotelValid)
                $output[] = $hotel;
            else
                $invalid[] = $hotel;

        }//--END: foreach


        if($invalid) //-- log invalid data if exist
        \Log::info('Invalid date from file: '.$this->filePath. ', data: '.var_export($invalid, true));

        return $this->data = $output;
    }

    /**
     * Apply filters on hotels data
     * @return array of filtered hotels
     */
    public function filter()
    {
        // apply filters if exists
        if ( $this->options && key_exists('filter', $this->options) )
        {
            $output = [];
            foreach ($this->data as $hotel)
            {

                if (FilterTrait::apply($hotel, $this->options['filter']))
                    $output[] = $hotel;

            }//--END: foreach

            $this->data = $output;
        }

        return $this->data;
    }

    /**
     * Sort the hotels data array
     * @return array of sorted hotels
     */
    public function sort()
    {
        // sorting output
        if ($this->data && $this->options && key_exists('sort', $this->options))
        {
            SortTrait::sortArray($this->data, $this->options['sort']);
        }

        return $this->data;
    }
}