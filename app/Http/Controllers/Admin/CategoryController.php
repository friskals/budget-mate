<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EntityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontsite\Category\StoreRequest;
use App\Http\Requests\Frontsite\Category\UpdateRequest;
use App\Library\Common\IdGenerator;
use App\Models\BudgetCategory;
use App\Models\Category;
use App\Models\Icon;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    const NUMBER_OF_ITEM_PER_PAGE = 10;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())
                    ->latest()
                    ->paginate(self::NUMBER_OF_ITEM_PER_PAGE);

        return view('frontsite.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $icons = Icon::where('icon_usage', 'income')->get();

        return view('frontsite.category.create', ['icons' => $icons]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated_requests = $request->validated();

        $validated_requests['category_id'] = IdGenerator::generateId(EntityEnum::CATEGORY);

        $validated_requests['user_id'] = Auth::id();

        Category::create($validated_requests);

        session()->flash('success', 'Category Created Successfully');

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::where('category_id', $id)->first();

        return ['category' => $category];
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
    public function update(UpdateRequest $request)
    {
        $validated_request= $request->validated();

        $category = Category::where('category_id',$request['category_id'])->first();

        if(!is_null($category)){
            $category->update($validated_request);
        }

        return true;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user_id = Auth::id();

        $category = Category::where([
            'category_id' => $id,
            'user_id' => $user_id
            ])->first();

        if(is_null($category )){
            session()->flash('error', 'category is not found');

            return redirect()->route('category.index');
        }

        $used_in_budget = BudgetCategory::where('category_id', $id)->first();

        if(!is_null($used_in_budget)){
            session()->flash('error', 'can\'t delete category, used in budget');

            return redirect()->route('category.index');
        }

        $used_in_transaction = Transaction::where([
            'user_id' => $user_id,
            'category_id'=> $id
        ])->first();

        if(!is_null($used_in_transaction)){
            session()->flash('error', 'can\'t delete category, used in transaction');

            return redirect()->route('category.index');
        }

        $category->delete();

        session()->flash('success', 'Category Deleted Successfully');

        return redirect()->route('category.index');
    }
}
