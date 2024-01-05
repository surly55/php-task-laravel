<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;


class AuthorController extends Controller
{
	
	public function addAuthor(Request $request){
		
		
		$first_name = strip_tags($request->input('first_name'));
		$last_name = strip_tags($request->input('last_name'));
		$biography = "";
		$gender = $request->input('gender');
		$place_of_birth = strip_tags($request->input('place_of_birth'));
		$birthday_year = $request->input('birthday_year');
		$birthday_month = $request->input('birthday_month');
		$birthday_day = $request->input('birthday_day');
		$birthday = $birthday_year."-".$birthday_month."-".$birthday_day;
  
		$userToken = Session::get('userToken');
		$accessToken = $userToken["token_key"];
		
		try { 
		
			$requestData = [
				"first_name"=>$first_name,
				"last_name"=>$last_name,
				"birthday"=>$birthday,
				"biography"=>$biography,
				"gender"=>$gender,
				"place_of_birth"=>$place_of_birth
			];
			
			$options = [
				'headers' => [
					'Authorization' => 'Bearer ' . $accessToken,
					'Content-Type' => 'application/json',
					'Accept' => 'application/json',
				],
				'json' => $requestData,
			];
			
			$apiUrl = 'https://symfony-skeleton.q-tests.com/api/v2/authors';
			$client = new Client();
			$response = $client->post($apiUrl, $options);
			
			return redirect()->route("booklet");
		
		}
		catch (RequestException $e) {
			
			echo "<pre>";
			print_r($e);
			echo "</pre>";
		}
	}
	
	
	public function deleteAuthor(Request $request){
		
		$author_to_delete = $request->input('author_to_delete');
		
		$userToken = Session::get('userToken');
		$accessToken = $userToken["token_key"];
		
		try { 
		
				$userToken = Session::get('userToken');
				$accessToken = $userToken["token_key"];
				$apiUrl = 'https://symfony-skeleton.q-tests.com/api/v2/authors/'.$author_to_delete.'';
				$options = [
					'headers' => [
						'Authorization' => 'Bearer ' . $accessToken,
						'Accept' => 'application/json',
					]
				];
				$client = new Client();
				$response = $client->get($apiUrl, $options);
				$body = $response->getBody();
				$authorData = json_decode($body, true);
				//CHECK IF AUTHOR HAS BOOKS
				if(empty($authorData["books"])){
					
					$apiUrlDelete = 'https://symfony-skeleton.q-tests.com/api/v2/authors/'.$author_to_delete.'';
		
					$options = [
						'headers' => [
							'Authorization' => 'Bearer ' . $accessToken,
							'Content-Type' => 'application/json',
							'Accept' => 'application/json',
						]
					];
						
					
					$client = new Client();
					$response = $client->delete($apiUrlDelete, $options);
					
					return redirect()->route('booklet');
					
				}
				else {
					return back();
				}
			
		}
		catch (RequestException $e) {
			
			echo "<pre>";
			print_r($e);
			echo "</pre>";
		}
		
		
	}
	
    public function getAuthorBooks($id, Request $request)
    {
        try {
			
			if (Session::has('userToken')) {
				$userToken = Session::get('userToken');
				$accessToken = $userToken["token_key"];
				$apiUrl = 'https://symfony-skeleton.q-tests.com/api/v2/authors/'.$id.'';
				$options = [
					'headers' => [
						'Authorization' => 'Bearer ' . $accessToken,
						'Accept' => 'application/json',
					]
				];
				$client = new Client();
				$response = $client->get($apiUrl, $options);
				$body = $response->getBody();
				$authorData = json_decode($body, true);
				
				$userData = session('userToken');
				$sessionData["firstName"] = $userData['user']['first_name'];
				$sessionData["lastName"] = $userData['user']['last_name'];
				
				//print_r($authorData);
				
				return view('authorBooks', ['authorData' => $authorData, 'sessionData' => $sessionData]);
				
				
				
				
			} else {
				return redirect()->route('login');
			}
			
			
		} catch (RequestException $e) {
			
			return redirect('/');
		}
    }
}

