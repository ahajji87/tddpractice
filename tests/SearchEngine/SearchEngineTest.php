<?php

namespace App\Tests\SearchEngine;

use App\Parser\Parser;
use App\SearchEngine\SearchEngine;
use App\SearchEngine\User;
use App\SearchEngine\UserRepository;
use App\SearchEngine\UserRepositoryInMemory;
use PHPUnit\Framework\TestCase;

class SearchEngineTest extends TestCase
{
    private $userRepository;
    private $searchEngine;
    private $parser;

    public function setUp()
    {
        parent::setUp();

        $this->userRepository = new UserRepositoryInMemory();
        $this->parser = $this->getMockBuilder(Parser::class)->disableOriginalConstructor()->getMock();
        $this->searchEngine = new SearchEngine($this->userRepository, $this->parser);
    }

    /**
     * @test
     */
    public function it_dont_filter_without_location()
    {
        $this->assertEquals([], $this->searchEngine->filter('cocinero', ''));
    }

    /**
     * @test
     */
    public function it_filter_by_only_location()
    {
        $user = new User();
        $user->setName('Pepe')
            ->setProfile('Cocinero')
            ->setLocation('Barcelona');

        $this->assertEquals(
            $this->userRepository->findByLocation('Barcelona'),
            $this->searchEngine->filter('', 'Barcelona')
        );
    }

    /**
     * @test
     */
    public function is_filter_by_query_and_location()
    {
        $this->parser->expects($this->once())->method('parse')->willReturn(['COCINERO']);

        $user = new User();
        $user->setName('Pepe')
            ->setProfile('Cocinero')
            ->setLocation('Barcelona');

        $this->assertEquals(
            [$user],
            $this->searchEngine->filter('Cocinero', 'Barcelona')
        );
    }

    /**
     * @test
     */
    public function is_filter_by_multi_words_in_query_and_location()
    {
        $this->parser->expects($this->once())->method('parse')->willReturn(['COCINERO', 'DEVELOPER']);

        $user = new User();
        $user->setName('Pepe')
            ->setProfile('Cocinero')
            ->setLocation('Barcelona');
        $user1 = new User();
        $user1->setName('Laia')
            ->setProfile('Developer')
            ->setLocation('Barcelona');

        $this->assertEquals(
            [$user, $user1],
            $this->searchEngine->filter('Cocinero fontanero', 'Barcelona')
        );
    }
}