<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->paginate(6);

        return view('dashboard', compact('projects'));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('projects', 'public');
            $validated['imagem'] = $path;
        }
    
        Project::create($validated);
    
        return redirect()->route('projects.dashboard')->with('success', 'Projeto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = $request->only(['title', 'description']);
    
        // Se houver nova imagem
        if ($request->hasFile('imagem')) {
            // Apaga a imagem antiga
            if ($project->imagem && Storage::exists($project->imagem)) {
                Storage::delete($project->imagem);
            }
    
            $imagePath = $request->file('imagem')->store('projects', 'public');
            $data['imagem'] = $imagePath;
        }
    
        $project->update($data);
        return redirect()->route('projects.dashboard')->with('message', 'Projeto atualizado com sucesso!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Deleta a imagem do disco
    if ($project->image && Storage::exists($project->image)) {
        Storage::delete($project->image);
    }

    $project->delete();

    return back()->with('success', 'Projeto excluído com sucesso!');

}

public function search(Request $request){
    $search = strtolower($request->input('search'));

    $projects = Project::whereRaw('LOWER(title) LIKE ?', ["%{$search}%"])
        ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"])
        ->get();

    
    return view('dashboard', compact('projects'));
    


}
   

}


    