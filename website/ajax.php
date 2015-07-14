<?php 

if(isset($_POST["fnc"])){
	call_user_func($_POST["fnc"]);
} else {
	echo "Must call a function.";
}

function a_xpath(){
	require 'CURL/Curl.php';

	if(isset($_POST["path"])) {
		$path = "";
		if($_POST["path"] != "all") {
			$path = $_POST["path"];
		}
		// Curl(user, clef de l'api en dur dans le projet, clef api du user depuis la bdd)
		$curl = new Curl("admin","123456789","jhJBbjBOM64S6f"); /* admin droit au get post delete put */
		//$curl = new Curl("user","123456789","odzaknddDJZ5DZ5"); /*  le user à uniquement droit au get */
		
		$xml_content = substr($curl->get(), 0, -1);

		$xml = new SimpleXMLElement($xml_content);

		$results = $xml->xpath($path);	
		
		//echo print_r($results, true);
		$response = array();
		foreach ($results as $result) {
			if(!isset($_POST["id"]))
				$response[] = array("id" => (string) $result->attributes()["jeuId"], "titre"=> (string) $result->{"titre"});
			else {
				$consoles = $jaquettes = array();
				foreach($result->consoles->console as $console){
					$consoles[] = (string) $console->nomConsole;
					$jaquettes[] = (string) $console->medias->media;
				}
				$response[] = array( "titre"=> (string) $result->{"titre"}, "consoles" => $consoles, "jaquettes" => $jaquettes, "description" => (string) $result->description);	
			}
				
			//$reponse[] = $result->{'titre'};
		}

		echo json_encode($response);
	}
}

function a_getForm(){
	require 'CURL/Curl.php';

	$curl = new Curl("admin","123456789","jhJBbjBOM64S6f");

	$fields = $curl->getForm();

	echo $fields;

}

function a_post(){
	require 'CURL/Curl.php';
	$curl = new Curl("admin","123456789","jhJBbjBOM64S6f");
	$curl->post();
	header("Location:/Api-website/");
}