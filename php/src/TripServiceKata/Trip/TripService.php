<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;
use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\User\IUserSession;

class TripService
{
    private $userSession;
    private $tripRepository;

    public function __construct(IUserSession $session, ITripRepository $repository)
    {
        $this->userSession = $session;
        $this->tripRepository = $repository;
    }

    public function getTripsByUser(User $user) {
        $tripList = array();
        $loggedUser = $this->userSession->getLoggedUser();
        if ($this->isFriend($user, $loggedUser)) {
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
        return $this->tripRepository->findTripsByUser($user);
    }
}
