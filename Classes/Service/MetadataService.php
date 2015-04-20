<?php
require_once(dirname(__FILE__) . '/../../vendor/autoload.php');

$isbn = filter_var($_GET['isbn'], FILTER_SANITIZE_STRING);

echo getMetaDataForIsbn($isbn);

/**
 * Retrieve Metadata from a provider and return it to the parent Ajax Call
 * Url for retrieval: http://xisbn.worldcat.org/webservices/xid/isbn/0596002815?method=getMetadata&format=xml&fl=*
 *
 * @param string $isbn
 * @return string
 */
function getMetaDataForIsbn($isbn) {

	$return = '';

	$redis = new Predis\Client();
	$url = 'http://xisbn.worldcat.org/webservices/xid/isbn/' . $isbn . '?method=getMetadata&format=json&fl=*';

	$local = checkLocalStorage($isbn, $redis);

	if ($local !== FALSE) {
		$data = json_encode($local);
	} else {
		$data = \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl($url);
	}
	$json = json_decode($data);

	// prefill fields with empty values
	$requiredFields = array('publisher' => '', 'city' => '', 'author' => '', 'ed' => '', 'year' => '', 'title' => '');
	if ($json->stat === 'ok') {
		$requiredFields['stat'] = $json->stat;

		foreach ($requiredFields as $field => $val) {
			if (property_exists($json->list[0], $field)) {
				$requiredFields[$field] = $json->list[0]->$field;
			}
		}
		$return = json_encode($requiredFields);
        if ($local === FALSE) {
		    writeToStorage($isbn, $return, $redis);
        }
	}

	return $return;
}

/**
 * Check if an ISBN is already present in the local storage
 * Returns the set if present, otherwise false
 *
 * @param string $isbn
 * @param \Predis\Client $redis
 * @return mixed
 */
function checkLocalStorage($isbn, $redis) {
	$key = 'isbn:' . $isbn;
	if ($redis->exists($key)) {
		return $redis->get($isbn);
	} else {
		return FALSE;
	}

}

/**
 * Writes the entries to a key-value Storage (i.e. redis)
 *
 * @param $isbn
 * @param $data
 * @param \Predis\Client $redis
 */
function writeToStorage($isbn, $data, $redis) {
	$redis->set('isbn:' . $isbn, $data);
}
