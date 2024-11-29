<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
{
    $posts = Post::all();
    $categories = Category::all();
    return Inertia::render('Post/Index', ['posts' => $posts, 'categories' => $categories]);
}

}
