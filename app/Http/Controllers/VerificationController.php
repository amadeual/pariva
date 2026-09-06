<?php

namespace App\Http\Controllers;

use App\Models\UserVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VerificationController extends Controller
{
    /**
     * Submit user identity verification with document and selfie photos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'document_type' => ['required', 'string', 'in:rg_rne_cnh,rg,rne,cnh,passport'],
            'document_photo' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'selfie_photo' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ], [
            'document_type.required' => 'Selecione o tipo de documento enviado.',
            'document_photo.required' => 'Por favor, envie a foto do seu documento de identidade (RG/RNE/CNH ou Passaporte).',
            'document_photo.image' => 'A foto do documento deve ser um arquivo de imagem válido (JPG ou PNG).',
            'document_photo.max' => 'A foto do documento deve ter no máximo 5MB.',
            'selfie_photo.required' => 'Por favor, tire ou envie uma selfie segurando o rosto visível para comparação.',
            'selfie_photo.image' => 'A foto da selfie deve ser uma imagem válida.',
            'selfie_photo.max' => 'A selfie deve ter no máximo 5MB.',
        ]);

        $user = Auth::user();

        // Store photos in public storage folder
        $docPath = $request->file('document_photo')->store('verifications/docs', 'public');
        $selfiePath = $request->file('selfie_photo')->store('verifications/selfies', 'public');

        // Create or update pending verification record
        UserVerification::updateOrCreate(
            ['user_id' => $user->id, 'status' => 'pending'],
            [
                'document_type' => $validated['document_type'],
                'document_photo_path' => $docPath,
                'selfie_photo_path' => $selfiePath,
                'status' => 'pending',
                'rejection_reason' => null,
            ]
        );

        return back()->with('success', 'Sua verificação de identidade (Documento + Selfie) foi enviada com sucesso e está em análise!');
    }

    /**
     * Admin view for reviewing pending identity verifications.
     */
    public function adminIndex()
    {
        $verifications = UserVerification::with('user')
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.verifications', compact('verifications'));
    }

    /**
     * Admin approves a user identity verification.
     */
    public function adminApprove($id)
    {
        $verification = UserVerification::with('user')->findOrFail($id);
        
        $verification->update([
            'status' => 'approved',
            'verified_at' => now(),
            'rejection_reason' => null,
        ]);

        $verification->user->update([
            'is_verified' => true,
            'verification_badge' => 'Oficial',
        ]);

        return back()->with('success', "Identidade de {$verification->user->name} APROVADA com sucesso! O selo de verificação foi concedido.");
    }

    /**
     * Admin rejects a user identity verification with a reason.
     */
    public function adminReject(Request $request, $id)
    {
        $request->validate([
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        $verification = UserVerification::with('user')->findOrFail($id);
        $reason = $request->input('reason', 'Foto do documento ou selfie ilegível. Por favor envie novamente.');

        $verification->update([
            'status' => 'rejected',
            'rejection_reason' => $reason,
        ]);

        $verification->user->update([
            'is_verified' => false,
        ]);

        return back()->with('success', "Solicitação de verificação de {$verification->user->name} foi REJEITADA.");
    }
}
