<?php

namespace App\Http\Controllers\Frontsite;

use App\Enums\EntityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontsite\Budget\BudgetStoreRequest;
use App\Http\Requests\Frontsite\Budget\BudgetUpdateRequest;
use App\Library\Common\IdGenerator;
use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

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

        $validated_data['user_id'] = Auth::id();
        $validated_data['budget_id'] = IdGenerator::generateId(EntityEnum::BUDGET);

        $budget = Budget::create($validated_data);

        $categories = explode(',',$validated_data['category_id']);

        $count_valid_category = Category::whereIn('category_id', $categories)->count();

        if(count($categories) != $count_valid_category){
            session()->flash('error', 'Invalid category');
            return false;
        }

        $budget_categories = [];

        foreach($categories as $category){
            array_push($budget_categories, [
                'category_id' => $category,
                'budget_id' => $budget->budget_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        BudgetCategory::insert($budget_categories);

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
