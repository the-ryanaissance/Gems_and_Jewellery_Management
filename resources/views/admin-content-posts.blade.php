<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Management | Pinwntha Gems</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg:#f5efe6;
            --panel:#fffaf4;
            --panel-strong:#ffffff;
            --line:#eadac2;
            --line-strong:#dec89f;
            --text:#2f2419;
            --muted:#75604d;
            --gold:#b98945;
            --gold-dark:#9b6d32;
            --green:#214841;
            --green-2:#2f6f65;
            --shadow:0 18px 42px rgba(65,45,23,.09);
        }
        *{box-sizing:border-box}
        body{
            margin:0;
            font-family:"Manrope",sans-serif;
            color:var(--text);
            background:
                radial-gradient(circle at top left, rgba(185,137,69,.12), transparent 26%),
                radial-gradient(circle at top right, rgba(47,111,101,.10), transparent 24%),
                linear-gradient(180deg,#fcf8f1, var(--bg));
        }
        a{text-decoration:none;color:inherit}
        .page{max-width:1320px;margin:0 auto;padding:28px 20px 56px}
        .hero{
            padding:30px;
            border-radius:30px;
            border:1px solid rgba(185,137,69,.16);
            background:
                radial-gradient(circle at top right, rgba(47,111,101,.16), transparent 30%),
                linear-gradient(135deg, rgba(255,250,245,.98), rgba(250,240,224,.96));
            box-shadow:var(--shadow);
            display:flex;
            flex-wrap:wrap;
            justify-content:space-between;
            gap:18px;
            align-items:flex-start;
        }
        .eyebrow{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:7px 12px;
            border-radius:999px;
            background:#fff7eb;
            border:1px solid #efd7b0;
            color:var(--gold-dark);
            font-size:.78rem;
            font-weight:800;
            letter-spacing:.12em;
            text-transform:uppercase;
        }
        .hero h1{
            margin:14px 0 10px;
            font-family:"Cormorant Garamond",serif;
            font-size:clamp(2.4rem,4vw,4rem);
            line-height:.94;
            letter-spacing:-.02em;
        }
        .hero p{
            margin:0;
            max-width:860px;
            color:var(--muted);
            line-height:1.75;
            font-size:1rem;
        }
        .hero-actions{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
        }
        .btn,.btn-soft,.chip{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            min-height:44px;
            padding:0 16px;
            border-radius:14px;
            font:inherit;
            font-weight:800;
            border:1px solid transparent;
            cursor:pointer;
        }
        .btn{
            background:linear-gradient(135deg,var(--gold),var(--gold-dark));
            color:#fff;
            box-shadow:0 12px 24px rgba(185,137,69,.18);
        }
        .btn-soft{
            background:#fff;
            border-color:var(--line);
            color:#5b452f;
        }
        .layout{
            margin-top:22px;
            display:grid;
            grid-template-columns:minmax(0, 1fr);
            gap:20px;
            align-items:start;
        }
        .panel{
            background:var(--panel);
            border:1px solid rgba(185,137,69,.16);
            border-radius:28px;
            box-shadow:var(--shadow);
            overflow:hidden;
        }
        .panel-head{
            padding:22px 22px 0;
        }
        .panel-head h2{
            margin:0;
            font-family:"Cormorant Garamond",serif;
            font-size:2rem;
        }
        .panel-head p{
            margin:8px 0 0;
            color:var(--muted);
            line-height:1.7;
        }
        .stats{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:12px;
            padding:18px 22px 0;
        }
        .stat{
            padding:16px;
            border-radius:18px;
            background:#fff;
            border:1px solid #efdfca;
        }
        .stat span{
            display:block;
            color:var(--muted);
            font-size:.82rem;
            margin-bottom:8px;
        }
        .stat strong{
            font-size:1.45rem;
            line-height:1.1;
        }
        .form-shell{
            padding:22px;
        }
        .section-tag{
            display:flex;
            gap:8px;
            flex-wrap:wrap;
            margin-bottom:16px;
        }
        .tag{
            display:inline-flex;
            align-items:center;
            padding:7px 12px;
            border-radius:999px;
            border:1px solid #e5d1b2;
            background:#fff;
            color:var(--gold-dark);
            font-size:.8rem;
            font-weight:800;
        }
        .tag.active{
            background:linear-gradient(135deg,#f6dfb8,#f0c987);
            border-color:#e0b86b;
            color:#5b3f14;
        }
        .form-grid{
            display:grid;
            grid-template-columns:repeat(2,minmax(0,1fr));
            gap:14px;
        }
        .field{display:flex;flex-direction:column;gap:7px}
        .field.full{grid-column:1 / -1}
        label{
            font-size:.83rem;
            font-weight:800;
            color:#77624c;
        }
        input,select,textarea{
            width:100%;
            border:1px solid #e4d4bd;
            border-radius:14px;
            background:#fff;
            font:inherit;
            color:var(--text);
        }
        input,select{height:46px;padding:0 14px}
        textarea{min-height:170px;padding:14px;resize:vertical;line-height:1.7}
        input:focus,select:focus,textarea:focus{
            outline:none;
            border-color:#c59a5c;
            box-shadow:0 0 0 4px rgba(185,137,69,.10);
        }
        .field-error{color:#b14d3c;font-size:.82rem;font-weight:700}
        .helper{
            color:var(--muted);
            font-size:.88rem;
            line-height:1.6;
        }
        .image-note{
            display:flex;
            align-items:center;
            gap:10px;
            padding:12px 14px;
            border-radius:14px;
            background:#fff7ea;
            border:1px solid #efd9b9;
            color:#7b5d33;
            font-size:.88rem;
            line-height:1.6;
        }
        .actions-row{
            margin-top:18px;
            display:flex;
            gap:10px;
            flex-wrap:wrap;
            align-items:center;
        }
        .success{
            margin-top:18px;
            padding:14px 16px;
            border-radius:16px;
            background:#edf7ee;
            border:1px solid #cce5ce;
            color:#245f30;
        }
        @media (max-width: 1080px){
            .layout{grid-template-columns:1fr}
            .stats{grid-template-columns:repeat(2,1fr)}
        }
        @media (max-width: 700px){
            .page{padding:18px 14px 34px}
            .hero,.panel{border-radius:22px}
            .stats,.form-grid{grid-template-columns:1fr}
            .field.full{grid-column:auto}
        }
    </style>
</head>
<body>
    @php
        $selectedType = old('type', $editingPost->type ?? ($defaultType ?? 'blog'));
        if (!in_array($selectedType, ['blog', 'news'], true)) {
            $selectedType = 'blog';
        }
        $blogCount = $posts->where('type', 'blog')->count();
        $newsCount = $posts->where('type', 'news')->count();
        $publishedCount = $posts->where('is_published', true)->count();
        $draftCount = $posts->where('is_published', false)->count();
    @endphp

    <div class="page">
        <section class="hero">
            <div>
                <span class="eyebrow"><i class="fas fa-layer-group"></i> Content Studio</span>
                <h1>Manage blogs and news in one polished workspace.</h1>

            </div>
            <div class="hero-actions">
                <a class="btn-soft" href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
            </div>
        </section>

        @if (session('content_post_success'))
            <div class="success">{{ session('content_post_success') }}</div>
        @endif

        <div class="layout">
            <section class="panel">
                <div class="panel-head">
                    <h2>{{ isset($editingPost) ? 'Edit Content' : 'Create Content' }}</h2>
                    <p>
                        Use the form below to publish a new article or update an existing one. The selected type controls
                        where the post appears on the public site.
                    </p>
                </div>

                <div class="stats">
                    <div class="stat"><span>Total Posts</span><strong>{{ number_format($posts->count()) }}</strong></div>
                    <div class="stat"><span>Blogs</span><strong>{{ number_format($blogCount) }}</strong></div>
                    <div class="stat"><span>News</span><strong>{{ number_format($newsCount) }}</strong></div>
                    <div class="stat"><span>Published</span><strong>{{ number_format($publishedCount) }}</strong></div>
                </div>

                <div class="form-shell">
                    <div class="section-tag">
                        <span class="tag {{ $selectedType === 'blog' ? 'active' : '' }}">Blog Mode</span>
                        <span class="tag {{ $selectedType === 'news' ? 'active' : '' }}">News Mode</span>
                    </div>

                    <form action="{{ isset($editingPost) ? route('admin.content-posts.update', $editingPost) : route('admin.content-posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-grid">
                            <div class="field">
                                <label>Type</label>
                                <select name="type">
                                    <option value="blog" @selected($selectedType === 'blog')>Blog</option>
                                    <option value="news" @selected($selectedType === 'news')>News</option>
                                </select>
                                @error('type')<div class="field-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="field">
                                <label>Author Name</label>
                                <input type="text" name="author_name" value="{{ old('author_name', $editingPost->author_name ?? 'Admin') }}" placeholder="Admin or content team">
                                @error('author_name')<div class="field-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="field full">
                                <label>Title</label>
                                <input type="text" name="title" value="{{ old('title', $editingPost->title ?? '') }}" placeholder="{{ $selectedType === 'blog' ? 'Write a compelling blog title' : 'Write a concise news headline' }}">
                                @error('title')<div class="field-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="field full">
                                <label>Excerpt</label>
                                <textarea name="excerpt" placeholder="Short summary shown in previews">{{ old('excerpt', $editingPost->excerpt ?? '') }}</textarea>
                                @error('excerpt')<div class="field-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="field full">
                                <label>Content</label>
                                <textarea name="content" maxlength="50000" placeholder="Write the full article content">{{ old('content', $editingPost->content ?? '') }}</textarea>
                                @error('content')<div class="field-error">{{ $message }}</div>@enderror
                                <div class="helper">Maximum 50,000 characters. Use this area for the complete article or announcement body.</div>
                            </div>

                            <div class="field">
                                <label>Category</label>
                                <input type="text" name="category" value="{{ old('category', $editingPost->category ?? '') }}" placeholder="{{ $selectedType === 'blog' ? 'Gem Education' : 'Collection Launch' }}">
                                @error('category')<div class="field-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="field">
                                <label>Published At</label>
                                <input type="date" name="published_at" value="{{ old('published_at', $editingPost && $editingPost->published_at ? $editingPost->published_at->format('Y-m-d') : '') }}">
                                @error('published_at')<div class="field-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="field">
                                <label>Publish Status</label>
                                <input type="hidden" name="is_published" value="0">
                                <label style="display:flex;align-items:center;gap:10px;min-height:46px;padding:0 14px;border-radius:14px;border:1px solid #e4d4bd;background:#fff;">
                                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $editingPost->is_published ?? true) ? 'checked' : '' }}>
                                    <span style="font-weight:800;color:#5b452f;">Published</span>
                                </label>
                            </div>

                            <div class="field full">
                                <label>Featured Image</label>
                                <input type="file" name="featured_image" accept="image/*">
                                @error('featured_image')<div class="field-error">{{ $message }}</div>@enderror
                                <div class="image-note">
                                    <i class="fas fa-image"></i>
                                    Add a clear cover image in JPG, PNG, or WebP.
                                </div>
                            </div>
                        </div>

                        <div class="actions-row">
                            <button class="btn" type="submit">{{ isset($editingPost) ? 'Update Post' : 'Save Post' }}</button>
                            @if (isset($editingPost))
                                <a class="btn-soft" href="{{ route('admin.content-posts', ['type' => $selectedType]) }}">Cancel Edit</a>
                            @endif
                        </div>
                    </form>
                </div>
            </section>

        </div>
    </div>

</body>
</html>
