<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts::app>
{{-- <x-layouts::app>
    <h1>Panel de Administración</h1>


        <!-- Tarjetas de Resumen -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 3rem;">
            <div style="border: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 8px; background: #f9fafb;">
                <h3 style="margin: 0; color: #4b5563;">Entradas del Blog</h3>
                <p style="font-size: 2rem; font-weight: bold; margin: 0.5rem 0;">{{ $stats['posts_count'] }}</p>
                <a href="{{ route('admin.posts.index') }}" style="color: #2563eb; text-decoration: none;">Gestionar entradas &rarr;</a>
            </div>

            <div style="border: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 8px; background: #f9fafb;">
                <h3 style="margin: 0; color: #4b5563;">Páginas Estáticas</h3>
                <p style="font-size: 2rem; font-weight: bold; margin: 0.5rem 0;">{{ $stats['pages_count'] }}</p>
                <a href="{{ route('admin.pages.index') }}" style="color: #2563eb; text-decoration: none;">Gestionar páginas &rarr;</a>
            </div>

            <div style="border: 1px solid #e5e7eb; padding: 1.5rem; border-radius: 8px; background: #f9fafb;">
                <h3 style="margin: 0; color: #4b5563;">Suscriptores Activos</h3>
                <p style="font-size: 2rem; font-weight: bold; margin: 0.5rem 0;">{{ $stats['subscribers_count'] }}</p>
                <a href="{{ route('admin.subscribers.index') }}" style="color: #2563eb; text-decoration: none;">Ver suscriptores &rarr;</a>
            </div>
        </div>

        <!-- Lista Rápida de Últimos Suscriptores -->
        <section>
            <h2>Últimos Emails Registrados</h2>
            <table border="1" cellpadding="8" style="width: 100%; border-collapse: collapse; border-color: #e5e7eb;">
                <thead>
                    <tr style="background: #f3f4f6;">
                        <th style="text-align: left;">Email</th>
                        <th style="text-align: left;">Fecha de Registro</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestSubscribers as $subscriber)
                        <tr>
                            <td>{{ $subscriber->email }}</td>
                            <td>{{ $subscriber->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">Aún no hay suscriptores registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

</x-layouts::app> --}}


