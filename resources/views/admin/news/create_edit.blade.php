@extends('layouts.admin')
@section('title', 'Xəbər ' . (isset($news) ? 'güncəllə' : 'əlavə et' ))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/dropify/dist/dropify.min.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="card-body">

            <h6 class="card-title">Xəbər {{ isset($news) ? 'güncəllə' : 'əlavə et' }}</h6>

            <form class="forms-sample" id="formCategory"
                  action="{{ isset($news) ? route('admin.news.update', $news->id) : route('admin.news.create') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @isset($news)
                    @method('PATCH')
                @endisset
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Xəbər Başlığı</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                   id="title" autocomplete="off" placeholder="Xəbər Başlığı"
                                   value="{{ isset($news) ? $news->title : old('title') }}">
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                                   id="slug" placeholder="Slug" value="{{ isset($news) ? $news->slug : old('slug') }}">
                            @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="description" class="form-label">Açığlama</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                      id="description" placeholder="Açığlama"
                                      rows="5">{{ isset($news) ? $news->description : old('description') }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Qısa Açığlama</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror"
                                      name="short_description" id="short_description" placeholder="Qısa Açığlama"
                                      rows="5">{{ isset($news) ? $news->short_description : old('short_description') }}</textarea>
                            @error('short_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kateqoriya Seçin</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                                    id="category_id">
                                <option selected value="">Kateqoriya seçin</option>
                                @foreach($categories as $category)
                                    <option
                                        {{ isset($news) ? ($news->category_id == $category->id ? 'selected' : '') : (old('category_id') && $category->id == old('category_id') ? 'selected' : '') }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tags" class="form-label">Tag əlavə et</label>
                            <select class="js-example-basic-multiple form-select" name="tags[]" id="tags"
                                    multiple="multiple" data-width="100%">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                    @if(isset($news))
                                        {{ in_array($tag->id, old('tags', $selectedTags) ?: []) ? 'selected' : '' }}
                                        @else
                                        {{ old('tags') && in_array($tag->id, old('tags')) ? 'selected' : '' }}
                                        @endif
                                    >{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tags" class="form-label">Yayınlanma tarixi</label>
                            <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" name="publish_date" id="publish_date" class="form-control"
                                       placeholder="Yayınlanma tarixi seçin" data-input
                                       value="{{ isset($news) ? $news->publish_date : old('publish_date')}}">
                                <span class="input-group-text input-group-addon" data-toggle><i
                                        data-feather="calendar"></i></span>
                            </div>
                            @error('publish_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="checkbox" class="form-check-input" name="status"
                                   id="status" {{ isset($news) ? ($news->status ? 'checked' : '') : (old('status') ? 'checked' : '') }}>
                            <label for="status" class="form-check-label"> Aktiv olsun?</label>
                        </div>
                        @if(isset($news))
                            <div class="col-md-4">
                                <div class="col-md-4">
                                    <img width="200"
                                         src="{{ asset($news->image ?? 'assets/images/img-not-found.jpg') }}" alt="">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tags" class="form-label">Şəkil seçin</label>
                            <input type="file" name="image" id="myDropify">
                        </div>
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary me-2" id="btnSubmit">@isset($news)
                        Güncəllə
                    @else
                        Əlavə Et
                    @endisset</button>
            </form>

        </div>
    </div>
@endsection

@push('js')
    >
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendors/dropify/dist/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endpush
