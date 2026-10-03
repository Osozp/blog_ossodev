<x-layouts::app>
    <flux:card>
        <div class="flex items-center justify-between gap-4">
            <div>
                <flux:heading>Recent customers</flux:heading>
                <flux:text class="mt-1">Your latest customer activity.</flux:text>
            </div>

            <flux:button href="{{ route('admin.pages.create') }}" variant="primary" size="sm" icon="plus">Crear Pagina
            </flux:button>
        </div>

        <flux:table bleed container:class="mt-6">
            <flux:table.columns>
                <flux:table.column>Titulo</flux:table.column>
                <flux:table.column>Estado</flux:table.column>
                <flux:table.column>Ver</flux:table.column>
                <flux:table.column>Fecha de publicacion</flux:table.column>
                <flux:table.column>Acciones</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($pages as $page)
                    <flux:table.row :key="$page->id">
                        <flux:table.cell variant="strong">{{ $page->title }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge size="sm" :color="$page->statusColor">{{ $page->statusLabel }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <a href="/{{ $page->slug }}" target="_blanck">
                                <flux:icon.eye variant="solid" class="text-green-500" />
                                <span>{{ $page->slug }}</span>
                            </a>
                        </flux:table.cell>

                        <flux:table.cell>{{ $page->created_at }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:button.group>
                                <flux:button href="{{ route('admin.pages.edit', $page) }}" icon="pencil-square"
                                    class="!bg-amber-500 !text-white"></flux:button>
                                <form action="{{ route('admin.pages.destroy', $page) }}" method="POST"
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
</x-layouts::app>
