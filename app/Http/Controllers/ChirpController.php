<?php

namespace App\Http\Controllers;

use App\Http\Requests\Chirp\{StoreChirpRequest, UpdateChirpRequest};
use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class ChirpController extends Controller
{
    public function index(): InertiaResponse
    {
        $chirps = Chirp::with('user:id,name')->latest()->get();
        $props = ['chirps' => $chirps];
        return Inertia::render('Chirps/Index', $props);
    }

    public function store(StoreChirpRequest $request): RedirectResponse
    {   
        $request->user()->chirps()->create($request->all());
        return redirect(route('chirps.index'));
    }

    public function update(UpdateChirpRequest $request, Chirp $chirp): RedirectResponse
    {
        $chirp->update($request->all());
        return redirect(route('chirps.index'));
    }

    public function destroy(Chirp $chirp): RedirectResponse
    {
        $this->authorize('delete', $chirp);
        $chirp->delete();
        return redirect(route('chirps.index'));
    }
}
