<?php

namespace App\Http\Controllers;

use Request;
use App\Repositories\BusinessCategory\CategoryRepository;
use App\Http\Requests\CategoryStoreRequest;


class BusinessCategoryController extends Controller
{
    private $business_category;

    public function __construct(CategoryRepository $business_category)
    {
        $this->business_category = $business_category;
    }    

    public function index() {
        $perPage = 20;

        $categories = $this->business_category->paginate($perPage, Request::input('search'));

        return view('category.index', compact('categories'));
    }

    public function addCategory(CategoryStoreRequest $request) {
        $data = $request->all();

        $insert = $this->business_category->create($data);

        if($insert) {
            return redirect()->route('business.category')
                ->withSuccess('Category added successfully!');               
        }

        return redirect()->route('business.category')
            ->withErrors('Error completing your operation. Please try again!');           
    }

    public function deleteCategory($id) {
        $this->business_category->findOrFail($id);

        if($this->business_category->delete($id)) {
            return redirect()->route('business.category')
                ->withSuccess('Category deleted successfully!');               
        }

        return redirect()->route('business.category')
            ->withErrors('Error completing your operation. Please try again!');         
    }
}
