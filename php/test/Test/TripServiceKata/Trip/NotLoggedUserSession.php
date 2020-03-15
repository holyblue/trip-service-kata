<?php
namespace Test\TripServiceKata\Trip;

use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\User\IUserSession;
use TripServiceKata\User\User;

class NotLoggedUserSession implements IUserSession
{
    public function getLoggedUser()
    {
        throw new UserNotLoggedInException();
    }
}