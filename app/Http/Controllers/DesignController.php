<?php

namespace App\Http\Controllers;

use App\Services\DesignService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DesignController extends Controller
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
        $this->services = new DesignService();
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
        $designData = [
            'ms_quantity_of_computer_design' => (int)$request->input('des-computer'),
            'ms_twod_program_design' => $request->input('des-twod-prog'),
            'ms_threed_program_design' => $request->input('des-threed-prog'),
            'ms_company_id' => (int)$request->input('company_id'),
        ];

        //Log::info($designData);
        
        $data = $this->services->create($request->session()->get('Token'), $designData);

        return $data;
    }
}
