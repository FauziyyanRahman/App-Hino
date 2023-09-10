<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{protected $services;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('token');
        $this->services = new NewsService();
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

    public function get(Request $request, $id)
    {
        $data = $this->services->get($request->session()->get('Token'), $id);

        return $data;
    }
    
    public function create(Request $request)
    {
        $data = $this->services->create($request->session()->get('Token'), $request->all());

        return $data;
    }

    public function updateNews(Request $request)
    {  
        $data = $this->services->update($request->session()->get('Token'), $request->all());

        return $data;
    }

    public function delete(Request $request, $id)
    {
        $data = $this->services->delete($request->session()->get('Token'), ['id' => $id, 'deletedBy' => $request->session()->get('Id')]);

        return $data;
    }
}
