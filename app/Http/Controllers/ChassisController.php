<?php

namespace App\Http\Controllers;

use App\Services\ChassisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChassisController extends Controller
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
        $this->services = new ChassisService();
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
        $chassisData = [];

        foreach ($data as $key => $value) {
            $chassisData[$key]['ms_type'] = $value['ch-types'];
            $chassisData[$key]['ms_unit'] = (int)$value['ch-unit'];
            $chassisData[$key]['ms_company_id'] = (int)$value['company_id'];
        }

        $data = $this->services->create($request->session()->get('Token'), $chassisData);

        return $data;
    }
}
