<?php

namespace Hotels\Services;


trait SortTrait
{
    /**
     * @param $array array to sort
     * @param $sort array, use [key] as sort by, and [value] as sort flag
     */
    public static function sortArray (&$array, $sort)
    {
        foreach ($array as $key => $row) {
            foreach ( $sort as $ksort => $flag) {
                $sortBy[$ksort][$key] = $row[$ksort];
                $sortBy[$ksort.'_flag'] = (int)$flag;
            }
        }

        $param = array_merge($sortBy, array(&$array));
        call_user_func_array('array_multisort', $param);
    }
}