<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormSubmission;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController
{
    public function numberAdmins(Request $request){
        // Your code here
    }

    public function showPanel()
    {
        $submissions = FormSubmission::simplePaginate(10);
        return view('panel', ['submissions' => $submissions]);
    }

    public function search(Request $request)
    {
        $email = $request->input('email');
        $topic = $request->input('topic');
        $priority = $request->input('priority');
        $sort = $request->input('sort', 'asc'); // Default to ascending

        $query = FormSubmission::query();

        if ($email) {
            $query->where('email', 'like', '%' . $email . '%');
        }

        if ($topic) {
            $query->where('topic', $topic);
        }

        if ($priority) {
            $query->where('priority', $priority);
        }

        // Paginate the search results
        $submissions = $query->orderBy('created_at', $sort)->paginate(10);

        return view('panel', ['submissions' => $submissions]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:3',
        ]);

        $admin = new Admin();
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect('/admin')->with('success', 'Admin registered successfully.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $admin = Admin::where('email', $credentials['email'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Auth::login($admin);
            return redirect()->intended('panel');
        }

        return redirect()->back()->with('error', 'Incorrect password');
    }

    public function export()
    {
        $fileName = 'form_submissions.csv';
        $submissions = FormSubmission::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['Email', 'Comment', 'Topic', 'Priority', 'Date'];

        $callback = function() use($submissions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($submissions as $submission) {
                $row = [
                    $submission->email,
                    $submission->comments,
                    $submission->topic,
                    $submission->priority,
                    $submission->created_at,
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function updateStatus(Request $request)
    {
        $submission = FormSubmission::find($request->id);
        $submission->status = $request->status;
        $submission->save();

        return response()->json(['success' => 'Status updated successfully.']);
    }
}
