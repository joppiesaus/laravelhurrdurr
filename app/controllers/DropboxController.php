<?php

use \Dropbox as dbx;

/********************************************
				!UNSAFE!!
********************************************/
class DropboxController extends BaseController {

	private $_appName = "laravelhurrdurr/1.0";

	private function getWebAuth()
	{
		$appInfo = dbx\AppInfo::loadFromJsonFile("dropbox_api.json");
		//$session = Session::all();
		//Session::reflash();
		session_start();
		$csrfTokenStore = new dbx\ArrayEntryStore($_SESSION, "dropbox-auth-csrf-token");
		//echo var_dump($csrfTokenStore);
		//exit;

		return new dbx\WebAuth($appInfo, $this->_appName, "http://localhost/laravelhurrdurr/public/dropboxauth", $csrfTokenStore);
	}

	public function show()
	{
		return View::make("dropbox");
	}

	public function authorize()
	{
		return Redirect::to($this->getWebAuth()->start());

		#return View::make("dropboxauth", [ "auth_url" => $authorizeUrl ]);
	}

	public function downloadFile()
	{
		$input = Input::all();

		$client = new dbx\Client(Session::get("dropbox-token"), $this->_appName);
		$message = "";

		try
		{
			$metadata = $client->getFile("/" . $input["filename"], fopen($input["filename"], "w"));

			if ($metadata === null)
			{
				$message = "Could not download file: File doesn't exist!";
			}
			else
			{
				$message = "File downloaded! <a href=\"" . $input["filename"] . "\">Click here to download</a> " . json_encode($metadata);
			}
		}
		catch (Exception $e)
		{
			$message = "Error on flushing file: " . $e->getMessage();
		}

		// How do I redirect back with data?
		return View::make("dropbox", [ "message" => $message ]);
	}

	public function uploadFile()
	{
		$input = Input::all();

		$client = new dbx\Client(Session::get("dropbox-token"), $this->_appName);
		$message = "";

		$file = Input::file("file");

		if (!$file->isValid())
		{
			echo "ok what do i do now";
		}

		try
		{
			$f = fopen($file->getRealPath(), "r");

			$metadata = $client->uploadFile("/" . $file->getClientOriginalName(), dbx\WriteMode::add(), $f, $file->getSize());

			fclose($f);

			#This might not be true at all. Dropbox seems to ignore some files.
			$message = "Successfully uploaded file: " . json_encode($metadata);
		}
		catch (Exception $e)
		{
			$message = "Could not upload file: " . $e->getMessage();
		}

		return View::make("dropbox", [ "message" => $message ]);
	}

	public function authorizeReturn()
	{
		/*try
		{
			list($accessToken, $userId, $urlState) = getWebAuth()->finish($_GET);
		}
		catch (dbx\WebAuthException_BadRequest $ex) {
				 error_log("/dropbox-auth-finish: bad request: " . $ex->getMessage());
				 // Respond with an HTTP 400 and display error page...
		}
		catch (dbx\WebAuthException_BadState $ex) {
		 		// Auth session expired.  Restart the auth process.
		 		header('Location: /dropbox-auth-start');
		}
		catch (dbx\WebAuthException_Csrf $ex) {
		 error_log("/dropbox-auth-finish: CSRF mismatch: " . $ex->getMessage());
		 // Respond with HTTP 403 and display error page...
		}
		catch (dbx\WebAuthException_NotApproved $ex) {
		 error_log("/dropbox-auth-finish: not approved: " . $ex->getMessage());
		}
		catch (dbx\WebAuthException_Provider $ex) {
		 error_log("/dropbox-auth-finish: error redirect from Dropbox: " . $ex->getMessage());
		}
		catch (dbx\Exception $ex) {
		 error_log("/dropbox-auth-finish: error communicating with Dropbox API: " . $ex->getMessage());
	 }*/
	 	//echo "<pre>" . var_dump(Session::all());

		list($accessToken, $userId, $urlState) = $this->getWebAuth()->finish(Input::all());

		#echo "Access token: " . $accessToken;
		Session::put("dropbox-token", $accessToken);

		$dbxClient = new dbx\Client($accessToken, $this->_appName);
		$accountInfo = $dbxClient->getAccountInfo();
		Session::put("dropbox-name", $accountInfo["display_name"]);

		/*$dbxClient = new dbx\Client($accessToken, $this->_appName);
		$accountInfo = $dbxClient->getAccountInfo();

		print_r($accountInfo);

		$f = fopen("/laravelhurrdurr/public/robots.txt", "rb");
		$result = $dbxClient->uploadFile("/laravelhurrdurr/public/robots.txt", dbx\WriteMode::add(), $f);
		fclose($f);
		print_r($result);*/

		return Redirect::to("dropbox-dashboard");
		#return View::make("dropbox", [ "message" => "Access token: " . Session::get("dropbox-token")]);
	}

}
