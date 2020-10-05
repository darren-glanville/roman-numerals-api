<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RomanNumeralConverter;
use App\Models\RomanNumeral;

class NumeralsController extends Controller
{
    public function convertInteger($integer)
    {
        // convert integer to roman numeral
        $converter = new RomanNumeralConverter;
        $result = $converter->convertInteger($integer);

        // store in database (only if returns result)
        if (!is_null($result)) {
            $RomanNumeral = new RomanNumeral;

            $RomanNumeral->original = $integer;
            $RomanNumeral->converted = $result;

            $RomanNumeral->save();
        }

        // return
        return response()->json([$result]);
    }

    public function listAll()
    {
        // get all (newest item first)
        $numerals = RomanNumeral::orderBy('processed', 'DESC')->get();

        // return
        return response()->json($numerals);
    }

    public function listTop10()
    {
        // list top 10 used roman numerals
        $numerals = RomanNumeral::get()
            ->groupBy('converted')
            ->sortDesc()
            ->take(10);

        $response = [];
        foreach ($numerals as $index => $numeral) {
            $latest = $numeral->sortByDesc('processed')->first();

            $response[] = [
                'converted' => $index,
                'original'  => $latest->original,
                'count' => count($numeral),
                'processed' => $latest->processed
            ];
        }

        // return
        return response()->json($response);
    }
}
