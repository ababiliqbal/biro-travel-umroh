<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PageController extends Controller
{
    public function home()
    {
        $featuredPackages = Package::latest()->take(3)->get();
        return view('public.home', compact('featuredPackages'));
    }

    public function catalog(Request $request)
    {
        $query = Package::latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $packages = $query->paginate(9)->withQueryString();

        return view('public.packages.index', compact('packages'));
    }

    public function showPackage(Package $package)
    {
        $package->load('documents');
        return view('public.packages.show', compact('package'));
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }
}
