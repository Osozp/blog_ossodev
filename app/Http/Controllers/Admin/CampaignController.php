<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Subscriber;
use App\Mail\DailyNewsletterMail; // O tu Mailable dinámico
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::latest()->get();
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Campaign::create([
            'subject' => $request->subject,
            'body' => $request->body,
            'status' => 'draft',
        ]);

        return redirect()->route('admin.campaigns.index')->with('success', 'Borrador guardado correctamente.');
    }

    public function send(Campaign $campaign)
    {
        if ($campaign->status === 'sent') {
            return back()->with('error', 'Esta campaña ya fue enviada.');
        }

        // 1. Filtrar ÚNICAMENTE a los suscriptores activos
        $subscribers = Subscriber::where('status', 'activo')->get();

        $delayInSeconds = 0;

        foreach ($subscribers as $subscriber) {
            // 2. Encolar con un retardo incremental (ej. 1 segundo cada 2 envíos)
            Mail::to($subscriber->email)
                ->later(
                    now()->addSeconds($delayInSeconds),
                    new DailyNewsletterMail($campaign->subject, $campaign->body, $subscriber)
                );

            // Incrementa medio segundo entre cada correo para no golpear el rate limit de Resend
            $delayInSeconds += 0.5;
        }

        $campaign->update([
            'status' => 'sent',
            'sent_at' => now(),
        ]);

        return back()->with('success', '¡Campaña encolada! Los correos se están enviando en segundo plano.');
    }

    // public function send(Campaign $campaign)
    // {
    //     if ($campaign->status === 'sent') {
    //         return back()->with('error', 'Esta campaña ya fue enviada.');
    //     }

    //     $subscribers = Subscriber::where('status', 'activo')->get();

    //     foreach ($subscribers as $subscriber) {
    //         // Envío con el asunto y cuerpo de la campaña específica
    //         Mail::to($subscriber->email)->send(new DailyNewsletterMail($campaign->subject, $campaign->body, $subscriber));
    //     }

    //     $campaign->update([
    //         'status' => 'sent',
    //         'sent_at' => now(),
    //     ]);

    //     return back()->with('success', '¡Email enviado con éxito a toda la lista!');
    // }

    public function edit(Campaign $campaign)
    {
        // Bloquear si la campaña ya fue enviada
        if ($campaign->status !== 'draft') {
            return redirect()->route('admin.campaigns.index')
                ->with('error', 'No se puede editar una campaña que ya ha sido enviada.');
        }

        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        if ($campaign->status !== 'draft') {
            abort(403, 'Acción no permitida.');
        }

        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'body'    => 'required|string',
        ]);

        $campaign->update($validated);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaña actualizada correctamente.');
    }

    public function destroy(Campaign $campaign)
    {
        if ($campaign->status !== 'draft') {
            return redirect()->route('admin.campaigns.index')
                ->with('error', 'No se puede eliminar una campaña enviada.');
        }

        $campaign->delete();

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaña eliminada correctamente.');
    }
}
