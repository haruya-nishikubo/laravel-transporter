<?php

namespace App\Http\Controllers\Transporter\Connector;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transporter\Connector\ConnectorTask\IndexRequest;
use HaruyaNishikubo\Transporter\Models\Connector;
use HaruyaNishikubo\Transporter\Models\ConnectorTask;

class ConnectorTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request, Connector $connector)
    {
        $validated = $request->validated();

        $connector_tasks = $request->queryWithValidated()
            ->paginate(10);

        return view('transporter::connector.connector_task.index', [
            'connector' => $connector,
            'connector_tasks' => $connector_tasks,
            'criteria' => $validated,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Connector $connector, ConnectorTask $connector_task)
    {
        return view('transporter::connector.connector_task.show', [
            'connector' => $connector,
            'connector_task' => $connector_task,
        ]);
    }
}
