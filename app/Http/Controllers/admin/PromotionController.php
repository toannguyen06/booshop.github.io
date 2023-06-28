<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Http\Controllers\Controller;
class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return view('backend.promotion.index', compact('promotions'));
    }

    public function show(Promotion $promotion)
    {
        return view('backend.promotion.show', compact('promotion'));
    }

    public function create()
    {
        return view('backend.promotion.create');
    }

    public function store(Request $request)
    {
        Promotion::create($request->input());
        return redirect('admin/promotions');
    }

    public function edit(Promotion $promotion)
    {
        return view('backend.promotion.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $promotion->update($request->input());
        return redirect('admin/promotions');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect('admin/promotions');
    }
}
