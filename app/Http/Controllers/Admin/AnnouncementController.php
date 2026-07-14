<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{

    public function index()
    {

        $announcements = Announcement::latest()
                        ->take(10)
                        ->get();

        return view(
            'admin.announcements',
            compact('announcements')
        );
    }

    public function store(Request $request)
    {

        $request->validate([

            'title'=>'required|max:255',
            'message'=>'required',
            'attachment'=>'nullable|file|max:5120'

        ]);

        $file = null;

        if($request->hasFile('attachment'))
        {
            $file = $request->file('attachment')
                    ->store('announcements','public');
        }

        Announcement::create([

            'admin_id'=>Auth::id(),

            'title'=>$request->title,

            'message'=>$request->message,

            'attachment'=>$file

        ]);

        return back()->with('success','Announcement posted successfully.');

    }

}