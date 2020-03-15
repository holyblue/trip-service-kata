<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;

class TripRepository implements ITripRepository
{
    public function findTripsByUser(User $user)
    {
        TripDAO::findTripsByUser($user);
    }
}
