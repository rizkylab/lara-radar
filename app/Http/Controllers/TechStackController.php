<?php

namespace App\Http\Controllers;

use App\Models\TechStack;
use Illuminate\Http\Request;

class TechStackController extends Controller
{
    /**
     * Display a listing of tech stacks.
     */
    public function index()
    {
        $techStacks = TechStack::with(['domain', 'subdomain'])
            ->orderByDesc('created_at')
            ->paginate(50);

        return view('tech-stack.index', compact('techStacks'));
    }

    /**
     * Display the specified tech stack.
     */
    public function show($id)
    {
        $techStack = TechStack::with(['domain', 'subdomain'])
            ->findOrFail($id);

        return view('tech-stack.show', compact('techStack'));
    }

    /**
     * Store a newly created tech stack.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'domain_id' => 'required|exists:domains,id',
            'subdomain_id' => 'nullable|exists:subdomains,id',
            'name' => 'required|string|max:255',
            'version' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
        ]);

        $techStack = TechStack::create($validated);

        return redirect()->route('tech-stack.index')
            ->with('success', 'Tech stack added successfully.');
    }

    /**
     * Remove the specified tech stack.
     */
    public function destroy($id)
    {
        $techStack = TechStack::findOrFail($id);
        $techStack->delete();

        return redirect()->route('tech-stack.index')
            ->with('success', 'Tech stack deleted successfully.');
    }
}
