<?php

namespace App\Http\Controllers\Frontsite;

use App\Enums\EntityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontsite\Budget\BudgetStoreRequest;
use App\Http\Requests\Frontsite\Budget\BudgetUpdateRequest;
use App\Http\Requests\Frontsite\Category\StoreRequest;
use App\Library\Common\IdGenerator;
use App\Models\Budget;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\ErrorHandler\Debug;

class BudgetController extends Controller
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
    public function store(BudgetStoreRequest $request)
    {
        $validated_data = $request->validated();

        $validated_data['user_id'] = 1;
        $validated_data['budget_id'] = IdGenerator::generateId(EntityEnum::BUDGET);

        Budget::create($validated_data);

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $budget = Budget::where('budget_id', $id)->first();

        if(is_null($budget)){
            return [];
        }

        return $budget;
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
    public function update(BudgetUpdateRequest $request, string $id)
    {
        $budget = Budget::where('budget_id', $id)->first();

        if(is_null($budget)){
            session()->flash('error', 'Budget not find');
            return true;
        }

        $validated_data = $request->validated();

        $budget->update($validated_data);

        return true;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $budget = Budget::where('budget_id', $id)->first();

        $budget->delete();

        return true;
    }
}
