<?php
namespace Test\TripServiceKata\Trip;

use TripServiceKata\User\IUserSession;
use TripServiceKata\User\User;

class FakeUserSession implements IUserSession
{
    public function getLoggedUser()
    {
        return new User('loggedUser');
    }
}