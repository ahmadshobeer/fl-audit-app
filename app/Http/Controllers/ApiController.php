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


    public function getHeadOfDivision($divisi_id)
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
   $request = new Request('GET', env('API_URL')."/divisions/{$divisi_id}/head-division", $headers);

        try {
            $response = $client->sendAsync($request)->wait();
            return response()->json(json_decode($response->getBody(), true), Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Failed to fetch of Division', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Failed to retrieve Head of Division.',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_GATEWAY);
        }
    }


    public function getCompanies()
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



    public function getHeadCompany($company_id)
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
   $request = new Request('GET', env('API_URL')."/companies/{$company_id}/head-subsi", $headers);

        try {
            $response = $client->sendAsync($request)->wait();
            return response()->json(json_decode($response->getBody(), true), Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Failed to fetch Head Company', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Failed to retrieve Head Company.',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_GATEWAY);
        }
    }




    public function getRegions(HttpRequest $request)
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
   $request = new Request('GET', env('API_URL').'/regions', $headers);

        try {
            $response = $client->sendAsync($request)->wait();
            return response()->json(json_decode($response->getBody(), true), Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Failed to fetch regions', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Failed to retrieve regions.',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_GATEWAY);
        }
    }


    public function getPositions(HttpRequest $request)
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
   $request = new Request('GET', env('API_URL').'/positions', $headers);

        try {
            $response = $client->sendAsync($request)->wait();
            return response()->json(json_decode($response->getBody(), true), Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Failed to fetch positions', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Failed to retrieve positions.',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_GATEWAY);
        }
    }


    public function getBranchByRegion($regional_id)
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
   $request = new Request('GET', env('API_URL')."/branches/{$regional_id}", $headers);

        try {
            $response = $client->sendAsync($request)->wait();
            return response()->json(json_decode($response->getBody(), true), Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Failed to fetch branches', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Failed to retrieve branches.',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_GATEWAY);
        }
    }



    public function getHeadBranch($branch_id)
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
   $request = new Request('GET', env('API_URL')."/branches/{$branch_id}/head-branch", $headers);

        try {
            $response = $client->sendAsync($request)->wait();
            return response()->json(json_decode($response->getBody(), true), Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Failed to fetch head branches', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Failed to retrieve head branches.',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_GATEWAY);
        }
    }
}


