<?php

namespace App\Http\Controllers;

use App\Services\IdentityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IdentityController extends Controller
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
        $this->services = new IdentityService();
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
        $identityData = [
            'ms_company_name' => $request->input('id-company-name'),
            'ms_company_status' => $request->input('id-company-status'),
            'ms_address' => $request->input('id-company-address'),
            'ms_phone_number' => $request->input('id-company-phone'),
            'ms_fax' => $request->input('id-company-fax'),
            'ms_email' => $request->input('id-company-email'),
            'ms_website' => $request->input('id-company-url'),
            'ms_established' => $request->input('id-company-est'),
            'ms_owner' => $request->input('id-company-owner'),
            'ms_warranty_to_customer' => $request->input('id-company-warranty'),
            'ms_business_activity' => $request->input('id-company-business'),
            'ms_number_employee' => (int)$request->input('id-company-employees'),
            'ms_building_area_land' => (int)$request->input('id-company-building'),
            'ms_quality_system' => $request->input('id-company-quality'),
            'ms_technical_assistance' => $request->input('id-company-tech'),
            'ms_number_of_branch' => (int)$request->input('id-company-branch'),
            'ms_company_license' => $request->input('id-company-license'),
        ];        

        // Log::info($identityData);
        
        $data = $this->services->create($request->session()->get('Token'), $identityData);

        return $data;
    }
}
