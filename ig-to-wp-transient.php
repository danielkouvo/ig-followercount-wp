<?php

/* Instagram followers count to WP transient */
function get_ig_followers_count()
{
	
	//get transient
	$ig_followers_transient = get_transient('ig_followers_data');

	//if exists, return data
	if (!empty($ig_followers_transient)) {

		return $ig_followers_transient;
	
	//else retrieve data from api
	} else {

        // Access token for the Instagram account
        $access_token = 'Insert Instagram access token here';
        
        // Get data from Instagram API
        $data = file_get_contents("https://api.instagram.com/v1/users/self/?access_token=" . $access_token);

        // Convert json with objects converted into associative arrays
        $json = json_decode($data, true);

        //set transient and expiration with ig followers count as the transient value
        set_transient('ig_followers_data', $json['data']['counts']['followed_by'], DAY_IN_SECONDS);

        return $json;

	}

}

?>