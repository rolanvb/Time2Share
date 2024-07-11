<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Review;

class ReviewController extends Controller
{
    public function create($reviewedUserId)
    {
        $reviewedUser = User::findOrFail($reviewedUserId);
        return view('reviews.create', compact('reviewedUser'));
    }

    public function store(Request $request, $reviewedUserId)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string',
        ]);

        $review = new Review([
            'reviewer_id' => Auth::id(),
            'reviewed_user_id' => $reviewedUserId,
            'rating' => $validatedData['rating'],
            'review_text' => $validatedData['review_text'],
        ]);

        $review->save();

        return redirect()->route('reviews.show', ['user' => $reviewedUserId])
                         ->with('success', 'Review submitted successfully!');
    }

    public function show($userId)
    {
        $user = User::with('reviewsReceived.reviewer')->findOrFail($userId);
        $reviews = $user->reviewsReceived;

        return view('reviews.show', compact('user', 'reviews'));
    }
}
