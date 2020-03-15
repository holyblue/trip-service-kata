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
        $this->tripService = new TripService(new NotLoggedUserSession(), new FakeTripRepository());
    }

    public function testGetTripsByNoLoggedUser()
    {
        $friend = new User('');
        $this->expectException(UserNotLoggedInException::class);
        $this->tripService->getTripsByUser($friend);
    }

    public function testShouldNotReturnTripsWhenNotFriend()
    {
        $this->tripService = new TripService(new LoggedUserSession(), new FakeTripRepository());
        $notFriend = new User('');
        $trips = $this->tripService->getTripsByUser($notFriend);
        $this->assertEquals([], $trips, 'get no trips when not friend');
    }

    public function testShouldReturnTripsWhenLoggedUserIsFriend()
    {
        $userSession = new LoggedUserSession();
        $this->tripService = new TripService($userSession, new FakeTripRepository());
        $user = new User('friend');
        $user->addFriend($userSession->getLoggedUser());
        $trips = $this->tripService->getTripsByUser($user);
        $this->assertNotEmpty($trips);
    }
}