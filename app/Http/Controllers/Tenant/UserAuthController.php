<?php 
namespace App\Http\Controllers\Tenant;

use App\Http\Requests\Tenant\RegisterRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10),
        ]);

        $token = $user->createToken('TenantApp')->accessToken;

        return response()->json(['token' => $token]);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('TenantApp')->accessToken;

        return response()->json(['token' => $token]);
    }
}
