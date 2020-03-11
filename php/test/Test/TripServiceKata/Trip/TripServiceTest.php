<?php
namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\Trip\TripService;
use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;

class TripServiceTest extends TestCase
{
    /**
     * @var TripService
     */
    private $tripService;

    protected function setUp()
    {
        $this->tripService = new TripService();
    }

    public function testGetTripsByNoLoggedUser()
    {
        $this->tripService = new NoLoggedTripService();
        $friend = new User('');
        $this->expectException(UserNotLoggedInException::class);
        $this->tripService->getTripsByUser($friend);
    }
}

class NoLoggedTripService extends TripService
{
    protected function getLoggedUser()
    {
        throw new UserNotLoggedInException();
    }
}