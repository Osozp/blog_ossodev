<x-layouts::web>
    <div>
        <div class="p-7 text-center">
            <h1 class="font-poppins mb-4 text-2xl font-semibold tracking-tight leading-none text-gray-900 md:text-4xl">
                {{ $home->title ?? 'titulo no ingresado' }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-600">
                {{-- La unica habilidad que te permite montar un negocio rentable desde la mesa de tu comedor, despues de cenar,
                y sin gastar un centavo en mercaderia. --}}
                {{ $home->subtitle ?? 'Subtitulo de l apagina' }}
            </p>
            <div class="my-8">
                <x-form/>
            </div>
            <div class="mb-8 text-xl font-normal text-gray-600 md:text-2xl">
                {!! $home->body ?? 'body' !!}
            </div>
            <x-form/>
        </div>

    </div>
</x-layouts::web>
