<div class="row justify-content-center">
    <div class="col-md-8 mb-3">
        <div class="card">
            <div class="card-header">
                <h5 class="strip card-title">Detail Pesanan</h5>
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
                            <td class="ps-0 pb-0 border-0 text-end">{{ $invoice->institutional_origin }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 pb-0 border-0">Whatsapp</th>
                            <td class="ps-0 pb-0 border-0 text-end">{{ $invoice->whatsapp }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 pb-0 border-0">Atas Nama Dan Pembayaran</th>
                            <td class="ps-0 pb-0 border-0 text-end">{{ $invoice->pay_sender }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 pb-0 border-0">Keterangan</th>
                            <td class="ps-0 pb-0 border-0 text-end">Menunggu Pembayaran</td>
                        </tr>
                        <tr>
                            <th class="ps-0 pb-0 border-0">Total</th>
                            <td class="ps-0 pb-0 border-0 text-end fw-800 text-primary">Rp 148.924 <i class="fa fa-copy ms-1" onclick="salin('148924', 'Total berhasil disalin');"></i> </td>
                        </tr>
                    </table>
                    <div class="my-3">
                        <div class="d-flex justify-content-center">
                            <img src="{{ qrImage(route('guest.seminar.invoiceGET', $invoice->invoice), 250) }}" alt="" class="d-flex justify-content-center">
                        </div>
                        <p class="d-flex justify-content-center my-2">
                            <a href="{{ qrImage(route('guest.seminar.invoiceGET', $invoice->invoice)) }}" class="btn btn-primary" target="_blank"> Download</a>
                        </p>
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-700 mb-1">Cara Pembayaran : </h6>
                        <p class="mb-0">Silahkan melakukan transfer ke rekening dibawah ini</p>
                        <ul>
                            <li>No. Rekening : 8215313596 </li>
                            <li>Atas Nama : M. BIMO PRASETYO</li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-700 mb-1">Instruksi Pembayaran :</h6>
                        <p>Harap konfirmasi admin via whatsapp</p>
                        <ul>
                            <li><a href="https://wa.me/6281923824" target="_blank"><i class="mdi mdi-whatsapp"></i> Danang</a></li>
                        </ul>
                    </div>

                    {{-- <p class="text-muted fs-12 mt-4 text-center">Terimakasih telah melakukan pembelian di Pi Topup,
                        untuk
                        pertanyaan, kritik atau saran bisa di sampaikan langsung melalui halaman Kontak Kami</p> --}}
                    <div class="d-none-print text-center">
                        <button class="btn btn-primary" type="button" onclick="window.print();"><i class="mdi mdi-file me-2"></i> Cetak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
