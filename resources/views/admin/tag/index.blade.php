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
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $key => $tag)
                        <tr data-id="{{$tag->id}}">
                            <td>{{ ++$key }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>
                                @if($tag->status)
                                    <div class="badge bg-success btnChangeStatus">Aktiv</div>
                                @else
                                    <div class="badge bg-danger btnChangeStatus">Passiv</div>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.tag.update', $tag->id) }}"><i class="text-warning" data-feather="edit" data-toggle="tooltip" data-placement="top" title="Güncəllə"></i></a>
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
                        url: "{{ route('admin.tag.change-status') }}",
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
                title: "Tagi silmək istədiyinizə əminsiniz?",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Bəli",
                cancelButtonText: `Xeyr`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post({
                        url: "{{ route('admin.tag.delete') }}",
                        data: {
                            _method: "DELETE",
                            id: id
                        },
                        success: function (res) {
                            if (res.status) {
                                tr.remove();
                            } else {
                                Swal.fire("Xəta!", "Tag silinmədi!", "success");
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
