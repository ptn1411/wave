<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|string|max:250',
        ]);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $link = Link::create([
            'name' => $request->name,
            'description' => $request->description,
            'url' => $request->url,
        ]);
        $collection = $request->collection;
        $tag = $request->tag;
        if (isset($collection)) {
            $link->collections()->attach($collection);
        }
        if (isset($tag)) {
            $link->tags()->attach($tag);
        }

        return redirect()->back()->with(['message' => 'Your create new link', 'message_type' => 'success']);
    }
    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $links = Link::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('textContent', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhere('url', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        return response()->json(['success' => true, 'data' => $links], 200);
    }
}
