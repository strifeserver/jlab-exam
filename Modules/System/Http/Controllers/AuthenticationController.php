<?php

namespace Modules\System\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\System\Helpers\Helper;
use Modules\System\Services\LoginService;

class AuthenticationController extends Controller
{
    public function __construct(Helper $helper, LoginService $LoginService)
    {
        $this->helper = $helper;
        $this->LoginService = $LoginService;
    }

    #laravel sanctum
    public function login(Request $request)
    {
        $execution = $this->LoginService->authenticate($request);
        return response()->json($execution, $execution['code']);
    }

    public function adminProfile(Request $request)
    {
        return response()->json($request->user());
    }

    public function customerProfile(Request $request)
    {
        return response()->json($request->user());
    }

}
