<?php 
class GeocoderComponent extends Component 
{ 
    // URL Variable Seperator 
    var $uvs        = ', '; 

    // You Google Map API Key here -- This is the default API Key registered for www.webmechano.com 
     
    var $apiKey = 'AIzaSyBSfS1XogSeV6dsBGbht3j4P-TdBcJKZX0';
    var $controller = true; 

    /*function startup(&$controller) 
    { 
        $this->controller = &$controller; 
    } 
	*/
    function getLatLng($addy){ 

        if(is_array($addy)){ 
            // First of all make the address 
            if(!empty($addressArr['zip'])){ 
                $address    = $addy['street'].$this->uvs.$addy['loc'].$this->uvs.$addy['zip']; 
            } 
            else{ 
                $address    = $addy['street'].$this->uvs.$addy['loc']; 
            } 
        }else{ 
            $address    = $addy; 
        } 
        // Default Api Key registered for webmechano. It's highly recommended that you use the one for stylished 
        if(!isset($apiKey)){ 
            $api_key  = 'AIzaSyBSfS1XogSeV6dsBGbht3j4P-TdBcJKZX0'; 
        } 
        //$url  = "https://maps.googleapis.com/maps/api/geocode/xml?&key=$api_key&sensor=true&address="; 
		    $url = "https://maps.google.com/maps/api/geocode/json?&key=".$api_key."&sensor=true&address=";
		
        // Here make the result array to return 
        // If the address is correct, it will return 200 in the CODE field so $result['code'] should be equal to 200 
        $result  = array('lat'=>'', 'lng'=>'', 'address'=>'', 'streetnum'=>'', 'street'=>''); 

        // Make the Temporary URL for CURL to execute 
        $tempURL = $url.urlencode($address); 

        // Create the cURL Object here 
        $crl    = curl_init(); 
        curl_setopt($crl, CURLOPT_HEADER, 0); 
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1); 

        // Here we ask google to give us the lats n longs in XML format 
        curl_setopt($crl, CURLOPT_URL, $tempURL); 
        $gXML = curl_exec($crl);    // Here we get the google result in XML 
    		$goo = json_decode($gXML, true); //json decoder

        if($goo['status'] != 'OK' || count($goo['results']) > 1){ 
            $result['lat']        = 'error'; 
            $result['lng']        = 'error'; 
            $result['address']    = 'error'; 
            $result['errors']      = 'Error getting address, please try a more specific address';
            return $result; 
        } 
        else{ 
            
            //$coords = $goo->Response->Placemark->Point->coordinates; 
            //list($lng, $lat)    = split(',', $coords); 
            $result['lat']  = $goo['results'][0]['geometry']['location']['lat']; 
            $result['lng']  = $goo['results'][0]['geometry']['location']['lng'];
            $result['type'] = $goo['results'][0]['geometry']['location_type'];
            
            /*
            echo '<pre>';
				var_dump($goo['results'][0]['address_components']);
			echo'</pre>';
            */
            
            foreach($goo['results'][0]['address_components'] as $addresscomponent):
              switch($addresscomponent['types'][0]){
                case 'street_number':
                  $result['streetnum'] = $addresscomponent['long_name'];
                  break;
                case 'route':
                  $result['street'] = $addresscomponent['long_name'];
                  break;
                case 'locality':
                  $result['city'] = $addresscomponent['long_name'];
                  break;
                case 'administrative_area_level_1':
                  $result['state'] = $addresscomponent['short_name'];
                  break;
                case 'postal_code':
                  $result['zip'] = $addresscomponent['long_name'];
                  break;
              }
              
            endforeach;
            
            $result['address'] = $result['streetnum'] . ' ' . $result['street']; 
            return $result; 
        } 
    }// end function / action : getLatLng    
    
    public function setGeoSessionVariables($variables) {
		
  		if(isset($variables['streetnum']))
  		  $_SESSION['streetnum']=$variables['streetnum'];
  		if(isset($variables['street']))
  		  $_SESSION['street']=$variables['street'];
  		if(isset($variables['city']))
  		  $_SESSION['city']=$variables['city'];
  		if(isset($variables['state']))
  		  $_SESSION['state']=$variables['state'];
  		if(isset($variables['address']))
  		  $_SESSION['address']=$variables['address'];
  		if(isset($variables['ordertype']))
  			$_SESSION['ordertype']=$variables['ordertype'];
  		if(isset($variables['lat']))
  		  $_SESSION['lat']=$variables['lat'];
  		if(isset($variables['lng']))
  		  $_SESSION['lng']=$variables['lng'];
  		if(isset($variables['zip']))
  		  $_SESSION['zip']=$variables['zip'];
		return true;
	}//end function / action : setGeoSessionVariables
} 
?>