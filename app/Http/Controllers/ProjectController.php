<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ProjectService;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    public function __construct(private ProjectService $service) {}
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
    public function store(StoreProjectRequest $request)
    {
        $this->service->create($request);
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
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->service->update($request, $project);
        return redirect()->route('projects.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    /**
     * Remove um projeto do banco de dados.
     */
    public function destroy(Project $project)
    {
        $this->service->delete($project);
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

  
}
