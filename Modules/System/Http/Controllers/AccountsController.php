<?php

namespace Modules\System\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\System\Helpers\Helper;
use Modules\System\Http\Requests\CreateAccountRequest;
use Modules\System\Services\AccountService;

class AccountsController extends Controller
{

    public function __construct(AccountService $AccountService, Helper $helper)
    {
        $this->AccountService = $AccountService;
        $this->helper = $helper;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('system::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('system::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateAccountRequest $request)
    {
     
        $validated = $request->validated();
        $execution = $this->AccountService->store($validated);
        return response()->json($execution, $execution['code']);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('system::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(request $request)
    {
        $data = $request->all();
        $execution = $this->AccountService->update($data);
        return response($execution, $execution['code'])->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
