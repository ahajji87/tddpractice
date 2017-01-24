<?php

namespace App\SearchEngine;


use App\Parser\Parser;

class SearchEngine
{
    /** @var  UserRepository */
    private $userRepository;
    /** @var  Parser */
    private $parser;
    /**
     * SearchEngine constructor.
     */
    public function __construct(UserRepositoryInterface $repository, Parser $parser)
    {
        $this->userRepository = $repository;
        $this->parser = $parser;
    }

    public function filter($query, $location)
    {
        if (empty($location)) {
            return [];
        }

        $users = $this->userRepository->findByLocation($location);

        if (empty($query)) {
            return $users;
        }

        return $this->filterByParsedQuery($query, $users);
    }

    /**
     * @param $query
     * @param $users
     *
     * @return array
     */
    private function filterByParsedQuery($query, $users)
    {
        $results = [];
        $parsedQuery = $this->parser->parse($query);

        foreach ($users as $user) {
            if (in_array(strtoupper($user->getProfile()), $parsedQuery)) {
                $results[] = $user;
            }
        }

        return $results;
    }
}