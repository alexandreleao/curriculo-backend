<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProjectService
{
    public function create(Request $request): void
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        
        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')->store('projects', 'public');
        }

        Project::create($data);
    }

    public function update(Request $request, Project $project): void
    {
        $data = $request->validated();

        if ($request->hasFile('imagem')) {
            if ($project->imagem && Storage::disk('public')->exists($project->imagem)) {
                Storage::disk('public')->delete($project->imagem);
            }

            $data['imagem'] = $request->file('imagem')->store('projects', 'public');
        }

        $project->update($data);
    }

    public function delete(Project $project): void
    {
        if ($project->imagem && Storage::disk('public')->exists($project->imagem)) {
            Storage::disk('public')->delete($project->imagem);
        }

        $project->delete();
    }
}
