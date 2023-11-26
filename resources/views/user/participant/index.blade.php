@extends('layouts.user.app')
@section('title')
{{ $page['title'] }}
@endsection

@section('content')
<div class="row ">
    <div class="col-lg-12 col-md-12 col-12 mb-4">
        <div class="card">
            <div class="card-header bg-primary py-3">
                <h5 class="card-title  text-white fs-bold my-auto"><i class="tf-icons bx bx-user"></i> Peserta</h5>
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
                                      placeholder="Cari peserta..."
                                      value="{{ request()->get('q') }}"
                                      aria-describedby="button-addon2" />
                                    <button class="btn btn-primary" type="submit" id="button-addon2"><i class="bx bx-search"></i> Cari</button>
                                  </div>
                            </div>
                        </form>
                        <a href="{{ route('user.participant.formGET') }}" class="btn btn-success my-2"><i class="mdi mdi-plus"></i>Tambah Peserta</a>
                    </div>
                </div>
                <div class="table-responsive text-nowrap mb-5">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No Faktur</th>
                                <th>Nama Lengkap</th>
                                <th>Institusi</th>
                                <th>Rekomendasi dari</th>
                                <th>Waktu Pendaftaran</th>
                                <th>Update Terakhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($participants['data'] as $key => $participant)
                            <tr>
                                <td>{{ $participants['data']->firstItem() + $key }}</td>
                                <td>
                                    {{ $participant->invoice }}
                                </td>
                                <td>
                                    <a href="https://wa.me/{{ $participant->whatsapp }}" target="_blank"><i class="mdi mdi-whatsapp"></i> {{ $participant->name }}</a>
                                </td>
                                <td>{{ $participant->institutional_origin['name'] }}</td>
                                <td>{{ $participant->recom_by }}</td>
                                <td>{{ format_datetime($participant->created_at) }}</td>
                                <td>{{ format_datetime($participant->updated_at) }} | {{ $participant->user->name ?? '-' }}</td>
                                <td>
                                    <a href="javascript:;" onclick="modal('detail', '#{{ $participant->id }}', '{{ route('user.participant.detail', $participant->id) }}')" class="badge bg-info badge-md" data-bs-toggle="tooltip" data-placement="top" title="Detail">
                                        <i class="bx bx-search"></i>
                                    </a>
                                    <a href="{{ route('user.participant.formGET', $participant->id) }}" class="badge bg-warning badge-md" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="bx bx-pencil"></i>
                                    </a>
                                <a href="javascript:;" onclick="modal('detail', '#{{ $participant->id }}', '{{ route('user.participant.detail', $participant->id) }}?action=pay_proof')" class="badge bg-primary badge-md" data-bs-toggle="tooltip" data-placement="top" title="Lihat Bukti Pembayaran">
                                        <i class="bx bx-file"></i>
                                    </a>

                                    <a href="javascript:;" onclick="modal('detail', '#{{ $participant->id }}', '{{ route('user.participant.detail', $participant->id) }}?action=certificate')" class="badge bg-success badge-md" data-bs-toggle="tooltip" data-placement="top" title="Lihat Serfitikat">
                                        <i class="bx bx-credit-card"></i>
                                    </a>



                                </td>
                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $participants['data']->links()  }}
            </div>
        </div>
    </div>
</div>
@endsection
