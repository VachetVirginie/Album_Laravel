<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\User;
    class UserController extends Controller
    {
        public function edit(User $user)
        {
            $settings = json_decode($user->settings);
            return view ('users.edit', compact('user', 'settings'));
        }
        public function update(Request $request, User $user)
        {
            $this->authorize('update', $user);
            
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'pagination' => 'required',
            ]);
            $user->update([
                'email' => $request->email,
                'settings' => json_encode(['pagination' => $request->pagination]),
            ]);
            return back()->with(['ok' => __('Le profil a bien été mis à jour')]);
        }
    }