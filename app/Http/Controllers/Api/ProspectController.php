<?php

namespace App\Http\Controllers\Api;

use App\Actions\PromoteProspectToClientAction;
use App\Actions\UpsertProspectAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProspectRequest;
use App\Http\Resources\ProspectResource;
use App\Models\Prospect;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProspectController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $prospects = Prospect::query()
            ->when($request->query('source'), fn ($query, $source) => $query->where('source', $source))
            ->when($request->query('status'), fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->paginate(min((int) $request->query('per_page', 25), 100));

        return ProspectResource::collection($prospects);
    }

    public function store(StoreProspectRequest $request, UpsertProspectAction $upsertProspect)
    {
        $prospect = $upsertProspect($request->validated());

        return (new ProspectResource($prospect))
            ->response()
            ->setStatusCode($prospect->wasRecentlyCreated ? 201 : 200);
    }

    public function promote(Prospect $prospect, PromoteProspectToClientAction $promoteProspect): ProspectResource
    {
        $promoteProspect($prospect);

        return new ProspectResource($prospect->fresh());
    }
}
