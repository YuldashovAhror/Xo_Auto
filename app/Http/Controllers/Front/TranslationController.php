<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Words;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function en()
    {
        $arr = [];
        $words = Words::all();
        foreach ($words as $word) {
            $arr[$word->key] = $word->word_en;
        }
        return $arr;
    }
}
