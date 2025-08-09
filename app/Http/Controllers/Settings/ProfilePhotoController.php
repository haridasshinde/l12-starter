<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfilePhotoController extends Controller
{
    /**
     * Delete the current user's profile photo.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->user()->deleteProfilePhoto();

        return to_route('profile.edit');
    }
}
