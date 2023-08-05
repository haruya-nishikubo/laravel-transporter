<?php

namespace App\Http\Controllers\Transporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transporter\ConnectorTask\IndexRequest;
use HaruyaNishikubo\Transporter\Models\ConnectorTask;

class ConnectorTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $validated = $request->validated();

        $connector_tasks = $request->queryWithValidated()
            ->paginate(10);

        return view('transporter::connector_task.index', [
            'connector_tasks' => $connector_tasks,
            'criteria' => $validated,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ConnectorTask $connector_task)
    {
        return view('transporter::connector_task.show', [
            'connector_task' => $connector_task,
            'connector_task_lines' => $connector_task->connectorTaskLines()->paginate(10),
        ]);
    }
}
