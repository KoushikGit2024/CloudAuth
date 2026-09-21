<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * I redirect the user to the AWS Cognito Hosted UI
     */
    public function login(Request $request)
    {
        $state = Str::random(40);
        Session::put('oauth_state', $state);

        $query = http_build_query([
            'client_id' => env('COGNITO_CLIENT_ID'),
            'response_type' => 'code',
            'scope' => 'openid email profile',
            'redirect_uri' => url('/auth/callback'),
            'state' => $state,
        ]);

        $url = 'https://' . env('COGNITO_DOMAIN') . '/login?' . $query;

        return redirect($url);
    }

    /**
     * I handle the callback from AWS Cognito
     */
    public function callback(Request $request)
    {
        $state = $request->input('state');
        $code = $request->input('code');

        if ($state !== Session::get('oauth_state')) {
            return response('Invalid State / CSRF Attempt', 403);
        }

        // I exchange my code for tokens
        $response = Http::asForm()->withBasicAuth(
            env('COGNITO_CLIENT_ID'),
            env('COGNITO_CLIENT_SECRET')
        )->post('https://' . env('COGNITO_DOMAIN') . '/oauth2/token', [
            'grant_type' => 'authorization_code',
            'client_id' => env('COGNITO_CLIENT_ID'),
            'redirect_uri' => url('/auth/callback'),
            'code' => $code,
        ]);

        if ($response->failed()) {
            return response('Failed to exchange code for tokens', 500);
        }

        $tokens = $response->json();
        
        // I decode the ID Token (Basic Decoding - JWT Signature verification omitted for simplicity)
        $payload = explode('.', $tokens['id_token'])[1];
        $userInfo = json_decode(base64_decode($payload), true);

        // I store the user in the session
        Session::put('user', [
            'username' => $userInfo['cognito:username'] ?? $userInfo['sub'],
            'email' => $userInfo['email'] ?? null,
            'sub' => $userInfo['sub'],
        ]);

        return redirect('/dashboard')->with('success', 'Successfully signed in via AWS Cognito.');
    }

    /**
     * I log out the user and clear my session
     */
    public function logout(Request $request)
    {
        Session::forget('user');

        $query = http_build_query([
            'client_id' => env('COGNITO_CLIENT_ID'),
            'logout_uri' => url('/'),
        ]);

        $url = 'https://' . env('COGNITO_DOMAIN') . '/logout?' . $query;

        return redirect($url);
    }
}
