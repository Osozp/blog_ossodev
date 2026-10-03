<x-layouts::web>
    <div>
        <div class="p-7 text-center">
            <h1 class="font-poppins mb-4 text-4xl font-bold tracking-tight leading-none text-gray-900 md:text-5xl">
                {{ $home->title ?? 'titulo no ingresado' }}
            </h1>
            <p class="text-lg font-normal text-gray-600 lg:text-xl sm:px-16 xl:px-48">
                {!! $home->body ?? 'body no ingresado' !!}
            </p>
        </div>

        <div class="p-7 bg-white">
            <div class="">
                <form action="{{ route('subscribe') }}" method="POST">
                    @csrf
                    <div style="display: none;" aria-hidden="true">
                        <input type="text" name="my_hp_field" value="" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                        <div class="relative w-full">
                            <label for="email" class="hidden mb-2 text-sm font-medium text-gray-900">Email
                                address</label>
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                    </path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </div>
                            <input
                                class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Aqui tu correo" type="email" name="email" required>
                        </div>
                        <div>
                            <button type="submit"
                                class="py-3 px-5 w-full text-sm font-bold text-center rounded-lg border cursor-pointer bg-gray-300 border-gray-300 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300">
                                Enviar
                            </button>
                        </div>
                    </div>
                    <div class="mx-auto max-w-screen-sm text-sm text-left text-gray-500 newsletter-form-footer">
                        Nos importa la protección de sus datos.<a href="#"
                            class="font-medium text-primary-600 hover:underline"> Lea nuestra
                            política de privacidad.
                        </a></div>
                </form>
                @if (session('success'))
                    <div class="mt-4 flex items-center rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800"
                        role="alert">
                        <svg class="me-3 inline h-4 w-4 flex-shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        <div>
                            <span class="font-medium">¡Éxito!</span> {{ session('success') }}
                        </div>
                    </div>
                @endif
                @if (session('info'))
                    <div class="p-4 my-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                        {{ session('info') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts::web>
