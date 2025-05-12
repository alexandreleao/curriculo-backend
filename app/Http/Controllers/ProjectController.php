<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\ProjectService;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;
    protected ProjectService $service;

    public function __construct( ProjectService $service) {
        $this->service = $service;
    }
    /**
     * Lista os projetos cadastrados.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $projects = Project::when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(6)
            ->appends(['search' => $search]);
    
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
        $this->authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    /**
     * Atualiza os dados de um projeto existente.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);
        
        $this->service->update($request, $project);

        return redirect()->route('projects.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    /**
     * Remove um projeto do banco de dados.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
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
