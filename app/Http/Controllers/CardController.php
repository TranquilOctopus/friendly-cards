<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

use App\Http\Requests;

class CardController extends Controller
{
    public function all()
    {
        $cards = Card::all();

        return view('cards')->with('cards', $cards);
    }

    public function get(Request $request, Card $card)
    {
        return view('card')->with('card', $card);
    }

    public function setRarity(Request $request, Card $card, $rarity)
    {
        $card->rarity = (int) $rarity;
        $card->save();

        print "success";
    }
}
