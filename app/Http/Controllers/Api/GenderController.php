<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gender;

class GenderController extends Controller
{
    public function __invoke(Request $request)
    {
        $genders = Gender::all();

        return response()->json([
            'genders' => $genders->map(function($gender) {
                return [
                    'id' => $gender->id,
                    'name' => $gender->name,
                ];
            })
        ]);
    }
}
