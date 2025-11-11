<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pet selected</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-teal-900 via-indigo-900 to-purple-900 flex flex-col items-center justify-center">
    <h1 class="text-white text-center text-5xl font-bold pb-8 drop-shadow-lg">List Pet🐶</h1>
    <section class="flex flex-row-reverse items-center justify-center gap-4 bg-white/10 rounded-xl shadow-2xl p-10 w-full max-w-4xl border border-white/20">
        <div class="flex-shrink-0 w-[320px] h-[320px] rounded-xl overflow-hidden shadow-lg border-4 border-white/30 bg-white/10">
            <img
                class="object-cover w-full h-full"
                src="{{ asset('images/'.$pet->image) }}"
                alt="{{ $pet->name }}" />
        </div>
        <form class="flex flex-col gap-4 w-full max-w-md text-left text-white">
            <div class="mb-2">
                <label class="block text-lg font-semibold">Nombre:</label>
                <div class="bg-white/20 rounded px-3 py-2">{{ $pet->name }}</div>
            </div>
            <div class="mb-2">
                <label class="block text-lg font-semibold">Tipo:</label>
                <div class="bg-white/20 rounded px-3 py-2">
                    @if(strtolower($pet->kind) == 'dog')
                        <span class="badge badge-error">Perro</span>
                    @elseif(strtolower($pet->kind) == 'cat')
                        <span class="badge badge-info">Gato</span>
                    @elseif(strtolower($pet->kind) == 'bird')
                        <span class="badge badge-success">Ave</span>
                    @elseif(strtolower($pet->kind) == 'rabbit')
                        <span class="badge badge-warning">Conejo</span>
                    @else
                        <span class="badge badge-neutral">{{ ucfirst($pet->kind) }}</span>
                    @endif
                </div>
            </div>
            <div class="mb-2">
                <label class="block text-lg font-semibold">Edad:</label>
                <div class="bg-white/20 rounded px-3 py-2">{{ $pet->age }} años</div>
            </div>
            <div class="mb-2">
                <label class="block text-lg font-semibold">Peso:</label>
                <div class="bg-white/20 rounded px-3 py-2">{{ $pet->weight }} kg</div>
            </div>
            <div class="mb-2">
                <label class="block text-lg font-semibold">Raza:</label>
                <div class="bg-white/20 rounded px-3 py-2">{{ $pet->breed }}</div>
            </div>
            <div class="mb-2">
                <label class="block text-lg font-semibold">Ubicación:</label>
                <div class="bg-white/20 rounded px-3 py-2">{{ $pet->location }}</div>
            </div>
            <div class="mb-2">
                <label class="block text-lg font-semibold">Descripción:</label>
                <div class="bg-white/20 rounded px-3 py-2">{{ $pet->description }}</div>
            </div>
            <div class="mb-2">
                <label class="block text-lg font-semibold">Descripción:</label>
                <div class="bg-white/20 rounded px-3 py-2">{{ $pet->description }}</div>
            </div>
      <li>
        <div>
           <div class="text-xs uppercase font-semibold opacity-60">Active</div> 
              <div>
              @if($pet->active == 1)
                <div class="badge badge-success">Yes</div>
              @else
                <div class="badge badge-error">No</div>
              @endif
          </div>
        </div>
      </li>
      <li class="list-row">
        <div>
           <div class="text-xs uppercase font-semibold opacity-60">Status:</div> 
              <div>
              @if($pet->status == 0)
                <div class="badge badge-success">Available</div>
              @else
                <div class="badge badge-error">Adopted</div>
              @endif
          </div>
        </div>
      </li>
    </form>
    <a class="text-white bg-teal-700 rounded-full p-1 hover:scale-150 transition-all" href="{{ url('view/pets') }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#000000" viewBox="0 0 256 256"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>
    </a>
   </section>
</body>
</html>