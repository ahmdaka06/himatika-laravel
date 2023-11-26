<div class="row justify-content-center">
    <div class="col-md-8 mb-3">
        <div class="card">
            <div class="card-header">
                <h5 class="strip card-title">Detail Peserta</h5>
            </div>
            <div class="card-body">
                <!-- <div class="alert alert-primary text-center">
                    <b class="d-block">Harap segera melakukan pembayaran sebelum</b>
                    <h6 class="mb-0 fw-700 text-danger">26 Nov 2023 2:57:02</h6>
                </div> -->
                <div class="table-responsive">
                    <table class="table mb-4">
                        <tr>
                            <th class="ps-0 pb-0 border-0">Nomor Faktur</th>
                            <td class="ps-0 pb-0 border-0 text-end">{{ $invoice->invoice }} <i class="mdi mdi-copy ms-1"  onclick="salin('PI20231125602947', 'Order ID berhasil disalin');"></i></td>
                        </tr>
                        <tr>
                            <th class="ps-0 pb-0 border-0">Tanggal</th>
                            <td class="ps-0 pb-0 border-0 text-end">{{ format_datetime($invoice->created_at) }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 pb-0 border-0">Nama</th>
                            <td class="ps-0 pb-0 border-0 text-end">{{ $invoice->name }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 pb-0 border-0">Asal Institusi</th>
                            <td class="ps-0 pb-0 border-0 text-end">{{ $invoice->institutional_origin['name'] }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 pb-0 border-0">Whatsapp</th>
                            <td class="ps-0 pb-0 border-0 text-end">{{ $invoice->whatsapp }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 pb-0 border-0">Metode Pembayaran</th>
                            <td class="ps-0 pb-0 border-0 text-end">{{ $invoice->payment['name'] }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 pb-0 border-0">Pembayaran Atas Nama</th>
                            <td class="ps-0 pb-0 border-0 text-end">{{ $invoice->pay_sender }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 pb-0 border-0">Status Keterangan</th>
                            <td class="ps-0 pb-0 border-0 text-end">{!! badgeStatus($invoice->status) !!}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 pb-0 border-0">Total Pembayaran</th>
                            <td class="ps-0 pb-0 border-0 text-end fw-bold">Rp {{ currency($invoice->price) }}</td>
                        </tr>
                    </table>
                    <div class="my-3">
                        <h6 class="fw-700 mb-3 ">*CATATAN : HARAP SIMPAN QRCODE DI BAWAH INI UNTUK VALIDASI DI TEMPAT ACARA (BISA DI SCREENSHOT) </h6>
                        <div class="d-flex justify-content-center">
                            <img src="{{ qrImage(route('guest.seminar.invoiceGET', $invoice->invoice), 250) }}" alt="" class="d-flex justify-content-center">
                        </div>
                        <p class="d-flex justify-content-center my-2">
                            <a href="{{ qrImage(route('guest.seminar.invoiceGET', $invoice->invoice)) }}" class="btn btn-primary d-none-print" target="_blank"> Download</a>
                        </p>
                    </div>
                    <div class="mb-3  d-none-print">
                        <h6 class="fw-700 mb-1">Cara Pembayaran : </h6>
                        <p class="mb-0">Silahkan melakukan transfer ke rekening dibawah ini</p>
                        <ul>
                            <li>Pembayaran : {{ $invoice->payment['name'] }} </li>
                            <li>No. Rekening : {{ $invoice->payment['account'] }} </li>
                            <li>Atas Nama : {{ $invoice->payment['holder'] }} </li>
                        </ul>
                    </div>

                    <div class="mb-3 d-none-print">
                        <h6 class="fw-700 mb-1">Instruksi Pembayaran :</h6>
                        <p>Harap konfirmasi admin via whatsapp</p>
                        <ul>
                            <li class="fw-bold"><a href="https://wa.me/6285335837454" target="_blank" class="btn btn-sm btn-success my-2"><i class="mdi mdi-whatsapp me-2"></i> Danang Setiadi</a></li>
                            <li class="fw-bold"><a href="https://wa.me/6287773201852" target="_blank" class="btn btn-sm btn-success my-2"><i class="mdi mdi-whatsapp me-2"></i> Wahyu ZP</a></li>
                            <li class="fw-bold"><a href="https://wa.me/6283890855208" target="_blank" class="btn btn-sm btn-success my-2"><i class="mdi mdi-whatsapp me-2"></i> Kholid Firman</a></li>
                        </ul>
                    </div>
                    @if ($invoice->pay_proof)
                    <div class="divider d-none-print">
                        <div class="divider-text">
                            <h5 class="mt-2">Bukti Pembayaran</h5>
                        </div>
                    </div>
                    <div class="mb-3  d-none-print">
                        <div class="d-flex justify-content-center">
                            <img src="{{ ($invoice->pay_proof ? url('storage/seminar/pay_proof/'. $invoice->pay_proof) : null) }}"" alt="" height="300px" width="300px">
                        </div>
                    </div>
                    @else
                    <div class="divider d-none-print">
                        <div class="divider-text">
                            <h5 class="mt-2">Upload Bukti Pembayaran</h5>
                        </div>
                    </div>
                    <div class="mb-3  d-none-print">
                        <div class="d-flex justify-content-center">
                            <a href="javascript:;" onclick="modal('Upload Bukti Pembayaran', 'Upload Pembayaran {{ $invoice->invoice }}', '{{ route('guest.seminar.uploadPayProofGET', $invoice->id) }}')" class="badge bg-success badge-md" data-bs-toggle="tooltip" data-placement="top" title="Upload Bukti Pembayaran">
                                <i class="bx bx-upload"></i> Upload bukti pembayaran
                            </a>
                        </div>
                    </div>
                    @endif

                    <p class="text-muted fs-12 mt-4 text-center">Terimakasih telah melakukan pendaftaran seminar di HIMATIKA Universitas Darul Ulum Jombang. Untuk pertanyaan, kritik, atau saran bisa di sampaikan langsung melalui Kontak kami</p>
                    <div class="d-none-print text-center">
                        <button class="btn btn-primary" type="button" onclick="window.print();"><i class="mdi mdi-file me-2"></i> Cetak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
