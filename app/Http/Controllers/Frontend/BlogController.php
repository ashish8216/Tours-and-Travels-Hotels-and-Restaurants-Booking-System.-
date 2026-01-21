<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Get featured blog (latest published)
        $featuredBlog = Blog::where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->first();

        // Get other blogs (excluding featured)
        $blogs = Blog::where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function($query) use ($featuredBlog) {
                if ($featuredBlog) {
                    $query->where('id', '!=', $featuredBlog->id);
                }
            })
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('frontend.blog', compact('featuredBlog', 'blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        // Get related blogs (same category or random)
        $relatedBlogs = Blog::where('is_published', true)
            ->where('id', '!=', $blog->id)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('frontend.blog-show', compact('blog', 'relatedBlogs'));
    }
}
