<x-layouts::app>
    <section class="h-dvh flex items-center">
        <div>
            <div class="p-7 text-center">
                <h1 contenteditable="true" id="editable-title" data-id="{{ $home->id }}"
                    class="font-poppins mb-4 text-4xl font-bold tracking-tight md:text-5xl text-gray-900 rounded p-1 cursor-pointer transition-all focus:outline-none focus:ring-2 focus:ring-emerald-500 hover:bg-gray-100">
                    {{ $home->title }}
                </h1>

                <span id="save-status" class="text-xs text-emerald-600 font-medium hidden">Guardando cambios...</span>

                <div class="mt-4 text-left max-w-2xl mx-auto">
                    <textarea name="body" id="content-input" class="hidden">{{ $home->body }}</textarea>

                    <div
                        class="rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden bg-white dark:bg-zinc-800">
                        <div id="quill-editor" class="min-h-[200px]"></div>
                    </div>
                </div>

                <span id="save-status-body" class="text-xs text-emerald-600 font-medium hidden">Guardando
                    cambios...</span>
            </div>

            <div class="p-7 bg-white">
                <div class="">
                   <x-form/>
                </div>
            </div>
        </div>
    </section>
</x-layouts::app>
