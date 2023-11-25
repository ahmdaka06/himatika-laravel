<?php

namespace App\Http\Controllers\Guest\Seminar;

use App\Http\Controllers\Controller;
use App\Models\Participants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index() {
        $components = [
            'page' => [
                'title' => 'Seminar Registration',
                'subtitle' => 'Register for our seminar'
            ]
        ];
        return view('guest.seminar.register', $components);
    }

    public function store(Request $request) {
        $validators = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'institutional_origin' => 'required',
            'whatsapp' => 'required',
            'pay_sender' => 'required',
            'pay_proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'follow_proof' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'recom_by' => 'nullable',
        ], [], [
            'name' => 'Name',
            'email' => 'Email',
            'institutional_origin' => 'Asal Institusi',
            'whatsapp' => 'Whatsapp',
            'pay_sender' => 'Atas Nama Pengirim dan Pembayaran',
            'pay_proof' => 'Bukti Pembayaran',
            'follow_proof' => 'Bukti Follow Sosial Media',
            'recom_by' => 'Rekomendasi dari',
        ]);

        if ($validators->fails()) {
            return response()->json([
				'status'  => false,
				'type'    => 'validation',
				'msg' => $validators->errors()->toArray()
			]);
        }

        $pay_proof = $request->file('pay_proof');
        $pay_proof_name = time() . '_' . $pay_proof->getClientOriginalName();
        $pay_proof->move(public_path('storage/seminar/pay_proof'), $pay_proof_name);

        if ($request->hasFile('follow_proof')) {
            $follow_proof = $request->file('follow_proof');
            $follow_proof_name = time() . '_' . $follow_proof->getClientOriginalName();
            $follow_proof->move(public_path('storage/seminar/follow_proof'), $follow_proof_name);
        }

        $invoice = 'INV-' . time();

        $data = [
            'invoice' => $invoice,
            'name' => $request->name,
            'email' => $request->email,
            'institutional_origin' => $request->institutional_origin,
            'whatsapp' => $request->whatsapp,
            'pay_sender' => $request->pay_sender,
            'pay_proof' => $pay_proof_name,
            'follow_proof' => $follow_proof_name ?? null,
            'recom_by' => $request->recom_by,
        ];

        Participants::create($data);

        return response()->json([
            'status' => true,
            'type' => 'alert',
            'msg' => 'Pendaftaran peserta berhasil di lakukan !.'
        ]);

    }

    public function invoiceGET($invoice = null) {
        $components = [
            'page' => [
                'title' => 'Cari Faktur',
                'subtitle' => 'Invoice for our seminar'
            ]
        ];
        $invoice = Participants::where('invoice', $invoice)->first();
        if ($invoice) $components['invoice'] = $invoice;
        return view('guest.seminar.invoice', $components);
    }

    public function invoicePOST(Request $request) {
        $invoice = $request->invoice;
        $participant = Participants::where('invoice', $invoice)->first();

        if ($participant == null) return response()->json([
            'status' => false,
            'type' => 'alert',
            'msg' => 'Faktur tidak ditemukan !.',
        ]);
        return response()->json([
            'status' => true,
            'type' => 'alert',
            'msg' => 'Faktur ditemukan !.',
            'redirect_url' => route('guest.seminar.invoiceGET', $invoice),
        ]);
    }
}
