<?php 

// AIzaSyAQmU4qh6T_jJ2Ymfxnmw4ikX8pIzuESIQ

// client id : 325102692948-vbpkekcrbrkmjes2j8ak0rag4ndjub8e.apps.googleusercontent.com
// client secret : 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

// gsheet@gsheet-demo-387811.iam.gserviceaccount.com

// https://gobikez.com
// https://gobikez.com/oauth
// https://www.youtube.com/watch?v=zoufwxZjr0c

$post = $_POST;

if(isset($post) && !empty($post)) {
	
	require __DIR__ . '/vendor/autoload.php';

	$client = new \Google_Client();
	$client->setApplicationName('Google Sheets with Primo');
	$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
	$client->setAccessType('offline');
	$client->setAuthConfig(__DIR__ . '/credentials.json');

	$service = new Google_Service_Sheets($client);
	$spreadsheetId = "1pkEkWkXKQluBmaIrLnErZpZC4S88IGnjRJp8gwzKCUc";

	$range = "gdemo"; // Sheet name

	$values = [
		[
		$post['name'],
		$post['email'],
		$post['phone'],
		$post['details'],
		],
	];
	// echo "<pre>";print_r($values);echo "</pre>";exit;
	$body = new Google_Service_Sheets_ValueRange([
		'values' => $values
	]);
	$params = [
		'valueInputOption' => 'RAW'
	];

	$result = $service->spreadsheets_values->append(
		$spreadsheetId,
		$range,
		$body,
		$params
	);

	/*if($result->updates->updatedRows == 1){
		echo "Success";
	} else {
		echo "Fail";
	}*/
	header('Location: http://jasonf121.sg-host.com/sheetd?msg=success');
	die;
} else {
	header('Location: http://jasonf121.sg-host.com/sheetd?msg=fail');
	die;
}