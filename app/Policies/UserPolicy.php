<?php
    namespace App\Policies;
    use App\Models\User;
    use Illuminate\Auth\Access\HandlesAuthorization;
    class UserPolicy
    {
        use HandlesAuthorization;
        public function update(User $user, User $userprofile)
        {
            return $user->id === $userprofile->id;
        }
    }