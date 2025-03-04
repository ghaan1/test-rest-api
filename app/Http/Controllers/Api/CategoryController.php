<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\RequestCategory;
use App\Http\Requests\Category\RequestCategoryIndex;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\ResourceCategory;
use App\Http\Resources\ResourcePagination;
use App\Http\Services\ServiceCategory;
use App\Models\Category;
use App\Traits\BaseApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{

    use BaseApiResponse;

    protected $serviceCategory;

    public function __construct(ServiceCategory $serviceCategory)
    {
        $this->serviceCategory = $serviceCategory;
    }

    /**
     * Function to get all categories
     */
    public function index(RequestCategoryIndex $request): JsonResponse
    {
        try {
            $search = $request->input('search', '');
            $column_order = $request->query('column_order', 'name_category');
            $order = $request->query('order', 'asc');
            $perPage = $request->query('per_page', 10);

            $categories = $this->serviceCategory->getAllCategories($search, $column_order, $order, $perPage);

            if ($categories->isEmpty()) {
                return $this->apiSuccessPagination(
                    Response::HTTP_NOT_FOUND,
                    'Daftar kategori berhasil diambil.',
                    ResourceCategory::collection($categories),
                    new ResourcePagination($categories),
                    'NOT_FOUND'
                );
            }

            return $this->apiSuccessPagination(
                Response::HTTP_OK,
                'Daftar kategori berhasil diambil.',
                ResourceCategory::collection($categories),
                new ResourcePagination($categories),
                'OK'
            );
        } catch (\Exception $e) {
            Log::critical('Error fetching category: ', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return $this->apiError(Response::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan pada server.', [], 'INTERNAL_SERVER_ERROR');
        }
    }

    /**
     * Function to create a new category
     */
    public function store(RequestCategory $request)
    {
        $data = $request->validated();
        try {
            $category = $this->serviceCategory->createCategory($data);

            if ($category) {
                return $this->apiSuccess(Response::HTTP_CREATED, 'Kategori berhasil ditambahkan.', [], 'CREATED');
            }

            return $this->apiFail(Response::HTTP_BAD_REQUEST, 'Kategori gagal ditambahkan.', [], 'BAD_REQUEST');
        } catch (\Exception $e) {
            Log::critical('Error creating category: ', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return $this->apiError(Response::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan pada server.', [], 'INTERNAL_SERVER_ERROR');
        }
    }


    /**
     * Function to update a category
     */
    public function update(RequestCategory $request, $id)
    {
        $data = $request->validated();
        try {
            $category = $this->serviceCategory->updateCategory($data, $id);

            if ($category) {
                return $this->apiSuccess(Response::HTTP_OK, 'Kategori berhasil diubah.', [], 'OK');
            } else {
                return $this->apiFail(Response::HTTP_NOT_FOUND, 'Kategori gagal ditemukan.', [], 'NOT_FOUND');
            }

            return $this->apiFail(Response::HTTP_BAD_REQUEST, 'Kategori gagal diubah.', [], 'BAD_REQUEST');
        } catch (\Exception $e) {
            Log::critical('Error updating category: ', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $category = $this->serviceCategory->deleteCategory($id);

            if ($category) {
                return $this->apiSuccess(Response::HTTP_OK, 'Kategori berhasil dihapus.', [], 'OK');
            }
        } catch (\Exception $e) {
            Log::critical('Error deleting category: ', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return $this->apiFail(Response::HTTP_BAD_REQUEST, 'Kategori gagal dihapus.', [], 'BAD_REQUEST');
        }
    }
}