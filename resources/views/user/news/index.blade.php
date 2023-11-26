@extends('layouts.user.app')
@section('title')
{{ $page['title'] }}
@endsection

@section('content')
<div class="row ">
    <div class="col-lg-12 col-md-12 col-12 mb-4">
        <div class="card">
            <div class="card-header bg-primary py-3">
                <h5 class="card-title  text-white fs-bold my-auto"><i class="tf-icons bx bx-news"></i> Berita</h5>
            </div>
            <div class="card-body">
                <div class="row my-3">
                    <div class="col-md-12">
                        <form class="my-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <input
                                      type="text"
                                      class="form-control"
                                      name="q"
                                      placeholder="Cari berita..."
                                      value="{{ request()->get('q') }}"
                                      aria-describedby="button-addon2" />
                                    <button class="btn btn-primary" type="submit" id="button-addon2"><i class="bx bx-search"></i> Cari</button>
                                  </div>
                            </div>
                        </form>
                        <a href="{{ route('user.news.formGET') }}" class="btn btn-success my-2"><i class="mdi mdi-plus"></i>Tambah Beri</a>
                    </div>
                </div>
                <div class="table-responsive text-nowrap mb-5">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Waktu Dibuat</th>
                                <th>Update Terakhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($news['data'] as $key => $value)
                            <tr>
                                <td>{{ $news['data']->firstItem() + $key }}</td>
                                <td>
                                    {{ $value->title }}
                                </td>
                                <td>
                                    {{ $value->user->name }}
                                </td>
                                <td>
                                    {{ Str::limit(strip_tags($value->content), 100, '...') }}
                                </td>
                                <td>{{ format_datetime($value->created_at) }}</td>
                                <td>{{ format_datetime($value->updated_at) }}</td>
                                <td>
                                    <a href="javascript:;" onclick="modal('detail', '#{{ $value->id }}', '{{ route('user.news.detail', $value->id) }}')" class="badge bg-info badge-md" data-bs-toggle="tooltip" data-placement="top" title="Detail">
                                        <i class="bx bx-search"></i>
                                    </a>
                                    <a href="{{ route('user.news.formGET', $value->id) }}" class="badge bg-warning badge-md" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="bx bx-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $news['data']->links()  }}
            </div>
        </div>
    </div>
</div>
@endsection
