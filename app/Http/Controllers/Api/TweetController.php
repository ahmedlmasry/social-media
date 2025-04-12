<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTweetRequest;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function store(StoreTweetRequest $request)
    {
        $tweet = $request->user()->tweets()->create($request->validated());

        return response()->json([
            'message' => __('tweet.created'),
            'tweet' => $tweet,
        ], 201);
    }

    public function timeline()
    {
        $tweets = Tweet::with('user:id,username,image')
            ->whereIn('user_id', auth()->user()->following()->pluck('users.id'))
            ->latest()
            ->paginate(15);
        if ($tweets->isEmpty()) {
            return response()->json(['message' => 'no tweets'], 404);
        }
        return response()->json([
            'tweets' => $tweets,
        ]);
    }


}
