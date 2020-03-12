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

    public function testShouldNotReturnTripsWhenNotFriend()
    {
        $this->tripService = new NotFriendTripsService();
        $notfriend = new User('');
        $trips = $this->tripService->getTripsByUser($notfriend);
        $this->assertEquals([], $trips, 'get no trips when not friend');
    }
}

class NoLoggedTripService extends TripService
{
    protected function getLoggedUser()
    {
        throw new UserNotLoggedInException();
    }
}

class NotFriendTripsService extends TripService
{
    protected function isFriend()
    {
        return false;
    }

    protected function getLoggedUser()
    {
        return new User('loggedUser');
    }
}