<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Photo;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $profile      = Profile::current();
        $projects     = Project::active()->get();
        $skills = Skill::all();
        $techStack = [];
        $technical    = Skill::active()->technical()->get();
        $stackSkills  = Skill::active()->stack()->get();
        $testimonials = Testimonial::active()->get();
        $profilePhoto = Photo::active()->profile()->first();

        return view('welcome', compact(
            'profile', 'projects','skills','techStack', 'technical', 'stackSkills', 'testimonials', 'profilePhoto'
        ));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|min:10',
        ]);

        ContactMessage::create($request->only('name', 'email', 'subject', 'message'));

        return back()->with('contact_success', 'Your message was sent! I\'ll get back to you soon.');
    }
}
