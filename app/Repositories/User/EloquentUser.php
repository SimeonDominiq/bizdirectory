<?php

namespace App\Repositories\User;

use App\User;
use Carbon\Carbon;
use DB;


class EloquentUser implements UserRepository
{

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return $this->user->find($id);
    }

    public function findByEmail($id) {}

    public function create($data) {}

    public function update($id, array $data) {}

    public function delete($id) {}

}