<?php

namespace App\Http\Controllers\Api\Country;

use App\Http\Controllers\Api\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class CountryController extends Controller
{
    public function country() {
        return response()->json(Country::get(), 200);
    }

    public function countryById($id) {
        $country = Country::find($id);
        if ( is_null($country) ) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($country, 200);
    }

    public function countrySave(Request $req) {
        $rules = [
            'iso' => 'required|min:2|max:2',
            'name' => 'required|min:3',
            'name_en' => 'required|min:3'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $country = Country::create($req->all());
        return response()->json($country, 201);
    }

    public function countryEdit(Request $req, $id) {
        $rules = [
            'iso' => 'required|min:2|max:2',
            'name' => 'required|min:3',
            'name_en' => 'required|min:3'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $country = Country::find($id);
        if ( is_null($country) ) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $country->update($req->all());
        return response()->json($country, 200);
    }

    public function countryDelete(Request $req, $id) {
        $country = Country::find($id);
        if ( is_null($country) ) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $country->delete();
        return response()->json('', 204);
    }
}
