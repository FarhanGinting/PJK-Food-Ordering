<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function store (Request $request){
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|integer',
            'image_file' => 'nullable|mimes:png,jpg',
        ]);

        if ($request->file('image_file')) {
            // Proses Upload
            $file = $request->file('image_file');
            $filename = $file->getClientOriginalName();
            $newName = Carbon::now()->timestamp.'_'.$filename;

            Storage::disk('public')->putFileAs('items', $file, $newName);
            $request['image'] = $newName;
        }

        $dataInputan = Item::create($request->all());
        return response(['data' => $dataInputan]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|integer',
            'image_file' => 'nullable|mimes:png,jpg',
        ]);

        if ($request->file('image_file')) {
            // Proses Upload
            $file = $request->file('image_file');
            $filename = $file->getClientOriginalName();
            $newName = Carbon::now()->timestamp.'_'.$filename;

            Storage::disk('public')->putFileAs('items', $file, $newName);
            $request['image'] = $newName;
        }

        $dataInputan = Item::findOrFail($id);
        $dataInputan->update($request->all());
        return response(['data' => $dataInputan]);
    }
    
}
