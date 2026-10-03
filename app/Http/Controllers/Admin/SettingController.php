<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;


class SettingController extends Controller
{
    public function editEmail()
    {
        $subject = Setting::where('key', 'welcome_email_subject')->value('value') ?? '¡Bienvenido a nuestra comunidad!';
        $body = Setting::where('key', 'welcome_email_body')->value('value') ??
                '<h1>¡Gracias por suscribirte!</h1><p><a href="{url}">Haz clic aquí para activar tu suscripción</a></p>';

        return view('admin.settings.email', compact('subject', 'body'));
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Setting::updateOrCreate(['key' => 'welcome_email_subject'], ['value' => $request->subject]);
        Setting::updateOrCreate(['key' => 'welcome_email_body'], ['value' => $request->body]);

        return back()->with('success', 'Plantilla de correo actualizada con éxito.');
    }
}
