<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {

        $posts = Post::orderBy('id', 'desc')->paginate(3);

        foreach($posts as $k => $v) {
            $posts[$k]['cover'] = asset('storage/'.$v['cover']);
        }

        return view('home', [
            'posts' => $posts,
            'title' => 'Posts - Listagem de post'
        ]);
    }
}
