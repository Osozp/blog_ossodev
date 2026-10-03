<x-layouts::app>
    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <flux:fieldset>
            <flux:legend>Creacion de nueva Página</flux:legend>
            <div class="space-y-6">
                <flux:input label="Titulo de la pagina" name="title" placeholder="Titulo de la nueva pagina" />

                <div class="grid grid-cols-4 gap-x-4 gap-y-6">
                    <flux:field variant="inline">
                        <flux:label>Publicar inmediatamente</flux:label>

                        <flux:switch name="is_published" value="1" wire:model.live="is_published" />

                        <flux:error name="is_published" />
                    </flux:field>
                </div>

                <flux:field>
                    <flux:label>Contenido de la pagina</flux:label>

                    <textarea name="body" id="content-input" class="hidden"></textarea>
                    <div
                        class="rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden bg-white dark:bg-zinc-800">
                        <div id="quill-editor" class="min-h-[200px]"></div>
                    </div>
                </flux:field>

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary">Guardar Pagina</flux:button>
                </div>
            </div>

        </flux:fieldset>

    </form>
</x-layouts::app>
