<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Fortify\Features;

class WelcomeController extends Controller
{
    public function __invoke(Request $request)
    {
        return Inertia::render('WelcomePage', [
            'canRegister' => Features::enabled(Features::registration()),
        ]);
    }
}
