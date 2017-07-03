<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class BlogController extends BackendController
{

    public function index(Request $request){

        $currentUser = Auth::user();

        if (($status = $request->get('status')) && $status == 'published') {

            if ($currentUser->hasPermission('update-others-post')){

                $posts = Post::published()->with('author')
                    ->Latest()
                    ->paginate(8);

            }

            else{

                $posts = $currentUser->posts()
                    ->published()
                    ->Latest()
                    ->paginate(8);

            }

        }
        elseif (($status = $request->get('status')) && $status == 'draft') {

            if ($currentUser->hasPermission('update-others-post')){

                $posts = Post::draft()->with('author')
                    ->Latest()
                    ->paginate(8);

            }

            else{

                $posts = $currentUser->posts()
                    ->draft()
                    ->Latest()
                    ->paginate(8);

            }

        }
        elseif (($status = $request->get('status')) && $status == 'schedule') {

            if ($currentUser->hasPermission('update-others-post')){

                $posts = Post::schedule()->with('author')
                    ->Latest()
                    ->paginate(8);

            }

            else{

                $posts = $currentUser->posts()
                    ->schedule()
                    ->with('author')
                    ->Latest()
                    ->paginate(8);

            }

        }
        elseif (($status = $request->get('status')) && $status == 'trash') {

            if ($currentUser->hasPermission('update-others-post')){

                $posts = Post::onlyTrashed()->with('author')
                    ->Latest()
                    ->paginate(8);

            }

            else{

                $posts = $currentUser->posts()
                    ->onlyTrashed()
                    ->with('author')
                    ->Latest()
                    ->paginate(8);

            }
        }
        elseif ($categoryID = $request->get('categoryId')) {

            if ($currentUser->hasPermission('update-others-post')){

                $category = Category::find($categoryID);
                $posts = $category->posts()
                    ->with('author')
                    ->Latest()
                    ->simplepaginate(8);

            }

        }
        elseif ($tagID = $request->get('tagId')) {

            if ($currentUser->hasPermission('update-others-post')){

                $tag = Tag::find($tagID);
                $posts = $tag->posts()
                    ->with('author')
                    ->Latest()
                    ->simplepaginate(8);

            }
        }
        elseif ($userID = $request->get('userId')) {

            if ($currentUser->hasPermission('update-others-post')){

                $user = User::find($userID);
                $posts = $user->posts()
                    ->with('author')
                    ->Latest()
                    ->simplepaginate(8);

            }
        }
        else {

            if ($currentUser->hasPermission('update-others-post')){

                $posts = Post::with('author')
                    ->Latest()
                    ->paginate(8);

            }

            else{

                $posts = $currentUser->posts()
                    ->with('author')
                    ->Latest()
                    ->paginate(8);

            }
        }

        $statusList = $this->statusList();

        return view('admin.blog.index',compact('posts','status','statusList'));

    }

    public function create(){

        $categories = Category::all();
        return view('admin.blog.create',compact('categories'));

    }

    public function store(Request $request){

        $data = $request->all();

        count($data['slug']) > 0 ? $data['slug'] = $data['slug'].'-'.time() : NULL;

        if ($request->hasFile('img')){

            $dest = storage_path() . '/app/public/media';
            $file = $request->file('img');
            $count = count(glob($dest . '/*' . $file->getClientOriginalName()));
            $client_name = ($count > 0) ? $count . '-' . $file->getClientOriginalName(): $file->getClientOriginalName();

            $data['img'] =  $client_name;

                Storage::putFileAs(
                'public/media', $request->file('img'), $client_name, 'public'
            );

            Image::make($dest . '/' . $client_name)
                ->resize(200,150)
                ->save($dest . '/thumb-' . $client_name );
        }

            $post = $request->user()->posts()->create($data);

            if ($request->category){

                foreach ($request['category'] as $categoryid){
                    $post->categories()->attach($categoryid);
                };
            }
            else
                $post->categories()->attach(1);


        return redirect('admin/blog')->with('message', 'Post has been successfully created...');

    }

    public function edit($id){

        $currentUser = Auth::user();
        $post = Post::find($id);
        $categories = Category::all();

        if ($post->author->id == $currentUser->id || $currentUser->hasPermission('update-others-post'))
            return view('admin.blog.edit', compact('post', 'categories'));
        else
            return redirect()->route('admin.blog.index');

    }

    public function update(Request $request, $id){

        $currentUser = Auth::user();
        $post = Post::find($id);
        $oldImage = $post->img;
        $data = $request->all();

        if ($post->author->id == $currentUser->id || $currentUser->hasPermission('update-others-post')){

            if ($request->hasFile('img')){

                if ($oldImage != $data['img']){

                    $this->removeImage($oldImage);

                }
                $dest = storage_path() . '/app/public/media';
                $file = $request->file('img');
                $count = count(glob($dest . '/*' . $file->getClientOriginalName()));
                $client_name = ($count > 0) ? $count . '-' . $file->getClientOriginalName(): $file->getClientOriginalName();

                $data['img'] =  $client_name;

                Storage::putFileAs(
                    'public/media', $request->file('img'), $client_name, 'public'
                );

                Image::make($dest . '/' . $client_name)
                    ->resize(200,150)
                    ->save($dest . '/thumb-' . $client_name );
            }

            $post->update($data);

            if ($request->category){

                $post->categories()->detach();
                foreach ($request['category'] as $categoryid){

                    $post->categories()->attach($categoryid);
                };
            }
            else
                $post->categories()->attach(1);

            return redirect('admin/blog/'.$id.'/edit')->with('message', 'Post has been successfully updated...');

        }

        else
            return redirect()->route('admin.blog.index');
    }

    public function destroy($id){

        $currentUser = Auth::user();
        $post =Post::where('id',$id)->first();

        if ($post->author->id == $currentUser->id || $currentUser->hasPermission('update-others-post')){

            $post->delete();
            return redirect()->route('admin.blog.index')->with(['message'=> 'Successfully moved to trash!!']);

        }

        else
            return redirect()->route('admin.blog.index');


    }

    public function forcedestroy($id){

        $currentUser = Auth::user();
        $post = Post::withTrashed()->find($id);

        if ($post->author->id == $currentUser->id || $currentUser->hasPermission('update-others-post')){

            $this->removeImage($post->img);
            $post->categories()->detach();
            $post->tags()->detach();
            $post->forceDelete();

            return redirect()->route('admin.blog.index')->with(['message'=> 'Successfully deleted!!']);

        }

        else
            return redirect()->route('admin.blog.index');

    }

    public function restore($id){

        $currentUser = Auth::user();
        $post = Post::withTrashed()->find($id);

        if ($post->author->id == $currentUser->id || $currentUser->hasPermission('update-others-post')){

            $this->removeImage($post->img);
            $post->categories()->detach();
            $post->tags()->detach();
            $post->forceDelete();

            return redirect()->route('admin.blog.index')->with(['message'=> 'Successfully deleted!!']);

        }

        else
            return redirect()->route('admin.blog.index');

    }

    private function removeImage($image){

        if (!empty($image)){

            $imagePath = storage_path() . '/app/public/media/'.$image;
            $thumbPath = storage_path() . '/app/public/media/thumb-'.$image;

            if (file_exists($imagePath)) unlink($imagePath);
            if (file_exists($thumbPath)) unlink($thumbPath);

        }

    }

    private function statusList(){

        $currentUser = Auth::user();

        if ($currentUser->hasPermission('update-others-post')){

            return [

                'all' => Post::count(),
                'published' => Post::published()->count(),
                'draft' => Post::draft()->count(),
                'schedule' => Post::schedule()->count(),
                'trash' => Post::onlyTrashed()->count()
            ];

        }

        else {

            return [

                'all' => $currentUser->posts()->count(),
                'published' => $currentUser->posts()->published()->count(),
                'draft' => $currentUser->posts()->draft()->count(),
                'schedule' => $currentUser->posts()->schedule()->count(),
                'trash' => $currentUser->posts()->onlyTrashed()->count()
            ];

        }
    }
}
