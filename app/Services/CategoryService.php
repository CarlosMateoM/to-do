<?php 

namespace App\Services;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;

class CategoryService 
{

    public function getCategories() 
    {
        return Category::all();
    }

    public function createCategory(StoreCategoryRequest $request)
    {
        $category = new Category();

        $category->name = $request->input('name');

        $category->save();

        return $category;
    }

    public function deleteCategory(int $id)
    {
        $category = Category::findOrFail($id);

        $category->delete();
    }
}