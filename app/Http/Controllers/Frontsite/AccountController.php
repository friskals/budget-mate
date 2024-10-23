<?php

namespace App\Http\Controllers\Frontsite;

use App\Enums\EntityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontsite\Account\AccountStoreRequest;
use App\Http\Requests\Frontsite\Account\AccountUpdateRequest;
use App\Library\Common\IdGenerator;
use App\Models\Account;
use App\Models\Icon;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\json_encode;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::where('user_id', Auth::id())->get();

        $icons = Icon::where('icon_usage','account')->get();

        foreach ($accounts as $account){
            $account_icon = $icons->where('icon_id', $account->icon_id)->first();

            if(!is_null($account_icon)){
             $account->icon = $account_icon->logo;
            }
        }

        return view('frontsite.account.index', ['accounts'=>$accounts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $icons = Icon::where('icon_usage','account')->get();


        return view('frontsite.account.create', ['icons' => $icons]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountStoreRequest $request)
    {
        $account_data = $request->validated();

        $account_data['user_id'] = Auth::id();
        $account_data['account_id'] = IdGenerator::generateId(EntityEnum::CATEGORY);

        Account::create($account_data);

        return redirect()->route('account.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $account = Account::where([
            'user_id'=> Auth::id(),
            'account_id' => $id
        ])->firstOrFail();

        $icons = Icon::where('icon_usage','account')->get();

        return view('frontsite.account.edit', [
            'icons' => $icons,
            'account' => $account
        ]);
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

        return redirect()->route('account.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //TODO delete all related transaction for the given id
        $account = Account::where('account_id', $id)->first();

        if(!is_null($account)){
            $account->delete();
        }

        session()->flash('success', 'Account deleted successfully');

        return true;
    }
}
