<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeNewsletterMail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->paginate(15);
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function store(Request $request)
    {
        if ($request->filled('my_hp_field')) {
            return back()->with('success', '¡Te has suscrito correctamente! Revisa tu correo electrónico para confirmar tu suscripción.');
        }
        $validated = $request->validate([
            'email' => 'required|email',
        ]);
        $ip = $request->ip();
        $ipToQuery = ($ip === '127.0.0.1' || $ip === '::1') ? '8.8.8.8' : $ip;
        $country = 'Desconocido';
        try {
            $response = Http::timeout(2)->get("http://ip-api.com/json/{$ipToQuery}");
            if ($response->successful() && $response['status'] === 'success') {
                $country = $response['country'];
            }
        } catch (\Exception $e) {
            logger()->error("Error obteniendo geolocalizacion: " .$e->getMessage());
        }

        $subscriber = Subscriber::firstOrNew(['email' => $validated['email']]);

        if ($subscriber->exists && $subscriber->status === 'activo') {
            return back()->with('info', 'Este correo electrónico ya se encuentra suscrito y activo.');
        }

        $subscriber->fill([
            'ip_address'    => $ip,
            'country'       => $country,
            'status'        => 'registrado',
        ])->save();

        Mail::to($subscriber->email)->send(new WelcomeNewsletterMail($subscriber));

        return back()->with('success', '¡Te has suscrito correctamente! Revisa tu correo electrónico para confirmar tu suscripción.');
    }

    public function confirm(Subscriber $subscriber)
    {
        if ($subscriber->status === 'registrado') {
            $subscriber->update(['status' => 'activo']);
        }

        return redirect()->route('home')->with('success', '¡Suscripción confirmada! Bienvenido.');
    }

    public function unsubscribe(Subscriber $subscriber)
    {
        $subscriber->update(['status' => 'de_baja']);

        return redirect()->route('home')->with('success', 'Te has dado de baja correctamente. No recibiras más correos.');
    }
}
