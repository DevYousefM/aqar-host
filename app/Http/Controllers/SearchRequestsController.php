<?php

namespace App\Http\Controllers;


use App\Models\SearchRequests;
use Illuminate\Http\Request;

class SearchRequestsController extends Controller
{
    public function index()

    {
        $search_reqs = SearchRequests::all();
        return view("dashboard.search_requests.index", ["search_reqs" => $search_reqs]);
    }

    public function search_request_form()
    {
        return view("pages.searchRequest");
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'meters' => 'required|numeric|min:1',
            'gov' => 'required|numeric|exists:governments,id',
            'area' => 'required|string|max:255',
            'rooms' => 'nullable|integer|min:1',
            'contract_type' => 'required|in:تمليك,ايجار',
            'price' => 'required',
        ]);

        SearchRequests::create([
            'type' => $request->type,
            'meters' => $request->meters,
            'gov' => $request->gov,
            'area' => $request->area,
            'rooms' => $request->rooms,
            'contract_type' => $request->contract_type,
            'price' => $request->price,
        ]);
        return redirect()->route("search_request_form.show")->with("success", "تم تسجيل طلبك بنجاح");
    }
}
