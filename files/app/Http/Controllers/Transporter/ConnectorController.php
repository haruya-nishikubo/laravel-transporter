<?php

namespace App\Http\Controllers\Transporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transporter\Connector\IndexRequest;
use App\Http\Requests\Transporter\Connector\StoreRequest;
use App\Http\Requests\Transporter\Connector\UpdateRequest;
use HaruyaNishikubo\Transporter\Models\Connector;
use HaruyaNishikubo\Transporter\Models\Node;

class ConnectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $validated = $request->validated();

        $connectors = $request->queryWithValidated()
            ->paginate(10);

        return view('transporter::connector.index', [
            'connectors' => $connectors,
            'criteria' => $validated,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $connector = new Connector;

        return view('transporter::connector.create', [
            'connector' => $connector,
            'nodes' => Node::cursor(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $connector = new Connector($validated['connector']);

        if (! $connector->save()) {
            return back()->withInput()
                ->with('failure', 'Failure.');
        }

        return redirect()->route('transporter.connector.show', $connector)
            ->with('success', 'Success.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Connector $connector)
    {
        return view('transporter::connector.show', [
            'connector' => $connector,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Connector $connector)
    {
        return view('transporter::connector.edit', [
            'connector' => $connector,
            'nodes' => Node::cursor(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Connector $connector)
    {
        $validated = $request->validated();

        $connector->fill($validated['connector']);

        if (! $connector->save()) {
            return back()->withInput()
                ->with('failure', 'Failure.');
        }

        return redirect()->route('transporter.connector.show', $connector)
            ->with('success', 'Success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Connector $connector)
    {
        if (! $connector->delete()) {
            return back()->with('failure', 'Failure.');
        }

        return redirect()->route('transporter.connector.index')
            ->with('success', 'Success.');
    }
}
