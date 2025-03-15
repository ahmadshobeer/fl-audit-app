<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
class ApiController extends Controller
{
    //

    public function getDivisions(HttpRequest $request)
    {
        
          // Ambil token dari .env
          $secretKey = env('API_JWT_SECRET');
          $user = Auth::user();
          $payload = [
            'id' => $user->id,
            'username' => $user->username,
            'role' => $user->role_id,
      ];
        
        // Gunakan secret key yang sama dengan JWT_SECRET di API
        $jwt = JWT::encode($payload, $secretKey, 'HS256');
        // Pastikan token tersedia
        if (!$jwt) {
            return response()->json([
                'message' => 'API token is missing.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Inisialisasi Guzzle Client
        $client = new Client();
        $headers = [
            'Authorization' => 'Bearer ' . $jwt,
            'Accept' => 'application/json',
        ];

        // Buat request
        $request = new Request('GET', env('API_URL').'/divisions', $headers);

        try {
            $response = $client->sendAsync($request)->wait();
            return response()->json(json_decode($response->getBody(), true), Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Failed to fetch divisions', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Failed to retrieve divisions.',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_GATEWAY);
        }
    }


    public function getCompanies(HttpRequest $request)
    {
     // Ambil token dari .env
     $secretKey = env('API_JWT_SECRET');
     $user = Auth::user();
     $payload = [
       'id' => $user->id,
       'username' => $user->username,
       'role' => $user->role_id,
 ];
   
   // Gunakan secret key yang sama dengan JWT_SECRET di API
   $jwt = JWT::encode($payload, $secretKey, 'HS256');
   // Pastikan token tersedia
   if (!$jwt) {
       return response()->json([
           'message' => 'API token is missing.'
       ], Response::HTTP_UNAUTHORIZED);
   }

   // Inisialisasi Guzzle Client
   $client = new Client();
   $headers = [
       'Authorization' => 'Bearer ' . $jwt,
       'Accept' => 'application/json',
   ];

   // Buat request
   $request = new Request('GET', env('API_URL').'/companies', $headers);

   try {
       $response = $client->sendAsync($request)->wait();
       return response()->json(json_decode($response->getBody(), true), Response::HTTP_OK);
   } catch (\Exception $e) {
       Log::error('Failed to fetch companies', ['error' => $e->getMessage()]);
       return response()->json([
           'message' => 'Failed to retrieve companies.',
           'error' => $e->getMessage()
       ], Response::HTTP_BAD_GATEWAY);
   }
    }
}


