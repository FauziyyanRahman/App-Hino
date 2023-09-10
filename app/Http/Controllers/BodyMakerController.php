<?php

namespace App\Http\Controllers;

use App\Services\BodyMakerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BodyMakerController extends Controller
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
        $this->services = new BodyMakerService();
    }

    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function show(Request $request)
    {
        $data = $this->services->show($request->session()->get('Token'));

        return $data;
    }

    public function create(Request $request)
    {
        $picData = [
            'ms_name' => $request->input('pic-username'),
            'ms_email' => $request->input('pic-email'),
            'ms_phone' => (int)$request->input('pic-phone'),
            'ms_position' => $request->input('pic-position'),
            'ms_company_id' => (int)$request->input('pic-company'),
        ];
        
        $data = $this->services->create($request->session()->get('Token'), $picData);

        return $data;
    }
}
