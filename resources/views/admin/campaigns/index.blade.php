<x-layouts::app>
    <flux:card>
        <div class="flex items-center justify-between gap-4">
            <div>
                <flux:heading>Recent customers</flux:heading>
                <flux:text class="mt-1">Your latest customer activity.</flux:text>
            </div>

            <flux:button href="{{ route('admin.campaigns.create') }}" variant="primary" size="sm" icon="plus">
                Crear email
            </flux:button>
        </div>

        <flux:table bleed container:class="mt-6">
            <flux:table.columns>
                <flux:table.column>Asunto</flux:table.column>
                <flux:table.column>Estado</flux:table.column>
                <flux:table.column>Fecha de creacion</flux:table.column>
                <flux:table.column>Fecha de envio</flux:table.column>
                <flux:table.column>Acciones</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($campaigns as $campaign)
                    <flux:table.row :key="$campaign->id">
                        <flux:table.cell variant="strong">{{ $campaign->subject }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge size="sm" :color="$campaign->statusColor">{{ $campaign->statusLabel }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>{{ $campaign->created_at }}</flux:table.cell>
                        <flux:table.cell>{{ $campaign->sent_at }}</flux:table.cell>
                        <flux:table.cell>
                            @if ($campaign->status === 'draft')
                                <flux:button.group>
                                    <form action="{{ route('admin.campaigns.send', $campaign) }}" method="POST">
                                        @csrf
                                        <flux:button type="submit"
                                            icon="paper-airplane" class="!bg-green-600 !text-white"
                                            onclick="return confirm('¿Enviar este correo a TODOS los suscriptores?')">
                                            Enviar
                                        </flux:button>
                                    </form>
                                    <flux:button href="{{ route('admin.campaigns.edit', $campaign) }}"
                                        icon="pencil-square" class="!bg-amber-500 !text-white"></flux:button>
                                    <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este artículo?');">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" icon="trash"
                                            class="!bg-red-500 !text-white"></flux:button>
                                    </form>
                                </flux:button.group>
                            @else
                                 <flux:badge size="sm" color="green" icon="check-circle">
                                    Completado
                                </flux:badge>
                            @endif
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>
</x-layouts::app>
