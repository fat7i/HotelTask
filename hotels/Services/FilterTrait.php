<?php

namespace Hotels\Services;


trait FilterTrait
{

    /**
     * @param $hotel array of hotel data
     * @param $filters array of filters
     * @return bool
     */
    public static function apply ($hotel, $filters)
    {
        if (isset($hotel) && isset($filters))
        {
            $checkList = [];
            foreach ($filters as $filter=>$filterParams)
            {
                $checkList[] = self::$filter($hotel, $filterParams);
            }
        }
        return !in_array(false, $checkList);
    }

    /**
     * @param $hotel array of hotel data
     * @param $stars array of selected stars
     * @return bool
     */
    public static function stars ($hotel, $stars)
    {
        if (isset($stars))
            return in_array($hotel['stars'], $stars);
        else
            return false;
    }
}

