<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    protected $model;
    protected $viewsDomain = 'task.';

    public function __construct()
    {
        $this->model = new Task();
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
        $records = $this->model->orderBy('priority', 'DESC')->with('project')->paginate(5);

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
    public function store(TaskRequest $request)
    {
        DB::beginTransaction();

        try {
            Task::create($request->validated());
        } catch (\Exception $e) {
            // TODO: Throw exception message somewhere
            DB::rollback();
            return redirect()->back()->withErrors(['msg' => $e->getMessage()]);;
        }

        DB::commit();

        session()->flash('success', __('Created Successfully'));
        return redirect(route('task.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $record = $task;
        return $this->view('edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $record = $task;
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
        return redirect(route('task.index'));
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $record =$task;
        if($record){
            $record->delete();
            session()->flash('success', __('Deleted successfully'));
            return redirect()->route('task.index');
        }

        // TODO: Throw exception message somewhere

        session()->flash('fail', __('There was an error deleting the task.'));
        return redirect()->route('task.index');
    }
}
