<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Employee extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'mobile',
        'department',
        'designation',
        'avatar',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
    /**
     * Handle the avatar upload.
     */
    public function uploadAvatar($file)
    {
        if ($this->avatar && Storage::disk('public')->exists('avatars/' . $this->avatar)) {
            Storage::disk('public')->delete('avatars/' . $this->avatar);
        }
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('avatars', $fileName, 'public');
        $this->avatar = $fileName;
    }
    /**
     * Delete the avatar from storage.
     */
    public function deleteAvatar()
    {
        if ($this->avatar && Storage::disk('public')->exists('avatars/' . $this->avatar)) {
            Storage::disk('public')->delete('avatars/' . $this->avatar);
        }
    }
}

