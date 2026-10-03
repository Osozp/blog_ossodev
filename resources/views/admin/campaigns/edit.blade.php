<x-layouts::app>
    <form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST">
        @csrf
        @method('PUT')

        <flux:fieldset>
            <flux:legend>Editar emai</flux:legend>
            <div class="space-y-6">
                <flux:input label="Asunto del correo" name="subject" value="{{ old('subject', $campaign->subject) }}" />

                <flux:field>
                    <flux:label>Contenido de la pagina</flux:label>

                    <textarea name="body" id="content-input" class="hidden">{{ old('body', $campaign->body) }}</textarea>
                    <div
                        class="rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden bg-white dark:bg-zinc-800">
                        <div id="quill-editor" class="min-h-[200px]"></div>
                    </div>
                </flux:field>

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary">Guardar Email</flux:button>
                </div>
            </div>

        </flux:fieldset>

    </form>
</x-layouts::app>
