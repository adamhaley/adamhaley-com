<?php

namespace App\Http\Controllers\Api;

use App\Actions\UpsertClientAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $clients = Client::query()
            ->when($request->query('source'), fn ($query, $source) => $query->where('source', $source))
            ->latest()
            ->paginate(min((int) $request->query('per_page', 25), 100));

        return ClientResource::collection($clients);
    }

    public function store(StoreClientRequest $request, UpsertClientAction $upsertClient)
    {
        $client = $upsertClient($request->validated());

        return (new ClientResource($client))
            ->response()
            ->setStatusCode($client->wasRecentlyCreated ? 201 : 200);
    }
}
