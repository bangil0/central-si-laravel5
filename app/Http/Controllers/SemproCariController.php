<?php

namespace App\Http\Controllers;

use App\TaSempro;
use Illuminate\Http\Request;

class SemproCariController extends Controller
{
    public function show(Request $request)
    {
        $this->validate($request, ['keyword' => 'required']);

        $TaSempros = $request->input('TaSempro');
        $filter = '%'.$TaSempros.'%';

        $TaSempros = TaSempro::where('nama', 'like', $filter)
            ->orWhere('nip', 'like', $filter)
            ->paginate(25);

        return view('backend.TaSempro.index', compact('TaSempros', 'TaSempro'));

    }
}

