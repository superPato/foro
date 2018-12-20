<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(Category $category = null, Request $request)
    {
        $posts = Post::orderBy('created_at', 'DESC')
            ->scopes($this->getListScopes($category, $request))
            ->paginate();

        $categoryItems = $this->getCategoryItems();

        return view('posts.index', compact('posts', 'category', 'categoryItems'));
    }

    public function show(Post $post, $slug) 
    {
        if ($post->slug != $slug) {
            return redirect($post->url, 301);
        }

        return view('posts.show', compact('post'));
    }

    protected function getCategoryItems()
    {
        return Category::orderBy('name')->get()->map(function ($category) {
            return [
                'title' => $category->name,
                'full_url' => route('posts.index', $category)
            ];
        })->toArray();
    }

    protected function getListScopes(Category $category, Request $request)
    {
        $routeName = $request->route()->getName();

        $scopes = [];

        if ($category->exists) {
            $scopes['category'] = [$category];
        }

        if ($routeName == 'posts.pending') {
            $scopes[] = 'pending';
        }

        if ($routeName == 'posts.completed') {
            $scopes[] = 'completed';
        }
        
        return $scopes;
    }
}
