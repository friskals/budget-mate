<?php

namespace App\Http\Controllers\Frontsite;

use App\Enums\EntityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontsite\Account\AccountStoreRequest;
use App\Http\Requests\Frontsite\Account\AccountUpdateRequest;
use App\Http\Requests\Frontsite\Category\StoreRequest;
use App\Library\Common\IdGenerator;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountStoreRequest $request)
    {
        $account_data = $request->validated();

        $account_data['user_id'] = 1;
        $account_data['account_id'] = IdGenerator::generateId(EntityEnum::CATEGORY);

        Account::create($account_data);

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $account = Account::where('account_id', $id)->first();
        return $account;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountUpdateRequest $request, string $id)
    {
        $validated_data = $request->validated();

        if(count($validated_data) == 0){
            session()->flash('success', 'No updated data');
            return ;
        }

        $account = Account::where('account_id', $id)->first();


        if(is_null($account)){
            session()->flash('error', 'Account not found');
            return ;
        }

        $account->update($validated_data);

        session()->flash('success', 'Account updated successfully');

        return true;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
