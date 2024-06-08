<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessSubmission;
use Illuminate\Support\Facades\Validator;

class SubmissionController extends Controller
{
    public function submit( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|max:255',
            'message' => 'required|string',
        ]);

        if ( $validator->fails() ) {
            return response()->json([ 'errors' => $validator->errors() ], 422);
        }

        ProcessSubmission::dispatch($request->all());

        return response()->json([ 'message' => 'Submission received and is being processed.' ], 200);
    }
}
