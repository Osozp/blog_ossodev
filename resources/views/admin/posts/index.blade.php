<x-layouts::app>

    <flux:card>
        <div class="flex items-center justify-between gap-4">
            <div>
                <flux:heading>Recent customers</flux:heading>
                <flux:text class="mt-1">Your latest customer activity.</flux:text>
            </div>

            <flux:button href="{{ route('admin.posts.create') }}" variant="primary" size="sm" icon="plus">Nuevo Post
            </flux:button>
        </div>

        <flux:table bleed container:class="mt-6">
            <flux:table.columns>
                <flux:table.column>Titulo</flux:table.column>
                <flux:table.column>Ver</flux:table.column>
                <flux:table.column>Fecha de publicacion</flux:table.column>
                <flux:table.column>Acciones</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($posts as $post)
                    <flux:table.row :key="$post->id">
                        <flux:table.cell variant="strong">{{ $post->title }}</flux:table.cell>
                        <flux:table.cell>
                            <a href="/blog/{{ $post->slug }}" target="_blanck">
                                <flux:icon.eye variant="solid" class="text-green-500" />
                            </a>
                        </flux:table.cell>

                        <flux:table.cell>{{ $post->created_at }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:button.group>
                                <flux:button href="{{ route('admin.posts.edit', $post) }}" icon="pencil-square"
                                    class="!bg-amber-500 !text-white"></flux:button>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de eliminar este artículo?');">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button type="submit" icon="archive-box-x-mark"
                                        class="!bg-red-500 !text-white"></flux:button>
                                </form>
                            </flux:button.group>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>

    @if (session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

</x-layouts::app>
