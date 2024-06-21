<?php

namespace Modules\System\Services;

use Illuminate\Support\Facades\Hash;
use Modules\System\Entities\Account;
use Modules\System\Helpers\Helper;

class LoginService
{
    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    public function authenticate($request)
    {
        $credentials = $request->only('email', 'password');
        $currentUrl = $request->url();
        $segments = explode('/', $currentUrl);
        $case = $segments[5];
        $account = Account::where('email', $credentials['email'])->first();

        try {

            if ($account && Hash::check($credentials['password'], $account->password)) {
                $token = $account->createToken('admin_token')->plainTextToken;
                $response = $this->helper->apiResponse('success', 200, 'Success', ['access_token' => $token, 'token_type' => 'Bearer']);
            } else {
                $response = $this->helper->apiResponse('success', 401, 'Invalid credentials', []);
            }

        } catch (\Exception $e) {
            $response = $this->helper->apiResponse('success', 401, 'Unauthorized', []);
        }
        return $response;
    }
}
