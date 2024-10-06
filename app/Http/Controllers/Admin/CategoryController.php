<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EntityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontsite\Category\StoreRequest;
use App\Http\Requests\Frontsite\Category\UpdateRequest;
use App\Library\Common\IdGenerator;
use App\Models\Category;

class CategoryController extends Controller
{
    const NUMBER_OF_ITEM_PER_PAGE = 10;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(self::NUMBER_OF_ITEM_PER_PAGE);

        return view('frontsite.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreRequest $request)
    {
        return route('category.index');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $user_id = 1;

        $validated_requests = $request->validated();

        $validated_requests['category_id'] = IdGenerator::generateId(EntityEnum::CATEGORY);

        $validated_requests['user_id'] = $user_id;

        Category::create($validated_requests);

        session()->flash('success', 'Category Created Successfully');

        return true;
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
        $category = Category::where('category_id', $id)->first();

        if(!is_null($category)){
            $category->delete();
        }

        return true;
    }
}
