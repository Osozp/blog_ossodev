<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="max-width: 800px; margin: 0 auto; padding: 2rem; font-family: system-ui, sans-serif;">

    <h1>Artículos Publicados</h1>

    @forelse($posts as $post)
        <article style="margin-bottom: 2rem; border-bottom: 1px solid #eee; padding-bottom: 1.5rem;">
            <h2>
                <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none; color: #111;">
                    {{ $post->title }}
                </a>
            </h2>
            <p style="color: #666; font-size: 0.85rem;">
                {{ \Carbon\Carbon::parse($post->published_at)->format('d/m/Y') }}
            </p>
            @if($post->excerpt)
                <p>{{ $post->excerpt }}</p>
            @endif
            <a href="{{ route('blog.show', $post->slug) }}">Leer más &rarr;</a>
        </article>
    @empty
        <p>No hay artículos publicados por el momento.</p>
    @endforelse

    {{ $posts->links() }}

</body>
</html>
