<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;
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
        $loggedUser = $this->getLoggedUser();
        $isFriend = $this->isFriend();

        if ($loggedUser != null) {
            foreach ($user->getFriends() as $friend) {
                if ($friend === $loggedUser) {
                    $isFriend = true;
                    break;
                }
            }
            if ($isFriend) {
                $tripList = $this->getTrips($user);
            }
            return $tripList;
        } else {
            throw new UserNotLoggedInException();
        }
    }

    protected function isFriend()
    {
        return false;
    }

    protected function getTrips(User $user)
    {
        return TripDAO::findTripsByUser($user);
    }

    protected function getLoggedUser()
    {
        return $this->userSession->getLoggedUser();
    }
}
