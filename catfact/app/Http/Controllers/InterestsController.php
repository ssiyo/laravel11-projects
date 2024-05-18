<?php

namespace App\Http\Controllers;

use App\Models\Interests;
use Illuminate\Http\Request;

class InterestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function check(Request $request)
    {
        $topic = $request->get("topic");
        $interested = Interests::where("user_id", auth()->user()->id)->where("topic", $topic)->count() == 1;
        if ($interested){
            Interests::where("user_id", auth()->user()->id)->where("topic", $topic)->first()->delete();
        } else {
            Interests::create([
                "user_id"=>auth()->user()->id,
                "topic"=>$topic,
            ]);
        }

        return back();
    }
}
