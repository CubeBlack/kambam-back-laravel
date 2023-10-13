<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{

    public function index(){
        return response()->json(Card::all());
    }

    public function show($id){
        return response()->json(Card::findOrFail($id));
    }

    public function store(Request $request){
        $request->validate([
            'project' => 'required',
            'group' => 'required',
            'status'=> 'required',
            'title'=> 'required',
            'description'=> 'required'
            
        ]);

        $card = Card::create($request->all());

        return response()->json($card);
    }

    public function update(Request $request, $id){
        $request->validate([
            'project' => 'required',
            'group' => 'required',
            'status'=> 'required',
            'title'=> 'required',
            'description'=> 'required'
            
        ]);
        //$card = Card::update($request);
        $card = Card::whereId($id)->update($request->all());
        return response()->json($card);
    }   
}
