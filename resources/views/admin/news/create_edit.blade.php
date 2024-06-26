@extends('layouts.admin')
@section('title', 'Kateqoriya ' . (isset($category) ? 'güncəllə' : 'əlavə et' ))

@push('css')
@endpush

@section('content')
    <div class="card">
        <div class="card-body">

            <h6 class="card-title">Kateqoriya {{ isset($category) ? 'güncəllə' : 'əlavə et' }}</h6>

            <form class="forms-sample" id="formCategory" action="{{ isset($category) ? route('admin.category.update', $category->id) : route('admin.category.create') }}" method="POST">
                @csrf
                @isset($category)
                    @method('PATCH')
                @endisset
                <div class="mb-3">
                    <label for="name" class="form-label">Kateqoriya Adı</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" autocomplete="off" placeholder="Kateqoriya Adı" value="{{ isset($category) ? $category->name : old('name') }}">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" placeholder="Slug" value="{{ isset($category) ? $category->slug : old('slug') }}">
                    @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Açığlama</label>
                    <textarea class="form-control" name="description" id="description" placeholder="Açığlama" rows="5">{{ isset($category) ? $category->description : old('description') }}</textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="checkbox" class="form-check-input" name="status" id="status" {{ isset($category) ? ($category->status ? 'checked' : '') : (old('status') ? 'checked' : '') }}>
                    <label for="status" class="form-check-label"> Aktiv olsun?</label>
                </div>
                <button type="submit" class="btn btn-primary me-2" id="btnSubmit">@isset($category) Güncəllə @else Əlavə Et @endisset</button>
            </form>

        </div>
    </div>
@endsection

@push('js')
@endpush
