<?php

namespace Modules\System\Services;

use Laravel\Sanctum\PersonalAccessToken;
use Modules\System\Entities\Account;
use Modules\System\Helpers\Helper;

class AccountService
{

/**
 * @param Webhook $repository
 */
    public function __construct(Account $repository, Helper $helper)
    {
        $this->repository = $repository;
        $this->helper = $helper;
    }

    public function store(array $request): array
    {
        $request['account_status'] = 'active';
        $execution = $this->repository->store($request);

        $generateUserCode = $this->generateUserCode($execution['data_id']);

        $updateData = [
            'id' => $execution['data_id'],
            'code' => $generateUserCode,
        ];
        $execute_update = $this->update($updateData);

        $response = $this->helper->apiResponse($execution['status'], 200, null, $execution);

        return $response;
    }

    public function edit(int $Id): array
    {
        $execution = $this->repository->edit($Id);
        $response = $this->helper->apiResponse($execution['status'], 200, null, $execution);
        return $response;
    }

    public function update(array $request): array
    {
        $execution = $this->repository->execute_update($request);

        $response = $this->helper->apiResponse($execution['status'], $execution['code'], $execution['message'] ?? null, $execution['result']);

        return $response;
    }
    public function destroy($id): array
    {
        $existing_data = $this->edit($id);
        $execution = $this->repository->execute_destroy($id);

        if ($execution['status'] === 1 && $existing_data) {
            $existing_data = $existing_data['result'];
            $audit_data = ['existing_data' => $existing_data];
            // $this->audit_service->store($audit_data);
        }

        $response = $this->helper->apiResponse($execution['status'], $execution['code'], $execution['message'] ?? null, $execution);

        return $response;
    }

    public function generateUserCode($userId)
    {
        $stationCode = "USR";
        $incrementalUserCount = str_pad($userId, 5, '0', STR_PAD_LEFT);
        $randomNumber = mt_rand(100, 999);
        $userCode = sprintf("%s-%s-%d", $stationCode, $incrementalUserCount, $randomNumber);
        return $userCode;
    }

    public function validateToken($request)
    {
        $returns = [];
        $tokenString = $request->bearerToken();
        if (!$tokenString) {
            $returns['status'] = 'error';
            $returns['code'] = 401;
            $returns['message'] = 'Token not found';

            // return response()->json(['message' => 'Token not found'], 401);
        }

        list($id, $token) = explode('|', $tokenString, 2);
        $tokenRecord = PersonalAccessToken::find($id);

        if (!$tokenRecord) {
            $returns['status'] = 'error';
            $returns['code'] = 401;
            $returns['message'] = 'Token not found';

            // return response()->json(['message' => 'Token not found'], 401);
        }
        $token = hash('sha256', $token);
        if ($token === $tokenRecord->token) {
            $user = $tokenRecord->tokenable;
            $returns['status'] = 'success';
            $returns['code'] = 200;
            $returns['message'] = 'Token is valid';
            $returns['result'] = ['user' => $user];
            // return response()->json(['message' => 'Token is valid', 'user' => $user]);
        } else {
            $returns['status'] = 'success';
            $returns['code'] = 401;
            $returns['message'] = 'Invalid token';
            // return response()->json(['message' => 'Invalid token'], 401);
        }
        $returns = $this->helper->apiResponse($returns['status'], $returns['code'], $returns['message'] ?? null, $returns['result']);
        return $returns;
    }
}
