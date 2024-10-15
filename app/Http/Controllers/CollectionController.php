<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollectionController extends Controller
{
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:250',
            'description' => 'required|string|max:250',

        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $isPublic  =  $request->isPublic == 'on' ? 1 : 0;
        $collection = Collection::create([
            'name' => $request->name,
            'description' => $request->description,
            'isPublic' => $isPublic,
            'parent_id' => $request->collection

        ]);

        return redirect()->back()->with(['message' => 'Your create new collection', 'message_type' => 'success']);
    }
}