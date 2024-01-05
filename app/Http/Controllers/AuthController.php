<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        try {
            $client = new Client();

            $response = $client->post('https://symfony-skeleton.q-tests.com/api/v2/token', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'email' => (string)$request->input('email'),
                    'password' => (string)$request->input('password'),
                ],
            ]);

            $data = json_decode($response->getBody(), true);
			$userToken = $data;
			Session::put('userToken', $userToken);
			$expirationTime = now()->addMinutes(60);
			Session::put('userTokenExpiration', $expirationTime);
			return redirect()->route('booklet');
			
        } catch (RequestException $e) {
			
			$response = $e->getResponse();

            if ($response && $response->getStatusCode() === 400) {
                $errorData = json_decode($response->getBody(), true);
				return redirect()->route('login')->withErrors($errorData['Server cannot or will not process the request']);
            }
			else if ($response && $response->getStatusCode() === 403) {
				$errorData = json_decode($response->getBody(), true);
				return redirect()->route('login')->withErrors("User not found or inactive or password not valid.");
			}
			else {
				$errorData = json_decode($response->getBody(), true);
				return redirect()->route('login')->withErrors("Error! Please contact your administrator");
			}
			
			
        }
    }
	
	public function logout(Request $request){
		session(['userToken' => null]);
		return redirect('/');
	}
	
}

