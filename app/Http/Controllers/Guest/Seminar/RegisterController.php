<?php

namespace App\Http\Controllers\Guest\Seminar;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index() {
        if (request()->ajax() AND request()->isMethod('get') AND request()->__m == '__searchInstitutional') {
            return [
                ['id' => '071023', 'text' => '071023 - Universitas Darul Ulum Jombang'],
                ['id' => '2', 'text' => '2 - Lainnya'],
            ];
        }
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
            // 'sid_number' => 'required|numeric',
            'institutional_origin' => 'required',
            'institutional_name' => request()->institutional_origin == '2' ? 'required' : 'nullable',
            'whatsapp' => 'required|phone_number',
            'payment' => 'required|in:' . arrayToString(config('constants.payments'), 'name'),
            'pay_sender' => 'required',
            'pay_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'recom_by' => 'nullable',
            'attend' => 'required|in:1,2',
        ], [
            'whatsapp.phone_number' => 'Harus diawali dengan 628',
        ], [
            'name' => 'Nama',
            'email' => 'Email',
            'sid_number' => 'NIM',
            'institutional_origin' => 'Asal Institusi',
            'institutional_name' => 'Nama Institusi',
            'whatsapp' => 'Whatsapp',
            'payment' => 'Pembayaran',
            'pay_sender' => 'Nama Pengirim',
            'pay_proof' => 'Bukti Pembayaran',
            'recom_by' => 'Rekomendasi dari',
            'attend' => 'Kehadiran',
        ]);

        if ($validators->fails()) {
            return response()->json([
				'status'  => false,
				'type'    => 'validation',
				'msg' => $validators->errors()->toArray()
			]);
        }

        $input = [
            'invoice' => 'INV-' . time(),
            'name' => $request->name,
            'email' => $request->email,
            // 'sid_number' => $request->sid_number,
            'institutional_origin' => null,
            'whatsapp' => $request->whatsapp,
            // 'payment' => $request->payment,
            'pay_sender' => $request->pay_sender,
            'recom_by' => $request->recom_by,
            'attend' => $request->attend,
        ];


        // if ($request->hasFile('follow_proof')) {
        //     $follow_proof = $request->file('follow_proof');
        //     $follow_proof_name = time() . '_' . $follow_proof->getClientOriginalName();
        //     $follow_proof->move(public_path('storage/seminar/follow_proof'), $follow_proof_name);
        // }

        DB::beginTransaction();

        try {
            if ($request->hasFile('pay_proof')) {
                $pay_proof = $request->file('pay_proof');
                $input['pay_proof'] = md5(time()) . '_' . $pay_proof->getClientOriginalName();
                $pay_proof->move(public_path('storage/seminar/pay_proof'), $input['pay_proof']);
            }

            $institutional_origin['npsn'] = $request->institutional_origin;
            $institutional_origin['name'] = arrayValueSearch(config('constants.universities'), 'id', $request->institutional_origin)['name'];
            if ($request->institutional_origin == '2') {
                $institutional_origin['name'] = $request->institutional_name;
            }
            $input['institutional_origin'] = $institutional_origin;

            $payment['name'] = $request->payment;
            $payment['account'] = arrayValueSearch(config('constants.payments'), 'name', $request->payment)['account'];
            $payment['holder'] = arrayValueSearch(config('constants.payments'), 'name', $request->payment)['holder'];
            $input['payment'] = $payment;


            if ($input['recom_by'] == 'SEMINARHIMATIKA23') {
                $input['price'] = 10000;
            } else {
                $input['price'] = 15000;
            }

            $invoice = Participant::create($input);

            // Mail::send('mail.guest.seminar', $invoice->toArray(), function ($message) use ($input) {
            //     $message
            //         ->to($input['email'], $input['name'])
            //         ->from(config('mail.from.address'), 'HIMATIKA Universitas Darul Ulum')
            //         ->subject('Pendaftaran Seminar No. Faktur ' . $input['invoice']);
            //     });

            DB::commit();
            return response()->json([
                'status' => true,
                'type' => 'alert',
                'msg' => 'Pendaftaran peserta telah berhasil di lakukan !.',
                'redirect_url' => route('guest.seminar.invoiceGET', $input['invoice']),
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('Error when register seminar: ' . $th->getMessage());
            return response()->json([
                'status' => false,
                'type' => 'alert',
                'msg' => 'Pendaftaran peserta gagal. Harap hubungi admin !.',
            ]);
        }
    }

    public function invoiceGET($invoice = null) {
        $components = [
            'page' => [
                'title' => (request()->segment(3) == null) ? 'Cari Faktur' : 'Faktur ' . request()->segment(3),
                'subtitle' => 'Invoice for our seminar'
            ]
        ];
        $invoice = Participant::where('invoice', $invoice)->first();
        if ($invoice) $components['invoice'] = $invoice;
        return view('guest.seminar.invoice', $components);
    }

    public function invoicePOST(Request $request) {
        $invoice = $request->invoice;
        $participant = Participant::where('invoice', $invoice)->first();

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

    public function uploadPayProofGET() {
        if (!request()->ajax()) return 'Akses di tolak!.';

        $components = [
            'page' => [
                'title' => 'Upload Bukti Pembayaran',
                'subtitle' => 'Upload bukti pembayaran seminar'
            ]
        ];
        return view('guest.seminar.upload_pay_proof', $components);
    }

    public function uploadPayProofPOST(Request $request, Participant $participant) {
        if (!$request->ajax()) return 'Akses di tolak!.';

        $validators = Validator::make($request->all(), [
            'pay_proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ], [], [
            'pay_proof' => 'Bukti Pembayaran',
        ]);

        if ($validators->fails()) {
            return response()->json([
                'status'  => false,
                'type'    => 'validation',
                'msg' => $validators->errors()->toArray()
            ]);
        }

        if ($participant->pay_proof != null) {
           return response()->json([
                'status' => false,
                'type' => 'alert',
                'msg' => 'Bukti pembayaran sudah di upload !.'
            ]);
        }

        if ($request->hasFile('pay_proof')) {
            $pay_proof = $request->file('pay_proof');
            $input['pay_proof'] = md5(time()) . '_' . $pay_proof->getClientOriginalName();
            $pay_proof->move(public_path('storage/seminar/pay_proof'), $input['pay_proof']);
        }

        $participant->update([
            'pay_proof' => $input['pay_proof'],
        ]);

        return response()->json([
            'status' => true,
            'type' => 'alert',
            'msg' => 'Bukti pembayaran berhasil di upload !.',
            'redirect_url' => route('guest.seminar.invoiceGET', $participant->invoice),
        ]);
    }
}
