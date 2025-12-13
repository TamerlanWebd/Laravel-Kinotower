<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Requests\Admin\CountryRequest;
class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(CountryRequest $request)
    {
        $data = $request->validated();
        Country::create($data);
        return redirect()->route('countries.index');
    }

    public function edit(string $id)
    {
       $country = Country::findOrFail($id);
       return view('admin.countries.create', compact('country'));
    }

    public function update(CountryRequest $request, string $id)
    {
        $data = $request->validated();
        $country = Country::findOrFail($id);
        $country->update($data);
        return redirect()->route('countries.index');
    }

    public function destroy(string $id)
    {
       Country::destroy($id);
       return redirect()->route('countries.index');
    }
}
