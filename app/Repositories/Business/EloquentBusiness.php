<?php

namespace App\Repositories\Business;

use App\Models\Business;
use Carbon\Carbon;
use DB;


class EloquentBusiness implements BusinessRepository
{

    public function __construct(Business $business)
    {
        $this->business = $business;
    }

    public function paginate($perPage, $search = null, $status = null)
    {
        $query = $this->business->query();

        if ($status !== null) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
                $q->orWhere('description', 'like', "%{$search}%");
            });
        }

        $result = $query->withCount('views')->orderBy('created_at', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }
    
    public function all()
    {
        return $this->business->all();
    }    

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return $this->business->find($id);
    }

    public function findOrFail($id)
    {
        return $this->business->findOrFail($id);
    }    

    public function findByEmail($id) {}

    public function create(array $data) {
        foreach($data as $key => $datum) {
            if($datum == "") {
                $data[$key] = null;
            }
        }
        
        return $this->business->create($data);
    }

    public function update($id, array $data) {
        foreach($data as $key => $datum) {
            if($datum === "") {
                $data[$key] = null;
            }
        }
        
        return $this->business->find($id)->update($data);        
    }

    public function delete($id) {
        return $this->business->find($id)->delete();
    }

}