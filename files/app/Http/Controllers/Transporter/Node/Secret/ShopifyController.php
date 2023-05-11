<?php

namespace App\Http\Controllers\Transporter\Node\Secret;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transporter\Node\Secret\Shopify\UpdateRequest;
use HaruyaNishikubo\Transporter\Models\Node;
use Illuminate\Http\Response;

class ShopifyController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node)
    {
        return view('transporter::node.secret.shopify.edit', [
            'node' => $node,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(UpdateRequest $request, Node $node)
    {
        $validated = $request->validated();

        $node->fill($validated['node']);

        if (! $node->save()) {
            return back()->with('failure', 'Failure.');
        }

        return redirect()->route('transporter.node.show', $node)
            ->with('success', 'Success.');
    }
}
