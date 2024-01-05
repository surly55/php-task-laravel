<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;


class AuthorsController extends Controller
{
	
	
	
	public function booklet(Request $request){
			
		if (Session::has('userToken')) {
			$expirationTime = Session::get('userTokenExpiration');
			$userData = session('userToken');
			$sessionData["firstName"] = $userData['user']['first_name'];
			$sessionData["lastName"] = $userData['user']['last_name'];
			
			if ($expirationTime && now()->gt($expirationTime)) {
				return redirect()->route('login');
			}
			
			return view('booklet', ['sessionData' => $sessionData]);
		}
		else {
			return redirect()->route('login');
		}
		
		
	}
	
    public function getAuthors(Request $request)
    {
        try {
			
			if($request->input('draw')){ $draw = $request->input('draw');	 } else { $draw=1; }
			if($request->input('length')){ $length = $request->input('length'); } else { $length = 12; }
			if($request->input('search.value')){ $searchValue = $request->input('search.value'); } else { $searchValue = ""; }
			if($request->input('order.0.column')){ $orderColumn = $request->input('order.0.column'); } else { $orderColumn = "id"; }
			if($request->input('order.0.dir')){ $orderDir = $request->input('order.0.dir'); } else { $orderDir = "ASC"; }
			 
			if (Session::has('userToken')) {
				$userToken = Session::get('userToken');
				$accessToken = $userToken["token_key"];
				$apiUrl = 'https://symfony-skeleton.q-tests.com/api/v2/authors';
				$options = [
					'headers' => [
						'Authorization' => 'Bearer ' . $accessToken,
						'Accept' => 'application/json',
					],
					'query' => [
						'orderBy' => $orderColumn,
						'direction' => $orderDir,
						'limit' => $length,
						'page' => 1,
						'query' => $searchValue
					],
				];
				$client = new Client();
				$response = $client->get($apiUrl, $options);
				$body = $response->getBody();
				$data = json_decode($body, true);
				
				foreach ($data["items"] as &$item) {
					$newData = [
						"author_details" => "<a href='author/{$item['id']}'>View</a>"
					];
					$item = array_merge($item, $newData);
				}
				
				echo json_encode(array(
					"draw" => $draw,
					"recordsTotal" => $data["total_results"],
					"recordsFiltered" => $data["total_results"],
					"data" => $data["items"]
				));
				
			} else {
				return redirect()->route('login');
			}
			
		} catch (RequestException $e) {
			
			return redirect('/');
		}
    }
}

