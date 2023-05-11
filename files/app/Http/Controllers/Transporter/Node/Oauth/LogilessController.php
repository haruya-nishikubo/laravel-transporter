<?php

namespace App\Http\Controllers\Transporter\Node\Oauth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transporter\Node\Oauth\Logiless\Request;
use HaruyaNishikubo\Transporter\Models\Node;
use Illuminate\Support\Facades\Http;

class LogilessController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Node $node)
    {
        $validated = $request->validated();

        $url = $node->tokenUrl($validated['code']);

        $response = Http::get($url);

        $oauth = $response->json();

        $node->fill([
            'secret' => array_merge($node->secret, [
                'oauth' => $oauth,
                'expired_at' => now()->addSeconds($oauth['expires_in'])
                    ->toDateTimeString(),
            ]),
        ]);

        if (! $node->save()) {
            return redirect()->route('transporter.node.show', $node)
                ->with('failure', 'Failure.');
        }

        return redirect()->route('transporter.node.show', $node)
            ->with('success', 'Success.');
    }
}
