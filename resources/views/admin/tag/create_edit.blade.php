@extends('layouts.admin')
@section('title', 'Tag ' . (isset($tag) ? 'güncəllə' : 'əlavə et' ))

@push('css')
@endpush

@section('content')
    <div class="card">
        <div class="card-body">

            <h6 class="card-title">Tag {{ isset($tag) ? 'güncəllə' : 'əlavə et' }}</h6>

            <form class="forms-sample" id="formCategory" action="{{ isset($tag) ? route('admin.tag.update', $tag->id) : route('admin.tag.create') }}" method="POST">
                @csrf
                @isset($tag)
                    @method('PATCH')
                @endisset
                <div class="mb-3">
                    <label for="name" class="form-label">Kateqoriya Adı</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" autocomplete="off" placeholder="Kateqoriya Adı" value="{{ isset($tag) ? $tag->name : old('name') }}">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="checkbox" class="form-check-input" name="status" id="status" {{ isset($tag) ? ($tag->status ? 'checked' : '') : (old('status') ? 'checked' : '') }}>
                    <label for="status" class="form-check-label"> Aktiv olsun?</label>
                </div>
                <button type="submit" class="btn btn-primary me-2" id="btnSubmit">@isset($tag) Güncəllə @else Əlavə Et @endisset</button>
            </form>

        </div>
    </div>
@endsection

@push('js')
@endpush
