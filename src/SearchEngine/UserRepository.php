<?php

namespace App\SearchEngine;


use App\SearchEngine\User;

class UserRepository implements UserRepositoryInterface
{
    private $data;

    public function findByLocation($location)
    {
        $result = [];

        foreach ($this->data as $row) {
            if ($row->getLocation() === $location) {
                $result[] = $row;
            }
        }

        return $result;
    }

    public function save(User $user)
    {
        $this->data[] = $user;

        return $this;
    }
}