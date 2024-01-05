<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;


class BooksController extends Controller
{
	
	public function deleteBook(Request $request){
		
		$userToken = Session::get('userToken');
		$accessToken = $userToken["token_key"];
		
		$book_to_delete = $request->input('book_to_delete');
		
		try { 
		
			$apiUrl = 'https://symfony-skeleton.q-tests.com/api/v2/books/'.$book_to_delete.'';
		
			$options = [
				'headers' => [
					'Authorization' => 'Bearer ' . $accessToken,
					'Content-Type' => 'application/json',
					'Accept' => 'application/json',
				]
			];
				
			
			$client = new Client();
			$response = $client->delete($apiUrl, $options);
			
			return back();
		}
		catch (RequestException $e) {
			
			echo "<pre>";
			print_r($e);
			echo "</pre>";
		}
		
		
		
	}
	
	public function saveBook(Request $request){
		
		if($request->input('save_book')){
			
			try { 
				$userToken = Session::get('userToken');
				$accessToken = $userToken["token_key"];
			
				$book_author = $request->input('book_author');
				$book_title = strip_tags($request->input('book_title'));
				$book_isbn = $request->input('book_isbn');
				$book_format = strip_tags($request->input('book_format'));
				$book_pages = (int)$request->input('book_pages');
				$book_description = strip_tags($request->input('book_description'));
				
				
				
				//$currentTime = new DateTime();
				$book_release_date = date("Y-m-d");
				
				$requestData = [
					"author" => [
						"id" => $book_author
					],
					"title" => $book_title,
					"release_date" => $book_release_date,
					"description" => $book_description,
					"isbn" => $book_isbn,
					"format" => $book_format,
					"number_of_pages" => $book_pages
				];
				
				$options = [
					'headers' => [
						'Authorization' => 'Bearer ' . $accessToken,
						'Content-Type' => 'application/json',
						'Accept' => 'application/json',
					],
					'json' => $requestData,
				];
				
				$apiUrl = 'https://symfony-skeleton.q-tests.com/api/v2/books';
				$client = new Client();
				$response = $client->post($apiUrl, $options);
				$responseBody = $response->getBody()->getContents();
				
				//$status = $response->getStatusCode();
				return redirect()->route('books');
				
			}
			catch (RequestException $e) {
			
				echo "<pre>";
				print_r($e);
				echo "</pre>";
			}
			
			
			
		}
		else {
			return redirect()->route('books');
		}
		
	}
	
	public function books(Request $request){
			
		if (Session::has('userToken')) {
			$expirationTime = Session::get('userTokenExpiration');
			$userData = session('userToken');
			$sessionData["firstName"] = $userData['user']['first_name'];
			$sessionData["lastName"] = $userData['user']['last_name'];
			if ($expirationTime && now()->gt($expirationTime)) {
				return redirect()->route('login');
			}
			$userToken = Session::get('userToken');
			$accessToken = $userToken["token_key"];
			$apiUrl = 'https://symfony-skeleton.q-tests.com/api/v2/authors';
			$options = [
				'headers' => [
					'Authorization' => 'Bearer ' . $accessToken,
					'Accept' => 'application/json',
				],
			];
			$client = new Client();
			$response = $client->get($apiUrl, $options);
			$body = $response->getBody();
			$listOfAuthors = json_decode($body, true);
			
			return view('books', ['sessionData' => $sessionData, 'listOfAuthors'=>$listOfAuthors ]);
			
			
		}
		else {
			return redirect()->route('login');
		}
		
		
	}
	
    public function getBooks(Request $request)
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
				$apiUrl = 'https://symfony-skeleton.q-tests.com/api/v2/books';
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
					$bookReleaseDateBeautify = [
						"release_date_beautify" => date('d.m.Y', strtotime($item['release_date']))
					];
					$item = array_merge($item, $bookReleaseDateBeautify);
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

