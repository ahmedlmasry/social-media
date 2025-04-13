<?php

namespace App\Http\Controllers\Api;

use App\Events\UserFollowed;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserFollowedNotification;


class UserController extends Controller
{
    public function follow(User $user)
    {
        $follower = auth()->user();
        if ( $follower->id === $user->id) {
            return response()->json([
                'message' => __('user.cannot_follow_self',['username' => $user->username]),
            ], 422);
        }

        if ( $follower->isFollowing($user)) {
            return response()->json([
                'message' => __('user.already_following',['username' => $user->username]),
            ], 422);
        }
         $follower->following()->attach($user->id);

//        $follower->notify(new UserFollowedNotification($user));
         UserFollowed::dispatch($follower,$user);

        return response()->json([
            'message' => __('user.success', ['username' => $user->username]),
        ]);
    }

    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user->id);
        return response()->json([
            'message' => __('user.unfollowed', ['username' => $user->username]),
        ]);
    }



}
