<?php

namespace App\Http\Controllers\Backend;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends BackendController
{
    public function index(){

        $tags = Tag::with('posts')
            ->paginate(5);
        return view('admin.tag.index', compact('tags'));

    }

    public function store(Request $request){

        $data = $request->all();

        count($data['tag']) > 0 ? $data['tag'] = $data['tag'].'-'.time() : NULL;

        $tags = Tag::create($data);

        return redirect('admin/tag')->with('message', 'Tag has benn successfully created!');

    }

    public function edit($id){

        $tag = Tag::find($id);

        return view('admin.tag.edit', compact('tag'));

    }

    public function update(Request $request, $id){

        $tag = Tag::find($id)->update($request->all());

        return redirect('admin/tag')->with('message', 'Tag has been successfully updated...');

    }

    public function destroy($id){

        $tag = Tag::find($id);
        if ($tag->id == 1)
            return redirect('admin/tag')->with('message', 'This tag can not be deleted!');
        else {

            $posts = $tag->posts;
            $tag->delete();

            foreach ($posts as $post){

                $post->categories()->detach($id);

            }

        }


        return redirect('admin/tag')->with('message', 'Tag has been succesfully deleted...');

    }
}