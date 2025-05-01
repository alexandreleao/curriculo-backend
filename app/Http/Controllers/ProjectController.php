<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Lista os projetos cadastrados.
     */
    public function index()
    {
        $projects = Project::latest()->paginate(6);
        return view('dashboard', compact('projects'));
    }

    /**
     * Mostra o formulário para criar novo projeto.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Armazena um novo projeto no banco de dados.
     */
    public function store(Request $request)
    {
        $data = $this->validateProject($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($data);

        return redirect()->route('projects.index')->with('success', 'Projeto cadastrado com sucesso!');
    }

    /**
     * Mostra o formulário de edição de um projeto.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Atualiza os dados de um projeto existente.
     */
    public function update(Request $request, Project $project)
    {
        $data = $this->validateProject($request);

        if ($request->hasFile('image')) {
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }

            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('projects.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    /**
     * Remove um projeto do banco de dados.
     */
    public function destroy(Project $project)
    {
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return back()->with('success', 'Projeto excluído com sucesso!');
    }

    /**
     * Realiza a busca de projetos por título ou descrição.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $projects = Project::query()
            ->where('title', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->latest()
            ->get();

        return view('dashboard', compact('projects'));
    }

    /**
     * Validação dos dados do projeto.
     */
    private function validateProject(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }
}
