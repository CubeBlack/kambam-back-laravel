<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{

    public function index(){
        $cards = Card::orderBy('project')
            ->orderBy('group')
            ->get();

        return response()->json($cards);
    }

    public function show($id){
        $card = Card::findOrFail($id);
        //var_dump($card);
        return response()->json($card);
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

        return response()->json($card, 201);
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
