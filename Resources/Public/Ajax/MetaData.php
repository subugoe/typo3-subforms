<?php

// open redis connection
$redis = new Redis();
$redis->connect('127.0.0.1');
$redis->select(12);

$isbn = filter_var($_GET['isbn'], FILTER_SANITIZE_STRING);

echo getMetaDataForIsbn($isbn, $redis);

/**
 * Retrieve Metadata from a provider and return it to the parent Ajax Call
 * Url for retrieval: http://xisbn.worldcat.org/webservices/xid/isbn/0596002815?method=getMetadata&format=xml&fl=*
 *
 * @param $isbn
 */
function getMetaDataForIsbn($isbn, $redis) {

	$return = '';

		// check if isbn metadata is already in our database
	$local = isInLocalStorage($isbn, $redis);

	if ($local) {
		$return = json_encode($local);
	} else {
		$url = 'http://xisbn.worldcat.org/webservices/xid/isbn/' . $isbn . '?method=getMetadata&format=json&fl=*';

		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);

		$json = json_decode($data);

			// prefill fields with empty values
		$requiredFields = array('publisher' => '', 'city' => '', 'author' => '', 'ed' => '', 'year' => '', 'title' => '');
		if ($json->stat == 'ok') {
			$requiredFields['stat'] = $json->stat;

			foreach ($requiredFields as $field => $val) {
				if (property_exists($json->list[0], $field)) {
					$requiredFields[$field] = $json->list[0]->$field;
				}
			}
			$return = (json_encode($requiredFields));

				// write set to redis
			writeToStorage($isbn, $return, $redis);
		}
	}

	return $return;
}

/**
 * Check if an ISBN is already present in the local storage
 * Returns the set if present, otherwise false
 *
 * @param $isbn
 * @param $redis
 * @return mixed
 */
function isInLocalStorage($isbn, $redis) {
	if ($redis->hGet('isbn:' . $isbn, 'title')) {
		$return = $redis->hGetAll('isbn:' . $isbn);
	} else {
		$return = FALSE;
	}

	return $return;
}

/**
 * Writes the entries to a key-value Storage (i.e. redis)
 *
 * @param $isbn
 * @param $data
 * @paran $redis
 */
function writeToStorage($isbn, $data, $redis) {
	$data = json_decode($data, TRUE);
	$redis->hMset('isbn:' . $isbn, $data);
}

?>