<?php

namespace App\SearchEngine;

class UserRepositoryInMemory implements UserRepositoryInterface
{
    private $data;

    public function __construct()
    {
        foreach ($this->getDummyData() as $user) {
            $this->save($user);
        }
    }

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

    public function getDummyData()
    {
        $user1 = new User();
        $user1->setName('Pepe')
            ->setProfile('Cocinero')
            ->setLocation('Barcelona');

        $user2 = new User();
        $user2->setName('Juan')
            ->setProfile('Cocinero')
            ->setLocation('Madrid');

        $user3 = new User();
        $user3->setName('Manu')
            ->setProfile('Profesor')
            ->setLocation('Barcelona');

        $user4 = new User();
        $user4->setName('Laia')
            ->setProfile('Developer')
            ->setLocation('Barcelona');

        return [$user1, $user2, $user3, $user4];
    }
}