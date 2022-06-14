<?php
namespace App\Interfaces;

use App\DTO\CategoryDTO;

interface CategoryRepositoryInterface
{
    public function getAllCategories();
    public function getCategoryById(int $categoryId);
    public function deleteCategory(int $categoryId);
    public function createCategory(CategoryDTO $categoryDTO);
    public function updateCategory(CategoryDTO $categoryDTO);
    public function isCategoryExistsByName(string $categoryName);
    public function getCategoryByName(string $categoryName);
}
