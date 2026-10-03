<x-layouts::app>
    <flux:card>
        <div class="flex items-center justify-between gap-4">
            <div>
                <flux:heading>Recent customers</flux:heading>
                <flux:text class="mt-1">Your latest customer activity.</flux:text>
            </div>

            <flux:button href="#" variant="primary" size="sm" icon="plus">
                Crear
                Pagina
            </flux:button>
        </div>

        <flux:table bleed container:class="mt-6">
            <flux:table.columns>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Estado</flux:table.column>
                <flux:table.column>Fecha de registro</flux:table.column>
                <flux:table.column>Ip Address</flux:table.column>
                <flux:table.column>Pais</flux:table.column>
                <flux:table.column>Acciones</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($subscribers as $subscriber)
                    <flux:table.row :key="$subscriber->id">
                        <flux:table.cell variant="strong">{{ $subscriber->email }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge size="sm" :color="$subscriber->statusColor">{{ $subscriber->statusLabel }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>{{ $subscriber->created_at }}</flux:table.cell>
                        <flux:table.cell>{{ $subscriber->ip_address }}</flux:table.cell>
                        <flux:table.cell>{{ $subscriber->country }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:button.group>

                                {{-- <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de eliminar este artículo?');">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button type="submit" icon="archive-box-x-mark"
                                        class="!bg-red-500 !text-white"></flux:button>
                                </form> --}}
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
