<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::query()->paginate(10);
        return view('admin.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.create_edit');
    }

    public function store(TagStoreRequest $request)
    {
        $data = $request->only('name');
        $data['status'] = $request->has('status');

        Tag::query()->create($data);

        alert()->success('Təbriklər!','Tag yaradıldı!');
        return redirect()->route('admin.tag.index');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.create_edit', compact('tag'));
    }

    public function update(Tag $tag, TagUpdateRequest $request)
    {
        $data = $request->only('name');
        $data['status'] = $request->has('status');

        $tag->update($data);

        alert()->success('Təbriklər!','Tag güncəlləndi!');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $tag = Tag::query()->find($id);

        if (!$tag)
        {
            return response([
                'message' => 'Tag tapılmadı!'
            ], 404);
        }

        $delete = $tag->delete();

        return response([
            'message' => 'Tag silindi!',
            'status' => $delete
        ], 200);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $tag = Tag::query()->find($id);

        if (!$tag)
        {
            return response([
                'message' => 'Tag tapılmadı!'
            ], 404);
        }

        $tag->update(['status' => !$tag->status]);

        return response([
            'message' => 'Status dəyişdirildi!',
            'status' => $tag->status
        ], 200);
    }
}
