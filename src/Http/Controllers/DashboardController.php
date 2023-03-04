<?php 

namespace Brycedev\Peek\Http\Controllers;

use Inertia\Inertia;
use Brycedev\Peek\Models\RequestRecord;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Dashboard', [
            'records' => RequestRecord::orderBy('created_at', 'desc')->get(),
        ]);
    }
}