<?php

namespace App\Http\Controllers;

use App\Models\ContentPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ContentPostController extends Controller
{
    private function featuredImageDirectoryForType(string $type): string
    {
        return Str::lower($type) === 'blog'
            ? 'images/Blog'
            : 'images/News';
    }

    public function index(Request $request): View
    {
        $selectedPost = null;

        if ($request->filled('post')) {
            $selectedPost = ContentPost::query()
                ->published()
                ->where('slug', (string) $request->query('post'))
                ->first();
        }

        $blogPosts = ContentPost::query()
            ->published()
            ->ofType('blog')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        $newsPosts = ContentPost::query()
            ->published()
            ->ofType('news')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        return view('blogs-dynamic', [
            'blogPosts' => $blogPosts,
            'newsPosts' => $newsPosts,
            'selectedPost' => $selectedPost,
        ]);
    }

    public function show(ContentPost $contentPost): View
    {
        if (Schema::hasColumn($contentPost->getTable(), 'is_published') && !$contentPost->is_published) {
            abort(404);
        }

        $blogPosts = ContentPost::query()
            ->published()
            ->ofType('blog')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        $newsPosts = ContentPost::query()
            ->published()
            ->ofType('news')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        return view('blogs-dynamic', [
            'blogPosts' => $blogPosts,
            'newsPosts' => $newsPosts,
            'selectedPost' => $contentPost,
        ]);
    }

    public function adminIndex(Request $request): View
    {
        abort_unless(auth()->check() && auth()->user()->hasAdminPermission('manage_content'), 403);

        $defaultType = Str::lower((string) $request->query('type', 'blog'));
        if (!in_array($defaultType, ['blog', 'news'], true)) {
            $defaultType = 'blog';
        }

        $posts = ContentPost::query()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get();

        return view('admin-content-posts', [
            'posts' => $posts,
            'defaultType' => $defaultType,
            'editingPost' => $request->filled('edit')
                ? ContentPost::query()->where('slug', (string) $request->query('edit'))->first()
                : null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(auth()->check() && auth()->user()->hasAdminPermission('manage_content'), 403);

        $validated = $request->validate([
            'type' => ['required', 'in:blog,news'],
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string', 'max:50000'],
            'category' => ['nullable', 'string', 'max:100'],
            'author_name' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date', 'before_or_equal:today'],
            'is_published' => ['nullable', 'boolean'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $type = Str::lower($validated['type']);
            $relativeDirectory = $this->featuredImageDirectoryForType($type);
            $directory = public_path($relativeDirectory);
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $file = $request->file('featured_image');
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move($directory, $filename);
            $featuredImagePath = $relativeDirectory . '/' . $filename;
        }

        $contentData = [
            'admin_id' => auth()->id(),
            'type' => Str::lower($validated['type']),
            'title' => $validated['title'],
            'slug' => $this->makeUniqueSlug($validated['title']),
            'excerpt' => $validated['excerpt'] ?: null,
            'content' => $validated['content'],
            'featured_image' => $featuredImagePath,
            'category' => $validated['category'] ?: null,
            'author_name' => $validated['author_name'] ?: 'Admin',
        ];

        if (Schema::hasColumn((new ContentPost())->getTable(), 'published_at')) {
            $isPublished = (bool) ($validated['is_published'] ?? true);
            $contentData['published_at'] = $isPublished
                ? ($validated['published_at'] ?: today())
                : null;
        }

        if (Schema::hasColumn((new ContentPost())->getTable(), 'is_published')) {
            $contentData['is_published'] = (bool) ($validated['is_published'] ?? true);
        }

        ContentPost::create($contentData);

        return redirect()
            ->route('admin.content-posts', ['type' => $validated['type']])
            ->with('content_post_success', 'Content saved successfully.');
    }

    public function update(Request $request, ContentPost $contentPost): RedirectResponse
    {
        abort_unless(auth()->check() && auth()->user()->hasAdminPermission('manage_content'), 403);

        $validated = $request->validate([
            'type' => ['required', 'in:blog,news'],
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string', 'max:50000'],
            'category' => ['nullable', 'string', 'max:100'],
            'author_name' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date', 'before_or_equal:today'],
            'is_published' => ['nullable', 'boolean'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        if ($request->hasFile('featured_image')) {
            $type = Str::lower($validated['type']);
            $relativeDirectory = $this->featuredImageDirectoryForType($type);
            $directory = public_path($relativeDirectory);
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $file = $request->file('featured_image');
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move($directory, $filename);
            $contentPost->featured_image = $relativeDirectory . '/' . $filename;
        }

        $contentPost->fill([
            'type' => Str::lower($validated['type']),
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'] ?: null,
            'content' => $validated['content'],
            'category' => $validated['category'] ?: null,
            'author_name' => $validated['author_name'] ?: 'Admin',
        ]);

        if (Schema::hasColumn($contentPost->getTable(), 'published_at')) {
            $isPublished = (bool) ($validated['is_published'] ?? ($contentPost->published_at !== null));
            $contentPost->published_at = $isPublished
                ? ($validated['published_at'] ?: $contentPost->published_at ?: today())
                : null;
        }

        if (Schema::hasColumn($contentPost->getTable(), 'is_published')) {
            $contentPost->is_published = (bool) ($validated['is_published'] ?? $contentPost->is_published);
        }

        $contentPost->slug = $this->makeUniqueSlug($validated['title'], $contentPost->getKey());
        if (!$contentPost->admin_id) {
            $contentPost->admin_id = auth()->id();
        }
        $contentPost->save();

        return redirect()
            ->route('admin.content-posts', ['type' => $contentPost->type, 'edit' => $contentPost->slug])
            ->with('content_post_success', 'Content updated successfully.');
    }

    public function destroy(Request $request, string $contentPost): RedirectResponse
    {
        abort_unless(auth()->check() && auth()->user()->hasAdminPermission('manage_content'), 403);

        $contentPost = ContentPost::query()
            ->where('slug', $contentPost)
            ->when(is_numeric($contentPost), function ($query) use ($contentPost) {
                $query->orWhereKey((int) $contentPost);
            })
            ->firstOrFail();

        $type = $contentPost->type;
        $contentPost->delete();

        return back()
            ->with('content_post_success', 'Content deleted successfully.');
    }

    private function makeUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: 'content-post';
        $slug = $baseSlug;
        $index = 2;

        while (
            ContentPost::query()
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $index;
            $index++;
        }

        return $slug;
    }
}
