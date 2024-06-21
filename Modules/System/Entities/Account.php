<?php

namespace Modules\System\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Account extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'code',
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'temporary_password',
        'account_level',
        'account_status',
    ];

    protected $table = 'accounts';

    public function store(array $request): array
    {
        $returns = [];
        $id = optional($request)->get('id', '');
        $fields = $this->fillable;
        $submittedData = collect($request)->only($fields)->toArray();
        $execute = $this::create($submittedData)->id;

        $executeStatus = (is_integer($execute)) ? 1 : 0;
        $returns['status'] = $executeStatus;
        $returns['data_id'] = $execute;

        return $returns;
    }

    public function execute_update($request): array
    {
        // $id = $request['id'] ?? $request->input('id');
        $id = isset($request['id']) ? $request['id'] : null;
        $identifier = isset($request['identifier']) ? $request['identifier'] : null;
        $fields = $this->fillable;

        $data = $this->where('id', $id)->first();

        $request = collect($request);
        if ($data) {
            $submittedData = $request->only($fields);
            $beforeUpdate = $data->toArray();
            $submittedUpdate = $submittedData->toArray();
            $execute = $data->update($submittedUpdate);
            $auditing = null; // no update auditing defined
        } else {
            return [
                'message' => 'data does not exist',
                'code' => 404,
                'result' => null,
                'status' => 0,
            ];
        }

        return [
            'status' => $execute ? 1 : 0,
            'code' => 200,
            'result' => [
                'data_id' => $data->id,
            ],
        ];
    }

    public function execute_destroy($id): array
    {
        $response = [];
        $success = false;

        $id = $id ?? '';

        if (!empty($id)) {
            try {
                $data = $this->findOrFail($id);
                $beforeUpdate = $data->toArray();
                $success = $data->delete();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $response['status'] = 0;
                $response['result'] = 'Data does not exist';
                return $response;
            }
        }

        $status = ($success) ? 1 : 0;
        $code = ($success) ? 200 : 400;
        $response['status'] = $status;
        $response['code'] = $code;
        $response['data_id'] = @$data->id;
        return $response;
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
