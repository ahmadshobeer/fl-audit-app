<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class DivisionService
{
    public function getHeadOfDivisionFullName(string $divisi_id): ?string
    {
        return Cache::remember("head_of_division_{$divisi_id}", 3600, function () use ($divisi_id) {
            try {
                logger()->debug('Fetching fullname for division_id:', [$divisi_id]);

                 $user = Auth::user();
                $payload = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role_id,
                ]; 

                $jwt = JWT::encode($payload, env('API_JWT_SECRET'), 'HS256');

                $client = new Client();
                $headers = [
                    'Authorization' => 'Bearer ' . $jwt,
                    'Accept' => 'application/json',
                ]; 

                $request = new Request('GET',  env('API_URL'). "/divisions/{$divisi_id}/head-division", $headers);
              
                $response = $client->sendAsync($request)->wait();

                $data = json_decode($response->getBody(), true);

                return $data['data']['fullname'] ?? null;
            } catch (\Exception $e) {
                \Log::error('Error fetching Head of Division', ['division_id' => $divisi_id, 'error' => $e->getMessage()]);
            
                return null;
            }
        });
    }
}
