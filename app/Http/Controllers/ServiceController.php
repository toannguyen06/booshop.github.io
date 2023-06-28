<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function showContact()
    {
        $categories = Category::all();
        return view('frontend.service.contact',compact('categories'));
    }

    public function showSecurity()
    {
        $categories = Category::all();
        return view('frontend.service.security', compact('categories'));
    }

    public function showTerms()
    {
        $categories = Category::all();
        return view('frontend.service.terms', compact('categories'));
    }

    public function showTransport()
    {
        $categories = Category::all();
        return view('frontend.service.transport', compact('categories'));
    }

    public function showChange()
    {
        $categories = Category::all();
        return view('frontend.service.change', compact('categories'));
    }

    public function showBuys()
    {
        $categories = Category::all();
        return view('frontend.service.buys', compact('categories'));
    }

    public function showIntroduce()
    {
        $categories = Category::all();
        return view('frontend.service.introduce', compact('categories'));
    }
}
