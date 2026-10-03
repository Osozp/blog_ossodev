<x-layouts::app>
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <flux:fieldset>
            <flux:legend>Creacion de nuevo Post</flux:legend>
            <div class="space-y-6">
                <flux:input label="Titulo" name="title" placeholder="Titulo de nuevo post" />

                <div class="grid grid-cols-2 gap-x-4 gap-y-6">
                    <flux:input type="file" name="cover_image" label="Imagen de portada" wire:model="photos" />

                    <flux:input type="date" name="published_at" label="Fecha de publicacion" wire:model="published_at" />

                </div>

                <flux:field>
                    <flux:label>Contenido del Post</flux:label>

                    <textarea name="body" id="content-input" class="hidden"></textarea>

                    <div
                        class="rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden bg-white dark:bg-zinc-800">
                        <div id="quill-editor" class="min-h-[200px]"></div>
                    </div>
                </flux:field>

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary">Guardar Post</flux:button>
                </div>
            </div>

        </flux:fieldset>

    </form>
</x-layouts::app>
