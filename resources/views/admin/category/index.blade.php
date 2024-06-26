@extends('layouts.admin')
@section('title', 'Kateqoriyalar')

@push('css')
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Kateqoriyalar</h6>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Ad</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td><i class="text-info" data-feather="message-square" data-toggle="tooltip" data-placement="top" title="{{ $category->description }}"></i></td>
                            <td>
                                @if($category->status)
                                    <div class="badge bg-success">Aktiv</div>
                                @else
                                    <div class="badge bg-danger">Passiv</div>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.category.update', $category->id) }}"><i class="text-warning" data-feather="edit" data-toggle="tooltip" data-placement="top" title="Güncəllə"></i></a>
                                <a href="javascript:void(0)"><i class="text-danger" data-feather="trash" data-toggle="tooltip" data-placement="top" title="Sil"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
