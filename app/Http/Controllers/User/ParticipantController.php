<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Participant::query()
            ->with('user')
            ->when(request()->get('q'), function ($query) {
                $query
                    ->where('invoice', 'like', '%' . request()->get('q') . '%')
                    ->orWhere('name', 'like', '%' . request()->get('q') . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(20);
        $components = [
            'page' => [
                'title' => 'Participants',
                'subtitle' => 'Participants'
            ],
            'participants' => [
                'data' => $participants,
            ]
        ];
        return view('user.participant.index', $components);
    }

    public function formGET(Participant $participant)
    {
        $components = [
            'page' => [
                'title' => 'Formulir Peserta',
                'subtitle' => 'Formulir Peserta'
            ],
            'participant' => $participant
        ];
        return view('user.participant.form', $components);
    }

    public function formPOST(Request $request, Participant $participant)
    {
        $validators = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:participants,email,' . $participant->id,
            'institutional_origin' => 'required|in:' . arrayToString(config('constants.universities'), 'id'),
            'institutional_name' => request()->institutional_origin == '2' ? 'required' : 'nullable',
            'whatsapp' => 'required|phone_number',
            'payment' => 'required|in:' . arrayToString(config('constants.payments'), 'name'),
            'pay_sender' => 'required',
            'pay_proof' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'recom_by' => 'nullable',
            'is_paid' => 'required|in:0,1',
            'status' => 'required|in:' . arrayToString(config('constants.statuses'), 'key'),
            'reason' =>  (in_array($request->status, ['rejected', 'failed'])) ? 'required' : 'nullable',
            'certificate' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'attend' => 'required|in:1,2',
        ],  [
            'whatsapp.phone_number' => 'Harus diawali dengan 628',
        ], [
            'name' => 'Nama',
            'email' => 'Email',
            'institutional_origin' => 'Asal Institusi',
            'institutional_name' => 'Nama Institusi',
            'whatsapp' => 'Whatsapp',
            'payment' => 'Pembayaran',
            'pay_sender' => 'Nama Pengirim',
            'pay_proof' => 'Bukti Pembayaran',
            'recom_by' => 'Rekomendasi dari',
            'is_paid' => 'Status Pembayaran',
            'status' => 'Status',
            'reason' => 'Alasan',
            'certificate' => 'Sertifikat',
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
            'sid_number' => $request->sid_number,
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

        if ($request->pay_proof) {
            $pay_proof = $request->file('pay_proof');
            $input['pay_proof'] = md5(time()) . '_' . $pay_proof->getClientOriginalName();
            if ($participant->id AND file_exists(public_path('storage/seminar/pay_proof/' . $participant->pay_proof))) {
                unlink(public_path('storage/seminar/pay_proof/' . $participant->pay_proof));
            }
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


        $input['price'] = 15000;

        $input['is_paid'] = $request->is_paid == '1' ? true : false;
        $input['status'] = $request->status;
        $input['reason'] = $request->reason;
        $input['update_by'] = auth()->user()->id;

        if ($request->certificate) {
            $certificate = $request->file('certificate');
            $input['certificate'] = md5(time()) . '_' . $certificate->getClientOriginalName();
            if ($participant->id AND file_exists(public_path('storage/seminar/sertif/' . $participant->certificate))) {
                unlink(public_path('storage/seminar/sertif/' . $participant->certificate));
            }
            $certificate->move(public_path('storage/seminar/certificate'), $input['certificate']);
        }

        if ($participant->id) {
            $participant->update($input);
        } else {
            $participant = Participant::create($input);
        }

        return response()->json([
            'status' => true,
            'type' => 'alert',
            'msg' => 'Data peserta berhasil di simpan!.',
            'redirect_url' => route('user.participant.index'),
        ]);
    }

    public function detail(Participant $participant)
    {
        $components = [
            'page' => [
                'title' => 'Detail Peserta',
                'subtitle' => 'Detail Peserta'
            ],
            'participant' => $participant,
            'action' => request()->action
        ];

        return view('user.participant.detail', $components);
    }

    public function mostRecommendations()
    {
        $participants = Participant::query()
            ->selectRaw('count(*) as total, recom_by')
            ->groupBy('recom_by')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();
        $components = [
            'page' => [
                'title' => 'Peserta Terbanyak Rekomendasi',
                'subtitle' => 'Peserta Terbanyak Rekomendasi'
            ],
            'participants' => [
                'data' => $participants,
            ]
        ];
        return view('user.participant.most-recommendations', $components);
    }
}
