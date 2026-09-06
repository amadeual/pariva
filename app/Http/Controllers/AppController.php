<?php

namespace App\Http\Controllers;

use App\Models\Date;
use App\Models\Message;
use App\Models\User;
use App\Models\UserLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function landing()
    {
        $profiles = [
            [
                'name' => 'Mariana',
                'age' => 26,
                'profession' => 'Arquiteta & Designer',
                'location' => 'São Paulo, SP',
                'avatar' => asset('images/avatars/ai_demo_mariana.png'),
                'bio' => 'Apixonada por cafés charmosos, livros de arte e conversas profundas no fim de tarde.',
                'compatibility' => 96,
                'is_verified' => true,
            ],
            [
                'name' => 'Lucas',
                'age' => 29,
                'profession' => 'Engenheiro de Software',
                'location' => 'São Paulo, SP',
                'avatar' => asset('images/avatars/ai_demo_lucas.png'),
                'bio' => 'Adoro praticar corrida ao ar livre, viajar para a praia e cozinhar receitas novas nos finais de semana.',
                'compatibility' => 94,
                'is_verified' => true,
            ],
            [
                'name' => 'Camila',
                'age' => 27,
                'profession' => 'Médica Veterinária',
                'location' => 'Campinas, SP',
                'avatar' => asset('images/avatars/ai_demo_camila.png'),
                'bio' => 'Fã de fotografia analógica, trilhas na natureza e um bom vinho tinto.',
                'compatibility' => 91,
                'is_verified' => true,
            ],
        ];

        return view('landing', compact('profiles'));
    }

    public function explore(Request $request)
    {
        $currentUser = Auth::user();
        $query = User::where('id', '!=', $currentUser->id);

        if ($currentUser->interested_in && $currentUser->interested_in !== 'todos') {
            if ($currentUser->interested_in === 'homens') {
                $query->where('gender', 'homem');
            } elseif ($currentUser->interested_in === 'mulheres') {
                $query->where('gender', 'mulher');
            } elseif ($currentUser->interested_in === 'nao_binarios') {
                $query->where('gender', 'nao_binario');
            }
        }

        $mode = $request->query('mode');
        if ($mode) {
            // Apply category filter logic or random subset based on intent mode
            $users = $query->inRandomOrder()->take(6)->get();
        } else {
            $users = $query->inRandomOrder()->take(10)->get();
        }

        return view('explore', compact('users', 'mode'));
    }

    public function discover()
    {
        $currentUser = Auth::user();
        
        $query = User::where('id', '!=', $currentUser->id);

        if ($currentUser->interested_in && $currentUser->interested_in !== 'todos') {
            if ($currentUser->interested_in === 'homens') {
                $query->where('gender', 'homem');
            } elseif ($currentUser->interested_in === 'mulheres') {
                $query->where('gender', 'mulher');
            } elseif ($currentUser->interested_in === 'nao_binarios') {
                $query->where('gender', 'nao_binario');
            }
        }

        $users = $query->get();

        return view('discover', compact('users'));
    }

    public function encontros()
    {
        $user = Auth::user();
        $dates = Date::where('user_id', $user->id)
                     ->orWhere('target_user_id', $user->id)
                     ->orderBy('date_time', 'asc')
                     ->get();

        return view('encontros', compact('dates'));
    }

    public function likes()
    {
        $currentUser = Auth::user();

        // Get users who liked current logged in user
        $likes = UserLike::with('user')->where('liked_user_id', $currentUser->id)->get();

        return view('curtidas', compact('likes'));
    }

    public function likeUser(Request $request, $likedUserId)
    {
        $currentUser = Auth::user();
        $isSuperlike = $request->boolean('superlike', false);

        UserLike::firstOrCreate([
            'user_id' => $currentUser->id,
            'liked_user_id' => $likedUserId,
        ], [
            'is_superlike' => $isSuperlike,
        ]);

        // Check if there is a mutual like (reciprocal match)
        $reciprocalLike = UserLike::where('user_id', $likedUserId)
            ->where('liked_user_id', $currentUser->id)
            ->exists();

        if ($reciprocalLike) {
            return redirect()->route('match.celebration', ['user' => $likedUserId]);
        }

        return redirect()->route('discover')->with('success', 'Curtida enviada!');
    }

    public function matchCelebration(Request $request)
    {
        $currentUser = Auth::user();
        $matchedUserId = $request->query('user');

        if ($matchedUserId) {
            $matchedUser = User::find($matchedUserId);
        }

        // Fallback if no user query param provided
        if (!isset($matchedUser) || !$matchedUser) {
            $matchedUser = User::where('id', '!=', $currentUser->id)->first();
        }

        return view('match-celebration', compact('currentUser', 'matchedUser'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'age' => ['nullable', 'integer', 'min:18', 'max:120'],
            'location' => ['nullable', 'string', 'max:255'],
            'profession' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'interests' => ['nullable', 'array', 'max:10'],
            'interests.*' => ['string', 'max:50'],
        ], [
            'avatar.image' => 'O arquivo enviado deve ser uma imagem válida.',
            'avatar.max' => 'A foto de perfil deve ter no máximo 5MB.',
            'age.min' => 'É necessário ter pelo menos 18 anos.',
            'age.max' => 'Informe uma idade válida.',
            'interests.max' => 'Você pode selecionar no máximo 10 interesses.',
        ]);

        $updateData = [
            'age' => $validated['age'] ?? $user->age,
            'location' => $validated['location'] ?? $user->location,
            'profession' => $validated['profession'] ?? $user->profession,
            'bio' => $validated['bio'] ?? $user->bio,
            'interests' => $request->has('interests') ? array_values(array_filter($request->interests)) : ($user->interests ?? []),
        ];

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $updateData['avatar'] = $path;
        }

        $user->update($updateData);

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }

    public function updateFilters(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'max_distance' => ['required', 'integer', 'min:1', 'max:200'],
            'interested_in' => ['required', 'string', 'in:homens,mulheres,nao_binarios,todos'],
        ]);

        $user->update([
            'max_distance' => $validated['max_distance'],
            'interested_in' => $validated['interested_in'],
        ]);

        return redirect()->route('discover')->with('success', 'Filtros aplicados com sucesso!');
    }

    public function storeDate(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'date_time' => ['required', 'date'],
        ]);

        Date::create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'location' => $validated['location'],
            'date_time' => $validated['date_time'],
            'status' => 'confirmado',
        ]);

        return redirect()->route('encontros')->with('success', 'Encontro agendado com sucesso!');
    }

    public function chat(Request $request)
    {
        $currentUser = Auth::user();

        // Fetch user IDs with mutual likes (matches)
        $likedUserIds = UserLike::where('user_id', $currentUser->id)->pluck('liked_user_id');
        $matchedUserIds = UserLike::where('liked_user_id', $currentUser->id)
            ->whereIn('user_id', $likedUserIds)
            ->pluck('user_id');

        // Fetch users with existing message history (including direct credit chats)
        $messagedUserIds = Message::where('sender_id', $currentUser->id)
            ->pluck('receiver_id')
            ->merge(Message::where('receiver_id', $currentUser->id)->pluck('sender_id'));

        // All allowed active chat user IDs
        $allowedUserIds = $matchedUserIds->merge($messagedUserIds)->unique();

        $activeChats = User::whereIn('id', $allowedUserIds)->get();

        // Selected recipient user
        $selectedUserId = $request->query('user_id') ?? ($activeChats->first()->id ?? null);
        $selectedUser = $selectedUserId ? User::find($selectedUserId) : null;

        $messages = collect();
        if ($selectedUser) {
            $messages = Message::where(function ($q) use ($currentUser, $selectedUser) {
                $q->where('sender_id', $currentUser->id)->where('receiver_id', $selectedUser->id);
            })->orWhere(function ($q) use ($currentUser, $selectedUser) {
                $q->where('sender_id', $selectedUser->id)->where('receiver_id', $currentUser->id);
            })->orderBy('created_at', 'asc')->get();

            // Mark unread messages as read
            Message::where('sender_id', $selectedUser->id)
                ->where('receiver_id', $currentUser->id)
                ->update(['is_read' => true]);
        }

        return view('chat', compact('activeChats', 'selectedUser', 'messages'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $currentUser = Auth::user();
        $receiverId = $request->receiver_id;

        // Check if mutual match exists
        $isMatch = UserLike::where('user_id', $currentUser->id)->where('liked_user_id', $receiverId)->exists()
            && UserLike::where('user_id', $receiverId)->where('liked_user_id', $currentUser->id)->exists();

        // Check if previous conversation exists
        $hasHistory = Message::where(function ($q) use ($currentUser, $receiverId) {
            $q->where('sender_id', $currentUser->id)->where('receiver_id', $receiverId);
        })->orWhere(function ($q) use ($currentUser, $receiverId) {
            $q->where('sender_id', $receiverId)->where('receiver_id', $currentUser->id);
        })->exists();

        // If no match and no previous history, require direct chat credit
        if (!$isMatch && !$hasHistory) {
            if ($currentUser->direct_chat_credits <= 0) {
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Você precisa de Crédito de Chat Direto ou um Match para iniciar esta conversa!'
                    ], 403);
                }
                return back()->withErrors([
                    'chat_credit' => 'Você precisa de Crédito de Chat Direto ou um Match para iniciar esta conversa!'
                ]);
            }
            // Consume 1 direct chat credit
            $currentUser->decrement('direct_chat_credits');
        }

        $msg = Message::create([
            'sender_id' => $currentUser->id,
            'receiver_id' => $receiverId,
            'message' => trim($request->message),
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $msg->id,
                    'sender_id' => $msg->sender_id,
                    'receiver_id' => $msg->receiver_id,
                    'message' => e($msg->message),
                    'is_me' => true,
                    'time' => $msg->created_at->format('H:i'),
                ]
            ]);
        }

        return redirect()->route('chat', ['user_id' => $receiverId]);
    }

    public function fetchMessages($receiverId)
    {
        $currentUser = Auth::user();

        $messages = Message::where(function ($q) use ($currentUser, $receiverId) {
            $q->where('sender_id', $currentUser->id)->where('receiver_id', $receiverId);
        })->orWhere(function ($q) use ($currentUser, $receiverId) {
            $q->where('sender_id', $receiverId)->where('receiver_id', $currentUser->id);
        })->orderBy('created_at', 'asc')->get();

        // Mark unread messages as read
        Message::where('sender_id', $receiverId)
            ->where('receiver_id', $currentUser->id)
            ->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'messages' => $messages->map(function ($msg) use ($currentUser) {
                return [
                    'id' => $msg->id,
                    'sender_id' => $msg->sender_id,
                    'receiver_id' => $msg->receiver_id,
                    'message' => e($msg->message),
                    'is_me' => $msg->sender_id === $currentUser->id,
                    'time' => $msg->created_at->format('H:i'),
                ];
            })
        ]);
    }

    public function buyChatCredits(Request $request)
    {
        $user = Auth::user();
        // R$ 15.00 package grants 3 direct chat credits
        $user->increment('direct_chat_credits', 3);

        return back()->with('success', 'Pacote de 3 Chats Diretos ativado com sucesso! (R$ 15,00)');
    }

    public function reportUser(Request $request)
    {
        $validated = $request->validate([
            'reported_user_id' => ['required', 'exists:users,id'],
            'reason' => ['required', 'string'],
            'details' => ['nullable', 'string', 'max:500'],
        ]);

        \App\Models\UserReport::create([
            'reporter_id' => Auth::id(),
            'reported_user_id' => $validated['reported_user_id'],
            'reason' => $validated['reason'],
            'details' => $validated['details'] ?? null,
        ]);

        return back()->with('success', 'Denúncia enviada com sucesso. Nossa equipe de segurança irá analisar.');
    }

    public function blockUser(Request $request)
    {
        $validated = $request->validate([
            'blocked_user_id' => ['required', 'exists:users,id'],
        ]);

        \App\Models\UserBlock::firstOrCreate([
            'blocker_id' => Auth::id(),
            'blocked_user_id' => $validated['blocked_user_id'],
        ]);

        return redirect()->route('discover')->with('success', 'Usuário bloqueado com sucesso.');
    }

    public function sendGift(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => ['required', 'exists:users,id'],
            'gift_type' => ['required', 'string'],
            'message' => ['nullable', 'string', 'max:255'],
        ]);

        $user = Auth::user();

        $gifts = [
            'rosa' => ['name' => 'Rosa', 'price' => 2.50, 'emoji' => '🌹'],
            'sorvete' => ['name' => 'Sorvete', 'price' => 3.00, 'emoji' => '🍦'],
            'paquera' => ['name' => 'Paquera Secreta', 'price' => 3.80, 'emoji' => '💌'],
            'perfume' => ['name' => 'Perfume Francês', 'price' => 5.00, 'emoji' => '🧪'],
            'diamante' => ['name' => 'Anel de Diamante', 'price' => 9.90, 'emoji' => '💎'],
        ];

        $giftKey = strtolower($validated['gift_type']);
        $selectedGift = $gifts[$giftKey] ?? $gifts['rosa'];

        \App\Models\UserGift::create([
            'sender_id' => $user->id,
            'receiver_id' => $validated['receiver_id'],
            'gift_type' => $selectedGift['name'],
            'price' => $selectedGift['price'],
            'message' => $validated['message'] ?? "Enviou um presente ({$selectedGift['name']}) para você! {$selectedGift['emoji']}",
        ]);

        // Auto-create match or superlike link
        UserLike::firstOrCreate([
            'user_id' => $user->id,
            'liked_user_id' => $validated['receiver_id'],
            'is_superlike' => true,
        ]);

        return back()->with('success', "{$selectedGift['name']} {$selectedGift['emoji']} enviado com sucesso! (R$ " . number_format($selectedGift['price'], 2, ',', '.') . ")");
    }

    public function buyBoost(Request $request)
    {
        $request->validate([
            'duration' => ['required', 'integer', 'in:30,60,180'],
        ]);

        $minutes = (int)$request->input('duration', 30);
        $user = Auth::user();
        $user->update([
            'boosted_until' => now()->addMinutes($minutes),
        ]);

        return back()->with('success', "⚡ Boost de perfil ativado com sucesso por {$minutes} minutos! Seu perfil está no topo do Descobrir.");
    }

    public function buyFeatured(Request $request)
    {
        $request->validate([
            'plan' => ['required', 'string', 'in:semanal,mensal'],
        ]);

        $plan = $request->input('plan');
        $days = $plan === 'semanal' ? 7 : 30;
        $label = $plan === 'semanal' ? 'Semanal' : 'Mensal';

        $user = Auth::user();
        $user->update([
            'featured_plan' => $plan,
            'featured_until' => now()->addDays($days),
        ]);

        return back()->with('success', "⭐ Destaque de Perfil {$label} ativado! Seu perfil receberá prioridade e o selo Destaque por {$days} dias.");
    }

    public function buySeeLikes(Request $request)
    {
        $request->validate([
            'plan' => ['required', 'string', 'in:semanal,mensal'],
        ]);

        $plan = $request->input('plan');
        $days = $plan === 'semanal' ? 7 : 30;
        $label = $plan === 'semanal' ? 'Semanal' : 'Mensal';

        $user = Auth::user();
        $user->update([
            'see_likes_until' => now()->addDays($days),
        ]);

        return redirect()->route('likes')->with('success', "👀 'Quem Curtiu Você' ({$label}) ativado com sucesso! Todos os perfis foram revelados.");
    }

    public function onboardingInteresses()
    {
        return view('onboarding-interesses');
    }

    public function saveOnboardingInteresses(Request $request)
    {
        $user = Auth::user();
        if ($request->has('interests')) {
            $user->update(['interests' => array_values(array_filter($request->interests))]);
        }
        return redirect()->route('discover');
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('profile-edit', compact('user'));
    }

    public function filtros()
    {
        $user = Auth::user();
        return view('filtros', compact('user'));
    }

    public function games()
    {
        return view('games');
    }

    public function gamesTrivia()
    {
        return view('games-trivia');
    }

    public function gamesResult()
    {
        return view('games-result');
    }

    public function premium()
    {
        return view('premium');
    }

    public function moments()
    {
        return view('moments');
    }

    public function agendarEncontro($userId)
    {
        $targetUser = User::findOrFail($userId);
        return view('encontros-agendar', compact('targetUser'));
    }

    public function storeEncontro(Request $request)
    {
        return $this->storeDate($request);
    }

    public function conviteEncontro($dateId)
    {
        $date = Date::with(['user', 'targetUser'])->findOrFail($dateId);
        return view('encontros-convite', compact('date'));
    }

    public function responderEncontro(Request $request, $dateId)
    {
        $date = Date::findOrFail($dateId);
        $date->update(['status' => $request->input('status', 'aceito')]);
        return redirect()->route('encontros')->with('success', 'Resposta enviada!');
    }
}


