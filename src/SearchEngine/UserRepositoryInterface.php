<?php
namespace App\SearchEngine;

interface UserRepositoryInterface
{
    /**
     * @param string $location
     * @return User[]
     */
    public function findByLocation($location);

    /**
     * @param User $user
     * @return self
     */
    public function save(User $user);
}