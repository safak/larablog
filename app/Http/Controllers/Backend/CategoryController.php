<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends BackendController
{
    public function index(){

        $categories = Category::with('posts')
                ->paginate(5);
        return view('admin.category.index', compact('categories'));

    }

    public function store(CategoryStoreRequest $request){

        $data = $request->all();

        count($data['slug']) > 0 ? $data['slug'] = $data['slug'].'-'.time() : NULL;

        $categories = Category::create($data);

        return redirect('admin/category')->with('message', 'Category has benn successfully created!');

    }

    public function edit($id){

        $category = Category::find($id);

        return view('admin.category.edit', compact('category'));

    }

    public function update(Request $request, $id){

        $category = Category::find($id)->update($request->all());

        return redirect('admin/category')->with('message', 'Category has been successfully updated...');

    }

    public function destroy($id){

        $category = Category::find($id);
        if ($category->id == 1)
            return redirect('admin/category')->with('message', 'This category can not be deleted!');
        else {

            $posts = $category->posts;
            $category->delete();

            foreach ($posts as $post){

                $post->categories()->detach($id);

                if ($post->categories->isEmpty())

                    $post->categories()->attach(1);

            }

        }


        return redirect('admin/category')->with('message', 'Category has been succesfully deleted...');

    }
}
