<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{

    protected $model;
    protected $viewsDomain = 'project.';

    public function __construct()
    {
        $this->model = new Project();
    }

    private function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = $this->model->with('tasks')->paginate(5);

        return $this->view('index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = $this->model->get();
        return $this->view('create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        DB::beginTransaction();

        try {
            Project::create($request->validated());
        } catch (\Exception $e) {
            // TODO: Throw exception message somewhere
            DB::rollback();
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);;
        }

        DB::commit();

        session()->flash('success', __('Created Successfully'));
        return redirect(route('project.index'));
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
    public function edit(Project $project)
    {
        $record = $project;
        return $this->view('edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $record = $project;
        DB::beginTransaction();

        try {
            $record->update($request->validated());
        } catch (\Exception $e) {
            // TODO: Throw exception message somewhere
            DB::rollback();
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);;
        }

        DB::commit();

        session()->flash('success', __('Updated Successfully'));
        return redirect(route('project.index'));
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $record =$project;

        DB::beginTransaction();

        try {
            $record->tasks()->delete();        
            $record->delete();        
        } catch (\Exception $e) {
            // TODO: Throw exception message somewhere
            DB::rollback();
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);;
        }

        DB::commit();
    
        session()->flash('fail', __('There was an error deleting the project.'));
        return redirect()->route('project.index');
    }
}
