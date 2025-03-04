<?php

namespace App\Http\Services;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceBook
{

    public function getAllBooks($search, $column_order, $order, $perPage)
    {
        $book = DB::table('books')
            ->leftJoin('categories', 'books.fk_category', '=', 'categories.id')
            ->select('id', 'title', 'author', 'total_books', 'total_borrow', 'total_book_available', 'fk_category');

        if ($search) {
            $book->where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('total_books', 'like', '%' . $search . '%')
                ->orWhere('total_borrow', 'like', '%' . $search . '%')
                ->orWhere('total_book_available', 'like', '%' . $search . '%');
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