<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $tags = Tag::query()->where('status', 1)->pluck('id', 'name')->toArray();
        $newsAll = News::query()->with(['getUser', 'getCategory'])->paginate(10);
        return view('admin.news.index', compact('newsAll', 'tags'));
    }

    public function create()
    {
        $categories = Category::query()->where('status', 1)->get();
        $tags = Tag::query()->where('status', 1)->get();

        return view('admin.news.create_edit', compact('categories', 'tags'));
    }

    public function store(NewsStoreRequest $request)
    {
        $data = $request->only('title', 'slug', 'category_id', 'description', 'short_description', 'publish_date');
        $data['slug'] = Str::slug($data['slug']);
        $data['user_id'] = Auth::user()->id;

        if (!$request->slug)
        {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['status'] = $request->has('status');
        $data['tags'] = json_encode($request->tags);

        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $title = $data['title'];
            $path = 'assets/images/news/';

            $data['image'] = imgUpload($file, $title, $path);
        }

        try {
            News::query()->create($data);
            alert()->success('Təbriklər!', 'Xəbər yaradıldı!');
            return redirect()->route('admin.news.index');
        } catch (\Exception $e) {
            alert()->error('Xəta!', 'Xəbər yaradılarkən bir səhv baş verdi: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit(News $news)
    {
        $categories = Category::query()->where('status', 1)->get();
        $tags = Tag::query()->where('status', 1)->get();
        $selectedTags = json_decode($news->tags);
        return view('admin.news.create_edit', compact('news', 'categories', 'tags', 'selectedTags'));
    }

    public function update(News $news, NewsUpdateRequest $request)
    {
        $data = $request->only('title', 'slug', 'category_id', 'description', 'short_description', 'publish_date');
        $data['slug'] = Str::slug($data['slug']);
        $data['user_id'] = Auth::user()->id;

        if (!$request->slug)
        {
            $data['slug'] = Str::slug($data['name']);
        }

        $data['status'] = $request->has('status');
        $data['tags'] = json_encode($request->tags);

        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $title = $data['title'];
            $path = 'assets/images/news/';


            if ($news->image && file_exists($news->image))
            {
                unlink($news->image);
            }

            $data['image'] = imgUpload($file, $title, $path);


        } else {
            $data['image'] = $news->image;
        }

        try {
            $news->update($data);
            alert()->success('Təbriklər!', 'Xəbər güncəlləndi!');
            return redirect()->route('admin.news.index');
        } catch (\Exception $e) {
            alert()->error('Xəta!', 'Xəbər güncəllənərkən bir səhv baş verdi: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $news = News::query()->find($id);

        if (!$news)
        {
            return response([
                'message' => 'Xəbər tapılmadı!'
            ], 404);
        }

        if ($news->image && file_exists($news->image))
        {
            unlink($news->image);
        }

        $delete = $news->delete();

        return response([
            'message' => 'Xəbər silindi!',
            'status' => $delete
        ], 200);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $news = News::query()->find($id);

        if (!$news)
        {
            return response([
                'message' => 'Xəbər tapılmadı!'
            ], 404);
        }

        $news->update(['status' => !$news->status]);

        return response([
            'message' => 'Status dəyişdirildi!',
            'status' => $news->status
        ], 200);
    }
}
