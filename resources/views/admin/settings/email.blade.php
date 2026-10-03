<x-layouts::app>
    <form action="{{ route('admin.settings.email.update') }}" method="POST">
        @csrf

        <flux:fieldset>
            <flux:legend>Configurar correo de bienvenida</flux:legend>
            <div class="space-y-6">
                <flux:input label="Asunto del correo" name="subject" value="{{ old('subject', $subject) }}" required />

                <flux:field>
                    <flux:label>Contenido de la pagina</flux:label>

                    <textarea name="body" id="content-input" class="hidden">{{ old('body', $body) }}</textarea>
                    <div
                        class="rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden bg-white dark:bg-zinc-800">
                        <div id="quill-editor" class="min-h-[200px]"></div>
                    </div>
                </flux:field>

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary">Guardar Correo de Bienvenida</flux:button>
                </div>
            </div>
        </flux:fieldset>
    </form>

    @if (session('success'))
        <div class="my-4 flex items-center rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800"
            role="alert">
            <svg class="me-3 inline h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <div>
                <span class="font-medium">¡Éxito!</span> {{ session('success') }}
            </div>
        </div>
    @endif
</x-layouts::app>
