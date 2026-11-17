<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog & News | Pinwntha Gems</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root{--bg:#f7f3ec;--card:#fff;--line:#eadcc6;--text:#2f261e;--muted:#735f4a;--green:#214841;--green2:#2f6f65;--gold:#b89250}
        body{margin:0;font-family:Arial,Helvetica,sans-serif;background:radial-gradient(circle at top left,rgba(184,146,80,.07),transparent 26%),linear-gradient(180deg,#fff 0%,var(--bg) 100%);color:var(--text)}
        .page{max-width:1280px;margin:0 auto;padding:0 20px 56px}
        .hero{margin:24px 0 18px;padding:34px 28px;border-radius:28px;background:linear-gradient(135deg,#fff,#fcf8ef);border:1px solid var(--line);box-shadow:0 16px 34px rgba(83,57,26,.06)}
        .hero h1{margin:0 0 8px;font-family:Georgia,'Times New Roman',serif;font-size:2.4rem}
        .hero p{margin:0;max-width:820px;line-height:1.7;color:var(--muted)}
        .section{margin-top:24px}
        .section-head{display:flex;align-items:flex-end;justify-content:space-between;gap:14px;flex-wrap:wrap;margin-bottom:16px}
        .section-head h2{margin:0;font-family:Georgia,'Times New Roman',serif;font-size:1.9rem}
        .section-head p{margin:0;color:var(--muted);max-width:760px;line-height:1.6}
        .grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px}
        .card{overflow:hidden;border-radius:24px;background:var(--card);border:1px solid var(--line);box-shadow:0 14px 30px rgba(83,57,26,.05)}
        .card-image{height:230px;background:#f5eee0}
        .card-image img{width:100%;height:100%;object-fit:cover;display:block}
        .card-body{padding:18px}
        .meta{display:flex;flex-wrap:wrap;gap:12px;color:#8b7150;font-size:.85rem;font-weight:700}
        .card-body h3{margin:12px 0 10px;font-size:1.25rem;line-height:1.4}
        .card-body p{margin:0;color:#5f4d3c;line-height:1.7}
        .btn{display:inline-flex;align-items:center;justify-content:center;margin-top:14px;padding:10px 14px;border-radius:12px;background:linear-gradient(135deg,var(--gold),#9b6d32);color:#fff;text-decoration:none;font-weight:700}
        .detail{padding:24px;border-radius:28px;background:var(--card);border:1px solid var(--line);box-shadow:0 14px 30px rgba(83,57,26,.05)}
        .detail h2{margin:0;font-family:Georgia,'Times New Roman',serif;font-size:2rem}
        .detail img{width:100%;max-height:460px;object-fit:cover;border-radius:22px;margin:18px 0}
        .detail .text{color:#4f4132;line-height:1.85;font-size:1.02rem;white-space:pre-line}
        .back{display:inline-flex;align-items:center;justify-content:center;margin-top:18px;padding:10px 14px;border-radius:12px;background:#efe4d1;color:#5b452f;text-decoration:none;font-weight:700}
        .empty{padding:18px;border:1px dashed #e5d2b2;border-radius:18px;background:#fffaf2;color:#7a6550;line-height:1.7}
        @media (max-width: 900px){.grid{grid-template-columns:1fr}.hero h1{font-size:2rem}.detail h2{font-size:1.7rem}}
    </style>
</head>
<body>
<x-navbar />

<div class="page">
    @unless ($selectedPost)

    @endunless

    @if ($selectedPost)
        <section class="detail" style="margin-bottom: 24px;">
            <a class="back" href="{{ route('blogs') }}">Back to Blogs & News</a>
            <h2 style="margin-top: 14px;">{{ $selectedPost->title }}</h2>
            <div class="meta" style="margin-top: 12px;">
                <span><i class="fa-regular fa-calendar"></i> {{ optional($selectedPost->published_at)->format('F j, Y') ?? 'Unpublished' }}</span>
                <span><i class="fa-regular fa-user"></i> {{ $selectedPost->author_name }}</span>
                @if ($selectedPost->category)
                    <span><i class="fa-regular fa-folder"></i> {{ $selectedPost->category }}</span>
                @endif
            </div>

            <img src="{{ $selectedPost->featured_image_url ?? asset('images/placeholders/notavailable.png') }}" alt="{{ $selectedPost->title }}">

            <div class="text">{!! nl2br(e($selectedPost->content)) !!}</div>
        </section>
    @endif

    @unless ($selectedPost)
    <section class="section">
        <div class="section-head">
            <div>
                <h2>Blogs</h2>
                <p>Gem education, jewellery styling, buying guidance and our stories.</p>
            </div>
        </div>

        <div class="grid">
            @forelse ($blogPosts as $post)
                <article class="card">
                    <div class="card-image">
                        <img src="{{ $post->featured_image_url ?? asset('images/placeholders/notavailable.png') }}" alt="{{ $post->title }}">
                    </div>
                    <div class="card-body">
                        <div class="meta">
                            <span><i class="fa-regular fa-calendar"></i> {{ optional($post->published_at)->format('F j, Y') ?? 'Unpublished' }}</span>
                            <span><i class="fa-regular fa-user"></i> {{ $post->author_name }}</span>
                        </div>
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 150) }}</p>
                        <a class="btn" href="{{ route('blogs.show', $post) }}">Read More</a>
                    </div>
                </article>
            @empty
                <div class="empty">No blog posts have been published yet.</div>
            @endforelse
        </div>
    </section>

    <section class="section">
        <div class="section-head">
            <div>
                <h2>News</h2>
                <p>Launches, events and important updates in the gem and jewellery fields.</p>
            </div>
        </div>

        <div class="grid">
            @forelse ($newsPosts as $post)
                <article class="card">
                    <div class="card-image">
                        <img src="{{ $post->featured_image_url ?? asset('images/placeholders/notavailable.png') }}" alt="{{ $post->title }}">
                    </div>
                    <div class="card-body">
                        <div class="meta">
                            <span><i class="fa-regular fa-calendar"></i> {{ optional($post->published_at)->format('F j, Y') ?? 'Unpublished' }}</span>
                            <span><i class="fa-regular fa-user"></i> {{ $post->author_name }}</span>
                        </div>
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 150) }}</p>
                        <a class="btn" href="{{ route('blogs.show', $post) }}">Read More</a>
                    </div>
                </article>
            @empty
                <div class="empty">No news updates have been published yet.</div>
            @endforelse
        </div>
    </section>
    @endunless
</div>

<x-footer />
</body>
</html>
