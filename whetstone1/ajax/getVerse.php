<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$token = '6NMO1IFCgBjyeSOzbb810Ug3TU7BwzRtCe84mD7J';

$book = $_GET['book'];
$chapter = $_GET['chapter'];
$verse = $_GET['verse'];
$version = $_GET['version'];

$url = 'https://bibles.org/verses/'.$version.':'.$book.'.'.$chapter.'.'.$verse.'.xml';

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
// Set up authentication
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$token:X");

// Do the request
$response = curl_exec($ch);

curl_close($ch);

// Parse the XML into a SimpleXML object
$xml = new SimpleXMLElement($response);

// Print the text from the 0th verse
echo ($xml->verse[0]->text);
?>