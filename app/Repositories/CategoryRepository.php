<?php

namespace App\Repositories;

use App\DTO\CategoryDTO;
use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function getAllCategories() : Collection
    {
        return Category::all();
    }

    public function getCategoryById(int $categoryId) : Category
    {
        return Category::findOrFail($categoryId);
    }

    public function deleteCategory(int $categoryId) : int
    {
        return Category::destroy($categoryId);
    }

    public function createCategory(CategoryDTO $categoryDTO) : Category
    {
        $category = new Category();
        $category->name = $categoryDTO->name;
        $category->save();
        return $category;
    }

    public function updateCategory(CategoryDTO $categoryDTO) : Category
    {
        $category = $this->getCategoryById($categoryDTO->id);
        $category->name = $categoryDTO->name;
        $category->save();
        return $category;
    }

    public function isCategoryExistsByName(string $categoryName) : bool
    {
        return Category::where("name", $categoryName)->exists();
    }

    public function getCategoryByName(string $categoryName) : Category
    {
        return Category::where("name", $categoryName)->first();
    }
}
