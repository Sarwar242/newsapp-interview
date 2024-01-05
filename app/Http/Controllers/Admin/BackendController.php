<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Library\Enum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Library\Services\UserService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\ValidationException;

class BackendController extends Controller
{
    use ApiResponse;

    private $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    public function index()
    {
        return view('admin.pages.home.dashboard');
    }

    public function profile()
    {
        return view('admin.pages.member.profile');
    }


    public function users(Request $request)
    {
        if ($request->ajax()) {
            return $this->user_service->dataTable();
        }

        return view('admin.pages.member.index');
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');

        return back()->with('success', "Cache cleared successfully!");
    }
}
