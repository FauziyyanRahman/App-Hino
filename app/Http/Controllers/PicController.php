<?php

namespace App\Http\Controllers;

use App\Services\PicService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PicController extends Controller
{
    protected $services;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('token');
        $this->services = new PicService();
    }

    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function create(Request $request)
    {
        $data = json_decode($request->input('data'), true);
        $picData = [];

        foreach ($data as $key => $value) {
            $picData[$key]['ms_job_area'] = $value['role'];
            $picData[$key]['ms_name'] = $value['name'];
            $picData[$key]['ms_email'] = $value['email'];
            $picData[$key]['ms_phone_number'] = (int)$value['phone'];
            $picData[$key]['ms_company_id'] = (int)$value['company_id'];
        }

        $data = $this->services->create($request->session()->get('Token'), $picData);
        
        return $data;
    }
}