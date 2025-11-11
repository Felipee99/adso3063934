<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Imágenes de usuarios</title>
    <style>
        body{font-family:Arial,Helvetica,sans-serif;}
        .grid{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;padding:20px}
        .card{width:150px;border:1px solid #eee;padding:8px;border-radius:8px;text-align:center}
        img{width:120px;height:120px;object-fit:cover;border-radius:8px}
        .meta{font-size:13px;margin-top:6px}
    </style>
</head>
<body>
    <h1 style="text-align:center">Imágenes en public/images</h1>
    <div class="grid">
        @forelse($files as $f)
            <div class="card">
                <img src="{{ $f['url'] }}" alt="{{ $f['filename'] }}">
                <div class="meta"><strong>{{ $f['filename'] }}</strong></div>
                <div class="meta">@if($f['user']) Usuario: {{ $f['user'] }} @else Sin usuario asociado @endif</div>
            </div>
        @empty
            <p>No se encontraron imágenes en public/images</p>
        @endforelse
    </div>
</body>
</html>