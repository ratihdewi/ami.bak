<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

class APIController extends Controller
{
    public function syncmasayu()
    {
        $client = new Client();
        $nip = Auth::user()->nip;
        $tokenResponse = $client->get('https://masayu.universitaspertamina.ac.id/api/Data/Masayu?nip=' . $nip);

        $tokenData = json_decode($tokenResponse->getBody()->getContents(), true);

        if ($tokenData['error'] === false) {
            $token = $tokenData['data'];
            $data = $token[0];

            $userData = User::find(Auth::user()->id);
            $userData->update([
                'nip' => $data['nip'],
                'name' => $data['name'],
                'username' => $data['user_name'],
                'noTelepon' => $data['phone'],
                'email' => $data['email'],
                'status' => strtolower($data['status']),
            ]);
            $userData->save();

            if (count($data['positions']) == 3) {
                if ($data['positions'][0]['position'] != null && $data['positions'][0]['unit_kerja'] != null) {
                    $unitKerja = UnitKerja::where('name', $data['positions'][0]['unit_kerja'])->first();
                    $userData->update([
                        'jabatan' => $data['positions'][0]['position'],
                        'unitkerja_id' => $unitKerja->id,
                    ]);
                    $userData->save();
                } 
                
                if ($data['positions'][1]['position'] != null && $data['positions'][1]['unit_kerja'] != null) {
                    $unitKerja = UnitKerja::where('name', $data['positions'][1]['unit_kerja'])->first();
                    $userData->update([
                        'jabatan2' => $data['positions'][1]['position'],
                        'unitkerja_id2' => $unitKerja->id,
                    ]);
                    $userData->save();
                }

                if ($data['positions'][2]['position'] != null && $data['positions'][2]['unit_kerja'] != null) {
                    $unitKerja = UnitKerja::where('name', $data['positions'][2]['unit_kerja'])->first();
                    $userData->update([
                        'jabatan3' => $data['positions'][2]['position'],
                        'unitkerja_id3' => $unitKerja->id,
                    ]);
                    $userData->save();
                }
            } elseif (count($data['positions']) == 2) {
                if ($data['positions'][0]['position'] != null && $data['positions'][0]['unit_kerja'] != null) {
                    $unitKerja = UnitKerja::where('name', $data['positions'][0]['unit_kerja'])->first();
                    $userData->update([
                        'jabatan' => $data['positions'][0]['position'],
                        'unitkerja_id' => $unitKerja->id,
                    ]);
                    $userData->save();
                } 
                
                if ($data['positions'][1]['position'] != null && $data['positions'][1]['unit_kerja'] != null) {
                    $unitKerja = UnitKerja::where('name', $data['positions'][1]['unit_kerja'])->first();
                    $userData->update([
                        'jabatan2' => $data['positions'][1]['position'],
                        'unitkerja_id2' => $unitKerja->id,
                    ]);
                    $userData->save();
                }

                $userData->update([
                    'jabatan3' => null,
                    'unitkerja_id3' => null,
                ]);
                $userData->save();

            } elseif (count($data['positions']) == 1) {
                if ($data['positions'][0]['position'] != null && $data['positions'][0]['unit_kerja'] != null) {
                    $unitKerja = UnitKerja::where('name', $data['positions'][0]['unit_kerja'])->first();
                    $userData->update([
                        'jabatan' => $data['positions'][0]['position'],
                        'unitkerja_id' => $unitKerja->id,
                    ]);
                    $userData->save();
                } 
                $userData->update([
                    'jabatan2' => null,
                    'unitkerja_id2' => null,
                    'jabatan3' => null,
                    'unitkerja_id3' => null,
                ]);
                $userData->save();
            }

            $homeController = new HomeController();

            return $homeController->indexspm();
        } else {
            return response()->json(['error' => 'Gagal mengambil token dari API'], 500);
        }
    }

}
