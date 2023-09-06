<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class HomeController extends Controller
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
        $this->services = new HomeService();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function root(Request $request)
    {
        $response = $this->services->requestData($request->session()->get('Token'));

        if($response->json('error')) {
            return redirect('login');
        }
        
        return view('index', ['response' => $response->json()]);
    }

    public function yajra(Request $request)
    {
        $dataTable = $this->services->yajraData($request->session()->get('Token'));

        return $dataTable;
    }

    public function approval(Request $request)
    {
        // Retrieve the rowId query parameter from the request object
        $rowId = $request->query('rowId');
        $status = $request->query('status');
        $reject = $request->query('reject_note');
        $karoseri = $request->query('karoseri');

        $response = $this->services->approvalData($request->session()->get('Token'), $rowId, $status, $reject);
        
        if($response['approval'] === 'Reject') {
            return redirect('')->with('success', 'Reject for ' . $karoseri  . ' successful');
        } else {
            return redirect('')->with('success', 'Approval for ' . $karoseri  . ' successful');
        }
    }
}
