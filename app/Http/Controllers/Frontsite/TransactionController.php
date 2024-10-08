<?php

namespace App\Http\Controllers\Frontsite;

use App\Enums\EntityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontsite\Transaction\TransactionStoreRequest;
use App\Library\Common\IdGenerator;
use App\Models\Category;
use App\Models\Icon;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
    public function store(TransactionStoreRequest $request)
    {
        $transaction_data = $request->validated();

        $category = Category::where('category_id', $request->category_id)->first();

        $icon = Icon::where('icon_id', $category->icon_id)->first();

        $transaction_data =   array_merge($transaction_data, [
            'transaction_id' => IdGenerator::generateId(EntityEnum::TRANSACTION),
            'user_id' => 1,
            'category_type' => $category->type,
            'category_logo' => $icon->logo,
        ]);

        Transaction::create($transaction_data);

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
