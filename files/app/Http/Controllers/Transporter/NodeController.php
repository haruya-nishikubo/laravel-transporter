<?php

namespace App\Http\Controllers\Transporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transporter\Node\IndexRequest;
use App\Http\Requests\Transporter\Node\StoreRequest;
use App\Http\Requests\Transporter\Node\UpdateRequest;
use HaruyaNishikubo\Transporter\Models\Node;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $validated = $request->validated();

        $nodes = $request->queryWithValidated()
            ->paginate(10);

        return view('transporter::node.index', [
            'nodes' => $nodes,
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
        $node = new Node;

        return view('transporter::node.create', [
            'node' => $node,
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

        $node = new Node($validated['node']);
        $node->fill([
            'secret' => [],
        ]);

        if (! $node->save()) {
            return back()->withInput()
                ->with('failure', 'Failure.');
        }

        return redirect()->route('transporter.node.show', $node)
            ->with('success', 'Success.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node)
    {
        return view('transporter::node.show', [
            'node' => $node,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node)
    {
        return view('transporter::node.edit', [
            'node' => $node,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Node $node)
    {
        $validated = $request->validated();

        $node->fill($validated['node']);

        if (! $node->save()) {
            return back()->withInput()
                ->with('failure', 'Failure.');
        }

        return redirect()->route('transporter.node.show', $node)
            ->with('success', 'Success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Node $node)
    {
        if (! $node->delete()) {
            return back()->with('failure', 'Failure.');
        }

        return redirect()->route('transporter.node.index')
            ->with('success', 'Success.');
    }
}
