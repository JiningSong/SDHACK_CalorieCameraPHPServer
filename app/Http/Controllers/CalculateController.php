<?php

namespace App\Http\Controllers;

use App\Record;
use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function index(Request $request) {

        $sum = 0;
        for($i = 0; $i < count($request['quantity']); $i++) {
            $sum += $request['quantity'] * $request['calorie'];
        }
        $record = new Record();
        $record->calorie = $sum;
        $record->user_id = $request['user_id'];
        $record->save();
        return redirect()->route('home');
    }
}
