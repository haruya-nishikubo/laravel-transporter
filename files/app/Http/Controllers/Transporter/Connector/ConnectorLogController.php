<?php

namespace App\Http\Controllers\Transporter\Connector;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transporter\Connector\ConnectorLog\IndexRequest;
use HaruyaNishikubo\Transporter\Models\Connector;

class ConnectorLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request, Connector $connector)
    {
        $validated = $request->validated();

        $connector_logs = $request->queryWithValidated()
            ->paginate(10);

        return view('transporter::connector.connector_log.index', [
            'connector' => $connector,
            'connector_logs' => $connector_logs,
            'criteria' => $validated,
        ]);
    }
}
