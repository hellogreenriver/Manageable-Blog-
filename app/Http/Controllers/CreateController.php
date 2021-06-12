<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Rule;

class CreateController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required' ],
            'title' => ['required', 'unique:elements'],
            'text' => ['required'],
            'mainText' => ['required'],
        ]);
        $name = $request->name;
        $title = $request->title;
        $text = $request->text;
        $mainText = $request->mainText;
        //insert request into database
            Element::create([
            'name' => $name,
            'title' => $title,
            'text' => $text,
            'mainText' => $mainText,
        ]);
        return response()->Json('succsess');
        
    }
}

