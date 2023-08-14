<?php

namespace App\Http\Controllers\Assistant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssistantController extends Controller
{
    public function index(){
        return view('assistant.index');
    }
}
