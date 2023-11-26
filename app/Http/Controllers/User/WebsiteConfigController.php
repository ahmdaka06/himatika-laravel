<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WebsiteConfig;
use Illuminate\Http\Request;

class WebsiteConfigController extends Controller
{
    public function index()
    {
        $components = [
            'page' => [
                'title' => 'Website Config',
            ]
            ];
        return view('user.website-config.index', $components);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        if ($request->pamflet_primary) {
			$pamflet_primary = $request->file('pamflet_primary');
            $input['primary']['pamflet_primary'] = md5(time()) . '_' . $pamflet_primary->getClientOriginalName();
            if (isset(getConfig('primary')->pamflet_primary) AND file_exists(public_path('storage/pamflet/' . getConfig('primary')->pamflet_primary))) {
                unlink(public_path('storage/pamflet/' .getConfig('primary')->pamflet_primary));
            }
            $pamflet_primary->move(public_path('storage/pamflet/'), $input['primary']['pamflet_primary']);
		}

        WebsiteConfig::updateOrCreate(['key' => 'primary'], ['value' => $input['primary']]);

        return response()->json([
            'status' => true,
            'type' => 'alert',
            'msg' => 'Update berhasil !.',
            'redirect_url' => route('user.website-config.indexGET'),
        ]);
    }
}
