<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormSubmission;

class FormController
{
    public function submit(Request $request)
    {
        $email = $request->input('email');
        $comments = $request->input('comments');
        $topic = $request->input('topic');
        $priority = $request->input('priority');

        $submission = new FormSubmission();
        $submission->email = $email;
        $submission->comments = $comments;
        $submission->topic = $topic;
        $submission->priority = $priority;
        $submission->save();

        return redirect('/mainform')->with('success', 'Form submitted successfully!');
    }
    
}

