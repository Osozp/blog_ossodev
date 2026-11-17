<x-layouts::web>
    <div>
        <div class="p-7 text-center">
            <h1 class="font-poppins mb-4 text-4xl font-bold tracking-tight leading-none text-gray-900 md:text-5xl">
                <span>Suscribete a esta lista y te enseñare la habilidad que no necesita titulo academico</span>
                La unica habilidad que te permite montar un negocio rentable desde la mesa de tu comedor, despues de cenar,
                y sin gastar un centavo en mercaderia.
                {{-- {{ $home->title ?? 'titulo no ingresado' }} --}}
                <x-form/>
            </h1>
            <p class="text-lg font-normal text-gray-600 lg:text-xl sm:px-16 xl:px-48">
                {!! $home->body !!}
                <x-form/>
            </p>
        </div>

    </div>
</x-layouts::web>
