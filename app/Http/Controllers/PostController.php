<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function add(Request $request)
    {
        $flash = false;
        if(Session::has('flash')) {
            $flash = Session::get('flash');
            Session::forget('flash');
        }

        return view('postStorage', [
            'page' => 'addPost',
            'post' => false,
            'actionForm' => env('APP_URL') . '/postaddaction',
            'flash' => $flash,
            'title' => 'Posts - Adicionar Post'
        ]);
    }

    public function addAction(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'cover' => 'required|file|mimes:jpg,png',
            'text' => 'required'
        ]);

        if (!$validator->fails()) {

            $file = $request->file('cover')->store('public');
            $file = explode('public/', $file);
            $cover = $file[1];

            Post::create([
                'title' => $request->title,
                'cover' => $cover,
                'text' => $request->text
            ]);
        } else {
            Session::put('flash', $validator->errors()->first());

            return redirect('/postadd');
        }

        return redirect(route('home'));
    }

    public function edit(Request $request)
    {
        $flash = false;
        if(Session::has('flash')) {
            $flash = Session::get('flash');
            Session::forget('flash');
        }

        $item = Post::find($request->id);

        if ($item) {
            $item['cover'] = asset('storage/' . $item['cover']);

            return view('postStorage', [
                'page' => 'editPost',
                'post' => $item,
                'actionForm' => env('APP_URL') . '/posteditaction',
                'flash' => $flash,
                'title' => 'Posts - Editar Post '.$item->title
            ]);
        } else {
            return redirect(route('home'));
        }
    }

    public function editAction(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'text' => 'required'
        ]);

        if (!$validator->fails()) {

            $item = Post::find($request->id);

            if ($item) {
                if ($request->file('cover')) {
                    $file = $request->file('cover')->store('public');
                    $file = explode('public/', $file);
                    $cover = $file[1];
                } else {
                    $cover = $item->cover;
                }

                Post::where('id', $request->id)->update([
                    'title' => $request->title,
                    'cover' => $cover,
                    'text' => $request->text
                ]);
            } else {
                return redirect(route('home'));
            }
        } else {
            Session::put('flash', $validator->errors()->first());

            return redirect('/postedit');
        }

        return redirect(route('home'));
    }

    public function delete(Request $request)
    {

        $item = Post::find($request->id);

        if ($item) {
            $item->delete();
        }

        return redirect(route('home'));
    }
}
