<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name')->paginate(5);

        return view('country.index', compact('countries'));
    }

    public function create()
    {
        return view('country.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'size:2', 'unique:country,code'],
            'name' => ['required', 'string', 'max:52'],
            'population' => ['required', 'integer', 'min:0'],
        ]);

        Country::create($validated);

        return redirect()->route('country.index');
    }

    public function show(Country $country)
    {
        return view('country.show', compact('country'));
    }

    public function edit(Country $country)
    {
        return view('country.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:52'],
            'population' => ['required', 'integer', 'min:0'],
        ]);

        $country->update($validated);

        return redirect()->route('country.index');
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('country.index');
    }
}
