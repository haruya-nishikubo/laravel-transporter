<?php

namespace App\Http\Controllers\Transporter\Connector;

use App\Http\Controllers\Controller;
use HaruyaNishikubo\Transporter\Models\Connector;
use HaruyaNishikubo\Transporter\Models\ConnectorTask;

class ConnectorTaskController extends Controller
{
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
