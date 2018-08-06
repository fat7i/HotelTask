<?php

namespace Hotels\Http\Controllers;

use App\Http\Controllers\Controller;
use Hotels\Services\HelperTrait;
use Illuminate\Http\Request;
use Validator;
use Hotels\Hotel;


class HotelController extends Controller
{
    public function index()
    {
        view()->addNamespace('hotel_task_views', base_path('Hotels/views'));
        return view('hotel_task_views::hotel', ['sourceFiles' => HelperTrait::getDataFiles()]);
    }


    public function convert (Request $request)
    {

        $validator = Validator::make($request->all(), [
            'read_from' => 'required',
            'write_to' => 'required',
        ]);

        if ($validator->fails()) {
            throw new \Exception('Missing inputs of source file or desire file type');
        }

        $filename =  Hotel::export ($request);
        return response()->download($filename);
    }
}