<?php


namespace TripServiceKata\Trip;


use TripServiceKata\User\User;

interface ITripRepository
{
    public function findTripsByUser(User $user);
}