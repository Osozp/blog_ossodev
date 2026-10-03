<x-mail::message>
# ¡Gracias por suscribirte!

Estamos muy felices de tenerte aquí. A partir de ahora recibirás nuestras últimas publicaciones e historias directamente en tu bandeja de entrada.

<x-mail::button :url="config('app.url')">
Visitar el sitio web
</x-mail::button>

Saludos,<br>
{{ config('app.name') }}
</x-mail::message>
