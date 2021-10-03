<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        if($request->input('query')){
            $q = $request->input('query');

            $videos = Video::query()
            ->where('title', 'LIKE', "%{$q}%")
            ->orWhere('description', 'LIKE', "%{$q}%")
            ->get();
        }else{
            $videos = [];

        }

        return view('search', compact('videos','q'));
    }
}
