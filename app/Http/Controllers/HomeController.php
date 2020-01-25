<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Business;


class HomeController extends Controller
{

    private $business;

    public function __construct(Business $business)
    {
        $this->business = $business;
    }

    public function index() {

        $search = Request::input('search');
        $query = $this->business->query();

        $query->where('status', 1);

        if($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
                $q->orWhere('description', 'like', "%{$search}%");
            });            
        }

        $businesses = $query->withCount('views')->orderBy('created_at', 'desc')
                        ->paginate(12);

        if ($search) {
            $businesses->appends(['search' => $search]);
        }
        
        if(Request::isJson()) {
            $data = [
                'status'        =>  true,
                'data'          =>  $businesses
            ];

            return response()->json($data);
        }

        return view('index', compact('businesses'));
    }

}
