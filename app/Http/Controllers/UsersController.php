<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function profile()
    {
        $authSam = Auth::user();
        $pages = "profile";
        $title = "Profile";

        return view('profile', compact('authSam', 'pages', 'title'));
    }

    public function updatePassword(Request $request)
    {
        $authSam = Auth::user();

        $request->validate([
            'password' => 'required',
            'password_baru' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->password, $authSam->password)) {
            return back()->withErrors(['password' => 'Password lama tidak sesuai']);
        }

        $authSam->password = bcrypt($request->password_baru);
        $authSam->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui!');
    }

    public function updateEmail(Request $request)
    {
        $authSam = Auth::user();
        $request->validate([
            'email_baru' => 'required|email|unique:users,email,' . $authSam->id,
            'email_password' => 'required'
        ]);

        if (!Hash::check($request->email_password, $authSam->password)) {
            return back()->withErrors(['email_password' => 'Password salah!']);
        }

        $authSam->email = $request->email_baru;
        $authSam->save();

        return redirect()->back()->with('success', 'Email berhasil diperbarui!');
    }
}