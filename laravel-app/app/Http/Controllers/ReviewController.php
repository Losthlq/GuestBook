<?php

namespace App\Http\Controllers;

use App\Models\AdminMessages;
use App\Models\Messages;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $comments = Messages::paginate(10);

        foreach ($comments as $value) {
            foreach ($value->comments as $descComment) {

            }
        }

        return response()->json([
            'status' => true,
            'result' => $comments
        ], 201);
    }

    public function store(Request $request)
    {
        $responseCode = 401;
        $status = false;
        $result = null;

        $request->validate(
            [
                'message' => 'required|min:2|max:150',
            ]
        );

        $review = new Messages();
        $review->message = $request->input('message');
        $review->author_id = Auth::user()->id;

        if ($review->save()) {
            $status = true;
            $result = $review;
            $responseCode = 201;
        }

        return response()->json([
            'status' => $status,
            'result' => $result
        ], $responseCode);

    }

    public function update(Request $request, $id)
    {
        $responseCode = 401;
        $status = false;
        $result = null;

        if (Auth::user()->role == 1) {

            $request->validate(
                [
                    'message' => 'required|min:2|max:150',
                ]
            );

            try {
                Messages::findOrFail($id);

                $review = new AdminMessages();
                $review->admin_message = $request->input('message');
                $review->message_id = $id;

                if ($review->save()) {
                    $status = true;
                    $result = $review;
                    $responseCode = 201;
                }
            } catch (ModelNotFoundException $exception) {
                $result = "Record not found";
            }

        } else {
            $result = "Acces denied";
        }

        return response()->json([
            'status' => $status,
            'result' => $result
        ], $responseCode);
    }
}
