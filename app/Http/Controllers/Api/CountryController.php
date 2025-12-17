<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    public function __invoke(Request $request)
    {
        return [
            'countries' => CountryResource::collection(Country::all())
        ];
    }
}
