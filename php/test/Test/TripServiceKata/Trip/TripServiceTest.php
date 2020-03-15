<?php
namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\Trip\Trip;
use TripServiceKata\Trip\TripService;
use TripServiceKata\User\User;

class TripServiceTest extends TestCase
{
    /**
     * @var TripService
     */
    private $tripService;

    protected function setUp()
    {
        $this->tripService = new TripService(new NotLoggedUserSession());
    }

    public function testGetTripsByNoLoggedUser()
    {
        $friend = new User('');
        $this->expectException(UserNotLoggedInException::class);
        $this->tripService->getTripsByUser($friend);
    }

    public function testShouldNotReturnTripsWhenNotFriend()
    {
        $this->tripService = new NotFriendTripsService(new LoggedUserSession());
        $notFriend = new User('');
        $trips = $this->tripService->getTripsByUser($notFriend);
        $this->assertEquals([], $trips, 'get no trips when not friend');
    }

    public function testShouldReturnTripsWhenLoggedUserIsFriend()
    {
        $this->tripService = new FriendTripsService(new LoggedUserSession());
        $friend = new User('friend');
        $trips = $this->tripService->getTripsByUser($friend);
        $this->assertNotEmpty($trips);
    }
}

class NotFriendTripsService extends TripService
{
    protected function isFriend()
    {
        return false;
    }
}

class FriendTripsService extends TripService
{
    protected function isFriend()
    {
        return true;
    }

    protected function getTrips(User $user)
    {
        $trips[] = new Trip();
        return $trips;
    }
}