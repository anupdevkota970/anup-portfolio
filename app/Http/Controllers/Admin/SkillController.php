<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('sort_order')->orderBy('category')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.form', ['skill' => new Skill()]);
    }

    public function store(Request $request)
    {
        Skill::create($this->validated($request));
        return redirect()->route('admin.skills.index')->with('success', 'Skill created!');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.form', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $skill->update($this->validated($request));
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name'         => 'required|string|max:100',
            'category'     => 'required|in:technical,stack',
            'level'        => 'required|integer|min:0|max:100',
            'color'        => 'required|string|max:20',
            'icon'         => 'nullable|string|max:10',
            'bg_color'     => 'nullable|string|max:30',
            'border_color' => 'nullable|string|max:30',
            'sort_order'   => 'nullable|integer',
            'is_active'    => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
