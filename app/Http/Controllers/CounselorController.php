<?php

namespace App\Http\Controllers;

use App\Models\Counselor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CounselorController extends Controller
{
    public function index()
    {
        $counselors = Counselor::latest()->paginate(10);

        return view('counselors.index', compact('counselors'));
    }

    public function create()
    {
        return view('counselors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_number' => 'required|string|max:50|unique:counselors,employee_number',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:counselors,email',
            'phone' => 'nullable|string|max:30',
            'specialization' => 'required|string|max:150',
            'is_active' => 'required|boolean',
        ]);

        Counselor::create($validated);

        return redirect()->route('counselors.index')
            ->with('success', 'Counselor added successfully.');
    }

    public function show(Counselor $counselor)
    {
        $counselor->load('appointments.student');

        return view('counselors.show', compact('counselor'));
    }

    public function edit(Counselor $counselor)
    {
        return view('counselors.edit', compact('counselor'));
    }

    public function update(Request $request, Counselor $counselor)
    {
        $validated = $request->validate([
            'employee_number' => [
                'required', 'string', 'max:50',
                Rule::unique('counselors', 'employee_number')->ignore($counselor->id),
            ],
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('counselors', 'email')->ignore($counselor->id),
            ],
            'phone' => 'nullable|string|max:30',
            'specialization' => 'required|string|max:150',
            'is_active' => 'required|boolean',
        ]);

        $counselor->update($validated);

        return redirect()->route('counselors.index')
            ->with('success', 'Counselor updated successfully.');
    }

    public function destroy(Counselor $counselor)
    {
        if ($counselor->appointments()->exists()) {
            return redirect()->route('counselors.index')
                ->with('error', 'Cannot delete a counselor with existing appointments. Deactivate the counselor instead.');
        }

        $counselor->delete();

        return redirect()->route('counselors.index')
            ->with('success', 'Counselor deleted successfully.');
    }
}