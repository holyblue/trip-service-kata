<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;
use TripServiceKata\Exception\DependentClassCalledDuringUnitTestException;

class TripRepository
{
    public function findTripsByUser(User $user)
    {
        TripDAO::findTripsByUser($user);
    }
}
