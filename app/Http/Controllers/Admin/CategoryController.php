<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create_edit');
    }

    public function store(CategoryStoreRequest $request)
    {
        $data = $request->only('name', 'slug', 'description');
        $data['slug'] = Str::slug($data['slug']);

        if (!$request->slug)
        {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['status'] = $request->has('status');

        Category::query()->create($data);

        alert()->success('Təbriklər!','Kateqoriya yaradıldı!');
        return redirect()->route('admin.category.index');
    }

    public function edit(Category $category)
    {
        return view('admin.category.create_edit', compact('category'));
    }

    public function update(Category $category, CategoryUpdateRequest $request)
    {
        $data = $request->only('name', 'slug', 'description');
        $data['slug'] = Str::slug($data['slug']);

        if (!$request->slug)
        {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['status'] = $request->has('status');

        $category->update($data);

        alert()->success('Təbriklər!','Kateqoriya güncəlləndi!');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $category = Category::query()->find($id);

        if (!$category)
        {
            return response([
                'message' => 'Kateqoriya tapılmadı!'
            ], 404);
        }

        $delete = $category->delete();

        return response([
            'message' => 'Kateqoriya silindi!',
            'status' => $delete
        ], 200);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $category = Category::query()->find($id);

        if (!$category)
        {
            return response([
                'message' => 'Kateqoriya tapılmadı!'
            ], 404);
        }

        $category->update(['status' => !$category->status]);

        return response([
            'message' => 'Status dəyişdirildi!',
            'status' => $category->status
        ], 200);
    }
}
