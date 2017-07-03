<?php
namespace App\Views\Composers;

use Illuminate\View\View;
use App\Category;
use App\Post;
use App\Tag;

class NavigationComposer
{
    public function compose(View $view)
    {
        $this->composeCategories($view);

        $this->composePopularPosts($view);

        $this->composePopularTags($view);
    }

    private function composeCategories(View $view)
    {
        $categories = Category::with(['posts' => function($query) {
            $query->published();
        }])->orderBy('title', 'asc')->get();

        $view->with('categories', $categories);
    }

    private function composePopularPosts(View $view)
    {
        $popularPosts = Post::published()->popular()->take(3)->get();
        $view->with('popularPosts', $popularPosts);
    }

    private function composePopularTags(View $view)
    {
        $popularTags = Tag::with('posts')->popular()->take(5)->get();
        $view->with('popularTags', $popularTags);
    }
}