<?php

namespace App\Observers;

use App\User;
use Illuminate\Support\Facades\Schema;

class UserObserver
{
    public function __construct()
    {

    }

    /**
     * Listen to the User created event.
     *
     * @param  User $user
     * @return void
     */
    public function created(User $user)
    {
        if (Schema::hasColumn('users', 'token')) {
            $user->token = $this->getUniqueTokenUsers($user->id);
            $user->save();
        }
    }

    /*
     *@param $userId
     * @return encrypted token
     */
    private function getUniqueTokenUsers($user_id)
    {
        // any hash code can have a collision, so we need to check if it is unique
        do {
            $code = hash('crc32b', $user_id) . hash('crc32b', microtime());
        } while (User::where('token', $code)->first() instanceof User);

        return $code;
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User $user
     * @return void
     */
    public function deleting(User $user)
    {
    }
}