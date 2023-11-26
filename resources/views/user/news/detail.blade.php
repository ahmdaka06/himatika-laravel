
@if ($action == 'pay_proof')
    <img src="{{ ($participant->pay_proof ? url('storage/seminar/pay_proof/'. $participant->pay_proof) : null) }}" height="500px" width="500px"  alt="">
@elseif($action == 'certificate')
    <img src="{{ ($participant->certificate ? url('storage/seminar/sertif/'. $participant->certificate) : null) }}" alt="">
@else
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th width="50%">No Faktur</th>
            <td>{{ $participant->invoice }}</td>
        </tr>
        <tr>
            <th width="50%">Kode QR</th>
            <td><img src="{{ qrImage(route('guest.seminar.invoiceGET', $participant->invoice), 250) }}" alt=""></td>
        </tr>
        <tr>
			<td align="center" colspan="2">
				<strong>Data Diri</strong>
			</td>
		</tr>
        <tr>
            <th width="50%">NIM</th>
            <td>{{ $participant->sid_number }}</td>
        </tr>
        <tr>
            <th width="50%">Nama Lengkap</th>
            <td>{{ $participant->name }}</td>
        </tr>
        <tr>
            <th width="50%">Email</th>
            <td>{{ $participant->email }}</td>
        </tr>
        <tr>
            <th width="50%">Nomor Whatsapp</th>
            <td>{{ $participant->whatsapp }}</td>
        </tr>
        <tr>
            <th width="50%">Institusi</th>
            <td>{{ $participant->institutional_origin['npsn'] }} - {{ $participant->institutional_origin['name'] }}</td>
        </tr>
        <tr>
			<td align="center" colspan="2">
				<strong>Pembayaran</strong>
			</td>
		</tr>
        <tr>
            <th width="50%">Pengirim Atas Nama</th>
            <td>{{ $participant->pay_sender }}</td>
        </tr>
        <tr>
            <th width="50%">Metode Pembayaran</th>
            <td>{{ $participant->payment['name'] . ' - ' . $participant->payment['account'] . ' - ' . $participant->payment['holder']  }}</td>
        </tr>
        <tr>
            <th width="50%">Harga</th>
            <td>{{ 'Rp ' . currency($participant->price) }}</td>
        </tr>
        <tr>
            <th width="50%">Bukti Pembayaran</th>
            <td>
                <img src="{{ ($participant->pay_proof ? url('storage/seminar/pay_proof/'. $participant->pay_proof) : null) }}" alt="">
            </td>
        </tr>
        <tr>
            <th>Sudah dibayar ?</th>
            <td>{{ ($participant->is_paid == 1) ? 'YA' : 'TIDAK' }}</td>
        </tr>
        <tr>
            <th width="50%">Rekomendasi dari</th>
            <td>{{ $participant->pay_sender }}</td>
        </tr>
        <tr>
			<td align="center" colspan="2">
				<strong>Lainnya</strong>
			</td>
		</tr>
        <tr>
            <th width="50%">Sertifikat</th>
            <td>
                <img src="{{ ($participant->certificate ? url('storage/seminar/sertif/'. $participant->certificate) : null) }}" alt="">
            </td>
        </tr>
        <tr>
            <th width="50%">Status</th>
            <td>{!! badgeStatus($participant->status) !!}</td>
        </tr>
        <tr>
			<th width="50%">DIBUAT</th>
			<td>
				{{ parseCarbon($participant->created_at)->translatedFormat('d F Y - H:i') }}
				({{ parseCarbon($participant->created_at)->diffForHumans() }})
			</td>
		</tr>
		<tr>
			<th width="50%">DIPERBARUI</th>
			<td>
				{{ parseCarbon($participant->updated_at)->translatedFormat('d F Y - H:i') }}
				({{ parseCarbon($participant->updated_at)->diffForHumans() }})
			</td>
		</tr>
    </table>
</div>
@endif
