<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Input;
use App\Repositories\Business\BusinessRepository;
use App\Enum\BusinessStatus;
use App\Http\Requests\BusinessStoreRequest;

use App\Models\BusinessCategory;
use App\Models\ListingView;


class BusinessController extends Controller
{
    private $business;

    private $business_categories;

    public function __construct(BusinessRepository $business, BusinessCategory $business_categories)
    {
        $this->business = $business;
        $this->business_categories = $business_categories;
    }    

    public function index() {

        $perPage = 20;

        $businesses = $this->business->paginate($perPage, Request::input('search'), Request::input('status'));
        $statuses = ['' => 'All'] + BusinessStatus::lists();

        return view('business.index', compact('businesses', 'statuses'));

    }

    public function view($id) {

        $business = $this->business->findOrFail($id);

        $business->categories = $this->getCategories($business->category_ids);
        
        $this->insertView($id);

        return view('view', compact('business'));
    }

    private function getCategories($ids) {
        $categories = BusinessCategory::select('name')->whereIn('id', explode(",", $ids))
                        ->get();
        
        return count($categories) > 0 ? $categories->toArray() : [];
    }

    private function insertView($id) {
        $data = [
            'business_id'       =>  $id,
            'ip_address'        =>  Request::ip(),
            'user_agent'        =>  Request::server('HTTP_USER_AGENT')
        ];
        
        ListingView::create($data);
    }

    public function newBusiness() {
        $business_categories = $this->business_categories->all();

        return view('business.add', compact('business_categories'));
    }

    public function addBusiness(BusinessStoreRequest $request) {
        $data = $request->all();

        $data['category_ids']   =   implode(",", $data['categories']);

        $insert = $this->business->create($data);

        if($insert) {
            return redirect()->route('business.list')
                ->withSuccess('Business added successfully!');               
        }

        return redirect()->route('business.list')
            ->withErrors('Error completing your operation. Please try again!');           
    }

    public function deactivate($id) {
        $this->business->findOrFail($id);

        $data = ['status' => 0];

        if($this->business->update($id, $data)) {
            return redirect()->route('business.list')
                ->withSuccess('Business deactivated successfully!');  
        }

        return redirect()->route('business.list')
                ->withErrors('Error completing your operation. Please try again!'); 
    }

    public function activate($id) {
        $this->business->findOrFail($id);

        $data = ['status' => 1];

        if($this->business->update($id, $data)) {
            return redirect()->route('business.list')
                ->withSuccess('Business activated successfully!');  
        }

        return redirect()->route('business.list')
                ->withErrors('Error completing your operation. Please try again!'); 
    }

    public function editBusiness($id) {
        $business =         $this->business->findOrFail($id);
        $business_categories = $this->business_categories->all();

        return view('business.edit', compact('business', 'business_categories'));
    }

    public function updateBusiness(Request $request, $id) {
        $business =         $this->business->findOrFail($id);

        $data = $request::all();

        $data['category_ids']   =   implode(",", $data['categories']);

        $update = $this->business->update($id, $data);

        if($update) {
            return redirect()->route('business.list')
                    ->withSuccess('Business updated successfully!');               
        }

        return redirect()->route('business.list')
            ->withErrors('Error completing your operation. Please try again!');        
    }

    public function deleteBusiness($id) {
        $business =         $this->business->findOrFail($id);

        if($this->business->delete($id)) {
            return redirect()->route('business.list')
                    ->withSuccess('Business deleted successfully!');            
        }

        return redirect()->route('business.list')
            ->withErrors('Error completing your operation. Please try again!');         
    }

}
