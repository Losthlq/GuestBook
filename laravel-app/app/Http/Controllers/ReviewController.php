<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {
            $request->validate(
                [
                    'message' => 'required|min:2|max:150',
                ]
            );

            $review = new Messages();
            $review->message = $request->input('message');
            $review->author_id = Auth::user()->id;

            if ($review->save()) {
                return response()->json([
                    'status' => true,
                    'result' => $review
                ], 201);
            }
        } else {
            return response()->json([
                'status' => false,
                'result' => null
            ], 401);
        }
    }
}
