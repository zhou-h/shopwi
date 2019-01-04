<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class FeedbackController extends Controller
{
    public function index(){
        $feedback=DB::table('feedback')->get();
        // var_dump($feedback);exit;
        return view('Admin.Feedback.feedback',['feedback'=>$feedback]); 
    }
}
