<x-layouts::app>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <flux:fieldset>
            <flux:legend>Editar Post: {{ $post->title }}</flux:legend>
            <div class="space-y-6">
                <flux:input label="Titulo" name="title" value="{{ old('title', $post->title) }}" placeholder="Titulo de post" />

                <div class="grid grid-cols-2 gap-x-4 gap-y-6">
                    <div>
                        <flux:input type="file" name="cover_image" label="Cambiar imagen de portada" wire:model="photos"/>

                        @if($post->cover_image)
                            <div class="mt-2">
                                <span class="text-xs text-zinc-500">Imagen Actual:</span>
                                <img src="{{ asset('storage/'. $post->cover_image) }}" alt="Portada" class="w-20 h-20 object-cover rounded-lg border border-zinc-200 mt-1">
                            </div>
                        @endif
                    </div>

                    <flux:input type="date" name="published_at" label="Fecha de publicacion" value="{{ old('published_at', $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('Y-m-d') : '') }}"/>

                </div>

                <flux:field>
                    <flux:label>Contenido del Post</flux:label>

                    <textarea name="body" id="content-input" class="hidden">{{ old('body', $post->body) }}</textarea>

                    <div
                        class="rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden bg-white dark:bg-zinc-800">
                        <div id="quill-editor" class="min-h-[200px]"></div>
                    </div>
                </flux:field>

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary">Editar Post</flux:button>
                </div>
            </div>

        </flux:fieldset>
    </form>
</x-layouts::app>
