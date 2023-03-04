<?php 

namespace Brycedev\Peek\Http\Controllers;

use Inertia\Inertia;
use Brycedev\Peek\Models\RequestRecord;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RequestRecordsController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Requests', [
            'requests' => RequestRecord::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function show(Request $request, RequestRecord $requestRecord)
    {
        return Inertia::render('Request/Show', [
            'request' => $requestRecord,
        ]);
    }
}