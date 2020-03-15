<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;
use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\User\IUserSession;

class TripService
{
    private $userSession;

    public function __construct(IUserSession $session)
    {
        $this->userSession = $session;
    }

    public function getTripsByUser(User $user) {
        $tripList = array();
        $loggedUser = $this->userSession->getLoggedUser();
        $isFriend = $this->isFriend($user, $loggedUser);

        if ($isFriend) {
            $tripList = $this->getTrips($user);
        }
        return $tripList;
    }

    protected function isFriend(User $user, User $loggedUser)
    {
        return in_array($loggedUser, $user->getFriends());
    }

    protected function getTrips(User $user)
    {
        return TripDAO::findTripsByUser($user);
    }
}
