<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;

class ElementsController extends Controller
{
    public function index()
    {
        return Element::paginate(9);
    }
    public function find(Request $request){
        $id = $request->id;
        $result =  Element::find($id);
        return $result;
    }
}
