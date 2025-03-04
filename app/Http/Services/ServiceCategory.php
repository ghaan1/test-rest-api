<?php

namespace App\Http\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceCategory
{

    public function getAllCategories($search, $column_order, $order, $perPage)
    {
        $category = DB::table('categories')
            ->select('id', 'name_category');

        if ($search) {
            $category->where('name_category', 'like', '%' . $search . '%');
        }

        if ($column_order) {
            $category->orderBy($column_order, $order);
        }

        return $category->paginate($perPage);
    }

    public function createCategory($data)
    {
        DB::beginTransaction();
        try {
            Category::create($data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating category: ' . $e->getMessage());
            return false;
        }
    }

    public function updateCategory($data, $id)
    {
        DB::beginTransaction();
        try {
            $category = Category::find($id);
            if (!$category) {
                return false;
            }
            $category->update($data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating category: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteCategory($id)
    {
        DB::beginTransaction();
        try {
            $category = Category::find($id);
            $category->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting category: ' . $e->getMessage());
            return false;
        }
    }
}