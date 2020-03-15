<?php


namespace Test\TripServiceKata\Trip;


use TripServiceKata\Trip\ITripRepository;
use TripServiceKata\Trip\Trip;
use TripServiceKata\User\User;

class FakeTripRepository implements ITripRepository
{

    public function findTripsByUser(User $user)
    {
        if ($user !== null) {
            $trips[] = new Trip();
            return $trips;
        } else {
            return null;
        }
    }
}