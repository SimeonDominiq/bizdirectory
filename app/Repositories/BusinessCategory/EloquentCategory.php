<?php

namespace App\Repositories\BusinessCategory;

use App\Models\BusinessCategory;
use Carbon\Carbon;
use DB;


class EloquentCategory implements CategoryRepository
{
    private $business_category;

    public function __construct(BusinessCategory $business_category)
    {
        $this->business_category = $business_category;
    }

    public function paginate($perPage, $search = null)
    {
        $query = $this->business_category->query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
            });
        }

        $result = $query->orderBy('created_at', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }    

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return $this->business_category->find($id);
    }

    public function findOrFail($id)
    {
        return $this->business_category->findOrFail($id);
    }    

    public function findByEmail($id) {}

    public function create(array $data) {
        foreach($data as $key => $datum) {
            if($datum == "") {
                $data[$key] = null;
            }
        }
        
        return $this->business_category->create($data);
    }

    public function update($id, array $data) {
        foreach($data as $key => $datum) {
            if($datum == "") {
                $data[$key] = null;
            }
        }

        return $this->business_category->find($id)->update($data);        
    }

    public function delete($id) {
        $category = $this->business_category->find($id);
        
        return $category->delete();
    }

}