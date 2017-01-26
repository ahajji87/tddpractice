<?php

namespace App\SearchEngine;

class UserRepository implements UserRepositoryInterface
{
    private $data;

    /**
     * @param string $location
     * @return array
     */
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

    /**
     * @param User $user
     * @return $this
     */
    public function save(User $user)
    {
        $this->data[] = $user;

        return $this;
    }
}