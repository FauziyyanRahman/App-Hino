<?php

namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
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
        $this->services = new UsersService();
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

    public function yajra(Request $request)
    {
        $dataTable = $this->services->yajraData($request->session()->get('Token'));

        return $dataTable;
    }
    
    public function create(Request $request)
    {
        $request->merge([
            'active' =>  1,
            'create_date' =>  date('Y-m-d H:i:s'),
            'create_id' => $request->session()->get('Id'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $request->session()->get('Id')
        ]);

        $data = $this->services->create($request->session()->get('Token'), $request->all());

        return $data;
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'update_date' => date('Y-m-d H:i:s'),
            'update_id' => $request->session()->get('Id'),
            'update_at' => date('Y-m-d H:i:s'),
            'update_by' => $request->session()->get('Id'),
        ]);
        
        $data[] = $this->services->update($request->session()->get('Token'), $id, $request->all());

        return $data;
    }

    public function delete(Request $request, $id)
    {
        $data = $this->services->delete($request->session()->get('Token'), ['id' => $id, 'deletedBy' => $request->session()->get('Id')]);

        return $data;
    }
}
