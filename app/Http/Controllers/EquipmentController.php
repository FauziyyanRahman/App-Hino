<?php

namespace App\Http\Controllers;

use App\Services\EquipmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EquipmentController extends Controller
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
        $this->services = new EquipmentService();
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
        $equpmentData = [
            'ms_equipment' => $request->input('eq-equipment'),
            'ms_welding_machine' => (int)$request->input('eq-welding'),
            'ms_cutting_machine' => (int)$request->input('eq-cutting'),
            'ms_bending_machine' => (int)$request->input('eq-bending'),
            'ms_plasma_cutting' => (int)$request->input('eq-plasma'),
            'ms_company_id' => (int)$request->input('company_id')
        ];

        $data = $this->services->create($request->session()->get('Token'), $equpmentData);

        return $data;
    }
}
