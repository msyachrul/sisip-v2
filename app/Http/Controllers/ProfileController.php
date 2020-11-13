<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile', ['user' => $this->getUser()]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $this->getUser()->update($request->validated());

        return back()->with('success', 'Success updated your profile.');
    }

    protected function getUser(): User
    {
        return auth()->user();
    }
}
