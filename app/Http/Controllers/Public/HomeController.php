<?php

namespace App\Http\Controllers\Public;

use Carbon\Carbon;
use App\Models\User;
use App\Library\Enum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    public function index()
    {
        return view('public.pages.home.index');
    }
}
