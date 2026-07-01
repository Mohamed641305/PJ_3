<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // ✅ Validation
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:11'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // تحقق من الصورة
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/users'), $imageName);
        } else {
            $imageName = 'default.jpg';
        }

        // ✅ Create User + Encrypt Password + Save image
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'address'  => $request->address,
            'role'     => 'user',
            'profile_image'    => $imageName, // هنا حفظنا الصورة في قاعدة البيانات
        ]);

        event(new Registered($user));

        // ✅ Login automatically
        Auth::login($user);

        // ✅ Redirect حسب الدور
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('welcome')->with('success', 'Account created successfully.');
    }
}
