<?php
$id = "113720634485746776434";
$shelf = "3";
$maxResults = 10;

getShelves($id);
getBooks($id, $shelf, $maxResults);

function getShelves($id){
	$url = "https://www.googleapis.com/books/v1/users/".$id."/bookshelves/";
	// Set up cURL
	$ch = curl_init();
	// Set the URL
	curl_setopt($ch, CURLOPT_URL, $url);
	// don't verify SSL certificate
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	// Return the contents of the response as a string
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// Follow redirects
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	
	// Do the request
	$json = curl_exec($ch);
	curl_close($ch);
	
	$bookshelves = json_decode($json);
	
	foreach($bookshelves->items as $bookshelf){
		//var_dump($bookshelf);
		if(!empty($bookshelf)){
			$results[] = array('id' => $bookshelf->id,
			'title' => $bookshelf->title);
		}
	}
	
	echo "<select>";
	foreach($results as $key => $value){
		$select = "";
		echo "<option value='" . $value['id'] . "' " . $select .">" . $value['title'] . "</option>";
	}
	echo "</select>";
}

function getBooks($id, $shelf, $maxResults){
	$url = "https://www.googleapis.com/books/v1/users/".$id."/bookshelves/".$shelf."/volumes?maxResults=" . $maxResults;
	
	// Set up cURL
	$ch = curl_init();
	// Set the URL
	curl_setopt($ch, CURLOPT_URL, $url);
	// don't verify SSL certificate
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	// Return the contents of the response as a string
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// Follow redirects
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	
	// Do the request
	$json = curl_exec($ch);
	curl_close($ch);
	
	$books = json_decode($json);
	
	foreach($books->items as $book){
		if(!empty($book)){
			if(!empty($book->volumeInfo->imageLinks->thumbnail)){
				$imageLink = $book->volumeInfo->imageLinks->thumbnail;
				$r[] = array('title' => $book->volumeInfo->title,
				'imageLink' => $imageLink,
				'infoLink' => $book->volumeInfo->infoLink);
			}else{
				$imageLink = "http://books.google.com/googlebooks/images/no_cover_thumb.gif";
			}
		}
	}
	
	echo "<br/>";
	foreach($r as $key => $value){
		echo "<a href='" . $value['imageLink'] . "' target='_blank'><img src='" . $value['imageLink'] . "'/></a> " . "<br/>";
	}
}
?>