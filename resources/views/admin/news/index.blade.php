@extends('layouts.admin')
@section('title', 'Xəbərlər')

@push('css')
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Xəbərlər</h6>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Şəkil</th>
                        <th>Başlıq</th>
                        <th>Kateqoriya</th>
                        <th>Taglar</th>
                        <th>Yayınlanma Tarixi</th>
                        <th>Açığlama</th>
                        <th>Qısa Açığlama</th>
                        <th>Yaradıcı</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($newsAll as $key => $news)
                        @php
                            $strTags = '';
                            $selectedTags = json_decode($news->tags);
                            foreach ($selectedTags as $tag) {
                                if (in_array($tag, $tags)) {
                                    $strTags .= '#'.array_search($tag, $tags).' ';
                                }
                            }
                        @endphp

                        <tr data-id="{{$news->id}}">
                            <td>{{ ++$key }}</td>
                            <td>{{ $news->title }}</td>
                            <td>{{ $news->slug }}</td>
                            <td>{{ $news->getCategory->name }}</td>
                            <td>{{ $strTags }}</td>
                            <td>{{ $news->publish_date }}</td>
                            <td><i class="text-info" data-feather="message-square" data-toggle="tooltip" data-placement="top" title="{{ $news->description }}"></i></td>
                            <td><i class="text-info" data-feather="message-square" data-toggle="tooltip" data-placement="top" title="{{ $news->short_description }}"></i></td>
                            <td><i class="text-black" data-feather="user" data-toggle="tooltip" data-placement="top" title="{{ $news->getUser->name }}"></i></td>
                            <td>
                                @if($news->status)
                                    <div class="badge bg-success btnChangeStatus">Aktiv</div>
                                @else
                                    <div class="badge bg-danger btnChangeStatus">Passiv</div>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.news.update', $news->id) }}"><i class="text-warning" data-feather="edit" data-toggle="tooltip" data-placement="top" title="Güncəllə"></i></a>
                                <a href="javascript:void(0)" class="btnDelete"><i class="text-danger" data-feather="trash" data-toggle="tooltip" data-placement="top" title="Sil"></i></a>
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

        $('.btnChangeStatus').on('click', function () {
            let element = $(this);
            let id = $(this).closest('tr').data('id');
            Swal.fire({
                title: "Statusu dəyişmək istədiyinizə əminsiniz?",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Bəli",
                cancelButtonText: `Xeyr`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post({
                        url: "{{ route('admin.news.change-status') }}",
                        data: {
                            _method: "PATCH",
                            id: id
                        },
                        success: function (res) {
                            if (res.status) {
                                element.addClass('bg-success');
                                element.removeClass('bg-danger');
                            } else {
                                element.addClass('bg-danger');
                                element.removeClass('bg-success');
                            }
                            element.html(res.status ? 'Aktiv' : 'Passiv');
                            Swal.fire("Təbriklər!", res.message, "success");
                        },
                        error: function () {
                            console.log('Ajax error!');
                        }
                    });
                }
            });
        });

        $('.btnDelete').on('click', function () {
            let element = $(this);
            let tr = $(this).closest('tr');
            let id = tr.data('id');
            Swal.fire({
                title: "Xəbəri silmək istədiyinizə əminsiniz?",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Bəli",
                cancelButtonText: `Xeyr`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post({
                        url: "{{ route('admin.news.delete') }}",
                        data: {
                            _method: "DELETE",
                            id: id
                        },
                        success: function (res) {
                            if (res.status) {
                                tr.remove();
                            } else {
                                Swal.fire("Xəta!", "Xəbər silinmədi!", "success");
                            }
                            element.html(res.status ? 'Aktiv' : 'Passiv');
                            Swal.fire("Təbriklər!", res.message, "success");
                        },
                        error: function () {
                            console.log('Ajax error!');
                        }
                    });
                }
            });
        });
    </script>
@endpush
