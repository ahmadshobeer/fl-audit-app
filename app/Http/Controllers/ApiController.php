<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
class ApiController extends Controller
{
    //

    public function getCompanies()
    {

        $jwtToken = 'iOwS/qdeECuSQOiXSua5MA3JeO+z7HGxCycIZE32tnwvNqeWb8xYU4iuRPE+0c/+drv5vannoJvQP30izo4gpp7MgXD9m+2uogfAILsPMpKCrZI6vWrNu4tV1KkE4Db8n7BDyIeTQsAReVyJD15qVZZdPA/+Gvw7BeBjHg39BprIXOmsNGZ69NkwRc7CxQXukJUxUH1PPFHeJuSHjMGdmEa7XhVfqwj1WGsSTdJRMKJ5ddUcqdJR1jXX4rB3zHvYygTcdjGrkoM+0klP+oSfDLlB0zFrS9rlFGFQ9f6/RbAtHQhGEVyNiaVZU4bYu/yBSDeLaUJjXeAA5g5uVwRl+w==';
        // Ganti dengan endpoint API yang sesuai
        $apiUrl = "https://api.arita.co.id/api/audit/companies";

        // Ambil token JWT (bisa dari config, database, atau auth)

        // Kirim request ke API dengan header Authorization Bearer Token
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $jwtToken,
            'Accept' => 'application/json',
        ])->get($apiUrl);

        // Cek apakah request berhasil
        if ($response->successful()) {
            return response()->json($response->json());
        }else if (!$response->successful()) {
            return response()->json([
                'error' => 'Failed to fetch data',
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }

        // return response()->json(['error' => 'Failed to fetch data'], $response->status());
    }
}
