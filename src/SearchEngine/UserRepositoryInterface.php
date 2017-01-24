<?php
/**
 * Created by PhpStorm.
 * User: ahajji
 * Date: 1/24/17
 * Time: 4:53 PM
 */
namespace App\SearchEngine;

interface UserRepositoryInterface
{
    public function findByLocation($location);

    public function save(User $user);
}