<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::query()
            ->with('user')
            ->when(request()->get('q'), function ($query) {
                $query
                    ->where('title', 'like', '%' . request()->get('q') . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(20);
        $components = [
            'page' => [
                'title' => 'News',
                'subtitle' => 'News'
            ],
            'news' => [
                'data' => $news,
            ]
        ];
        return view('user.news.index', $components);
    }

    public function formGET(News $news)
    {
        $components = [
            'page' => [
                'title' => 'Formulir News',
                'subtitle' => 'Formulir News'
            ],
            'news' => $news
        ];
        return view('user.news.form', $components);
    }

    public function formPOST(Request $request, News $news)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ]);

        if ($validator->fails()) {
            return [
                'status' => false,
                'type' => 'validation',
                'msg' => $validator->errors()->toArray()
            ];
        }

        $input = [
            'user_id' => auth()->id(),
            'title' => $request->title,
            'slug' => makeSlug($request->title),
            'content' => $request->content,
        ];

        if ($request->image) {
            $image = $request->file('image');
            $input['image'] = md5(time()) . '_' . $image->getClientOriginalName();
            if ($news->id AND file_exists(public_path('storage/news/' . $news->image))) {
                unlink(public_path('storage/news/' . $news->image));
            }
            $image->move(public_path('storage/news'), $input['image']);
        }

        if ($news->id) {
            $news->update($input);
        } else {
            $news = News::create($input);
        }

        return [
            'status' => true,
            'type' => 'store',
            'msg' => 'Berita berhasil di simpan!.',
            'redirect_url' => route('user.news.index')
        ];


    }

    public function detail()
    {
        $components = [
            'page' => [
                'title' => 'Detail News',
                'subtitle' => 'Detail News'
            ],
        ];
        return view('user.news.detail', $components);
    }
}
