<?php

namespace App\Http\Controllers;

use App\Services\VariantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VariantController extends Controller
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
        $this->services = new VariantService();
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
        // $productionData = [
        //     'ms_unit' => (int)$request->input('pr-unit'),
        //     'ms_all_type' => $request->input('pr-all-type'),
        //     'ms_company_id' => (int)$request->input('company_id')
        // ];

        // $data = $this->services->create($request->session()->get('Token'), $productionData);

        // return $data;
    }
}