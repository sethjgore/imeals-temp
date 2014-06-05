<?php  
App::uses('Component', 'Controller');
class AuthorizeNetComponent extends Component { 

    public function createAuthorize_NetProfile($userid = null, $useremail = null) {
		//build xml to post
		$content =
			"<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
			"<createCustomerProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
			$this->MerchantAuthenticationBlock().
			"<profile>".
			"<merchantCustomerId>".$userid."</merchantCustomerId>". // Your own identifier for the customer.
			"<description></description>".
			"<email>" . $useremail . "</email>".
			"</profile>".
			"</createCustomerProfileRequest>";
		
		//echo "Raw request: " . htmlspecialchars($content) . "<br><br>";
		$response = $this->send_xml_request($content);
		/*echo "Raw response: " . htmlspecialchars($response) . "<br><br>";
		$parsedresponse = $this->parse_api_response($response);
		
		if ("Ok" == $parsedresponse->messages->resultCode) {
			echo "customerProfileId <b>"
				. htmlspecialchars($parsedresponse->customerProfileId)
				. "</b> was successfully created.<br><br>";
				
			$return = $parsedresponse;
		} else {
			$return = $parsedresponse;
		}
		
		$_SESSION['customerprofileid'] = urlencode($parsedresponse->customerProfileId);
		
		//echo $return;
		//return urlencode($parsedresponse->customerProfileId);*/
		
		$parsedresponse = $this->parse_api_response($response);
		return urlencode($parsedresponse->customerProfileId);
    }
    
    public function getPaymentProfileID($customerprofileid = null) {
	    //echo "Get customerProfileId <b>"
			//. htmlspecialchars(1)
			//. "</b>…<br><br>";
		
		//build xml to post
		$content =
			"<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
			"<getCustomerPaymentProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
			$this->MerchantAuthenticationBlock().
			"<customerProfileId>" . $customerprofileid . "</customerProfileId>".
			"<customerPaymentProfileId>17763080</customerPaymentProfileId>".
			"</getCustomerPaymentProfileRequest>";
		
		//echo "Raw request: " . htmlspecialchars($content) . "<br><br>";
		$response = $this->send_xml_request($content);
		//echo "Raw response: " . htmlspecialchars($response) . "<br><br>";
		$parsedresponse = $this->parse_api_response($response);
		
		
		$parsedresponse = $this->parse_api_response($response);
		return urlencode($parsedresponse->customerPaymentProfileId);
    }
	
	public function createAuthorize_NetPaymentProfile($userid = null, $useremail = null, $userfname = null, $userlname = null, $userphone = null, $ccnum = null, $ccexp = null, $customerprofileid = null) {
		$customerShippingAddressId = NULL;
		if (isset($_REQUEST['customerShippingAddressId'])) {
			$customerShippingAddressId = $_REQUEST['customerShippingAddressId'];
		}
		
		//echo "Create payment profile for customerProfileId <b>"
			//. htmlspecialchars(1)
			//. "</b>…<br><br>";
		
		//build xml to post
		$content =
			"<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
			"<createCustomerPaymentProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
			$this->MerchantAuthenticationBlock().
			"<customerProfileId>" . $customerprofileid . "</customerProfileId>".
			"<paymentProfile>".
			"<billTo>".
			 "<firstName>" . $userfname . "</firstName>".
			 "<lastName>" . $userlname . "</lastName>".
			 "<phoneNumber>" . $userphone . "</phoneNumber>".
			"</billTo>".
			"<payment>".
			 "<creditCard>".
			  "<cardNumber>" . $ccnum . "</cardNumber>".
			  "<expirationDate>" . $ccexp . "</expirationDate>". // required format for API is YYYY-MM
			 "</creditCard>".
			"</payment>".
			"</paymentProfile>".
			"<validationMode>testMode</validationMode>". // or liveMode
			"</createCustomerPaymentProfileRequest>";
		
		//echo "Raw request: " . htmlspecialchars($content) . "<br><br>";
		$response = $this->send_xml_request($content);
		//echo "Raw response: " . htmlspecialchars($response) . "<br><br>";
		$parsedresponse = $this->parse_api_response($response);
		/*if ("Ok" == $parsedresponse->messages->resultCode) {
			echo "customerPaymentProfileId <b>"
				. htmlspecialchars($parsedresponse->customerPaymentProfileId)
				. "</b> was successfully created for customerProfileId <b>"
				. htmlspecialchars($_POST["customerProfileId"])
				. "</b>.<br><br>";
				
			$_SESSION['customerpaymentprofileid'] = htmlspecialchars($parsedresponse->customerPaymentProfileId);
		}
		
		$_SESSION['customerpymntprofileid'] = urlencode($parsedresponse->customerPaymentProfileId);
		
		echo "<br><a href=index.php?customerProfileId=" 
			. urlencode(1)
			. "&customerPaymentProfileId="
			. urlencode($parsedresponse->customerPaymentProfileId)
			. "&customerShippingAddressId="
			. urlencode($customerShippingAddressId)
			. ">Continue</a><br>";*/
		
		$parsedresponse = $this->parse_api_response($response);
		return urlencode($parsedresponse->customerPaymentProfileId);
	}  
	
	public function chargePaymentProfilCreditCard($amount = null, $customerprofileid = null, $customerpaymentprofileid = null, $orderid = null) {
		//build xml to post
		$content =
			"<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
			"<createCustomerProfileTransactionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
			$this->MerchantAuthenticationBlock().
			"<transaction>".
			"<profileTransAuthOnly>".
			"<amount>" . $amount . "</amount>". // should include tax, shipping, and everything.
			"<customerProfileId>" . $customerprofileid . "</customerProfileId>".
			"<customerPaymentProfileId>" . $customerpaymentprofileid . "</customerPaymentProfileId>".
			"<order>".
			"<invoiceNumber>".$orderid."</invoiceNumber>".
			"</order>".
			"</profileTransAuthOnly>".
			"</transaction>".
			"</createCustomerProfileTransactionRequest>";
		
		//echo "Raw request: " . htmlspecialchars($content) . "<br><br>";
		$response = $this->send_xml_request($content);
		//echo "Raw response: " . htmlspecialchars($response) . "<br><br>";
		$parsedresponse = $this->parse_api_response($response);
		if ("Ok" == $parsedresponse->messages->resultCode) {
			//echo "A transaction was successfully created for customerProfileId <b>"
				//. $customerprofileid
				//. "</b>.<br><br>";
		}
		if (isset($parsedresponse->directResponse)) {
			//echo "direct response: <br>"
				//. htmlspecialchars($parsedresponse->directResponse)
				//. "<br><br>";
				
			$directResponseFields = explode(",", $parsedresponse->directResponse);
			$responseCode = $directResponseFields[0]; // 1 = Approved 2 = Declined 3 = Error
			$responseReasonCode = $directResponseFields[2]; // See http://www.authorize.net/support/AIM_guide.pdf
			$responseReasonText = $directResponseFields[3];
			$approvalCode = $directResponseFields[4]; // Authorization code
			$transId = $directResponseFields[6];
			
			/*if ("1" == $responseCode) echo "The transaction was successful.<br>";
			else if ("2" == $responseCode) echo "The transaction was declined.<br>";
			else echo "The transaction resulted in an error.<br>";
			*/
			/*echo "responseReasonCode = " . htmlspecialchars($responseReasonCode) . "<br>";
			echo "responseReasonText = " . htmlspecialchars($responseReasonText) . "<br>";
			echo "approvalCode = " . htmlspecialchars($approvalCode) . "<br>";
			echo "transId = " . htmlspecialchars($transId) . "<br>";
			*/
			return htmlspecialchars($transId);
		}
		
	}
	
	//function to send xml request to Api.
	//There is more than one way to send https requests in PHP.
	function send_xml_request($content)
	{
		//global $g_apihost, $g_apipath;
		$g_loginname = "6J8RyjNm8LEd"; // Keep this secure.
		$g_transactionkey = "9A9NJxpt6734Fv8b"; // Keep this secure.
    	$g_apihost = "apitest.authorize.net";
		$g_apipath = "/xml/v1/request.api";
	
		return $this->send_request_via_fsockopen($g_apihost,$g_apipath,$content);
	}
	
	//function to send xml request via fsockopen
	//It is a good idea to check the http status code.
	function send_request_via_fsockopen($host,$path,$content)
	{
		$posturl = "ssl://" . $host;
		$header = "Host: $host\r\n";
		$header .= "User-Agent: PHP Script\r\n";
		$header .= "Content-Type: text/xml\r\n";
		$header .= "Content-Length: ".strlen($content)."\r\n";
		$header .= "Connection: close\r\n\r\n";
		$fp = fsockopen($posturl, 443, $errno, $errstr, 30);
		if (!$fp)
		{
			$body = false;
		}
		else
		{
			error_reporting(E_ERROR);
			fputs($fp, "POST $path  HTTP/1.1\r\n");
			fputs($fp, $header.$content);
			//fwrite($fp, $out);
			$response = "";
			while (!feof($fp))
			{
				$response = $response . fgets($fp, 128);
			}
			fclose($fp);
			error_reporting(E_ALL ^ E_NOTICE);
			
			$len = strlen($response);
			$bodypos = strpos($response, "\r\n\r\n");
			if ($bodypos <= 0)
			{
				$bodypos = strpos($response, "\n\n");
			}
			while ($bodypos < $len && $response[$bodypos] != '<')
			{
				$bodypos++;
			}
			$body = substr($response, $bodypos);
		}
		return $body;
	}
	
	//function to send xml request via curl
	function send_request_via_curl($host,$path,$content)
	{
		$posturl = "https://" . $host . $path;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $posturl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		return $response;
	}
	
	
	//function to parse the api response
	//The code uses SimpleXML. http://us.php.net/manual/en/book.simplexml.php 
	//There are also other ways to parse xml in PHP depending on the version and what is installed.
	function parse_api_response($content)
	{
		$parsedresponse = simplexml_load_string($content, "SimpleXMLElement", LIBXML_NOWARNING);
		if ("Ok" != $parsedresponse->messages->resultCode) {
			echo "The operation failed with the following errors:<br>";
			foreach ($parsedresponse->messages->message as $msg) {
				echo "[" . htmlspecialchars($msg->code) . "] " . htmlspecialchars($msg->text) . "<br>";
			}
			echo "<br>";
		
			//$return = $parsedresponse->messages->resultCode;
		} else {
			//$return = $parsedresponse->messages->resultCode;
		}
		//return $return;
		return $parsedresponse;
	}
	
	function MerchantAuthenticationBlock() {
    	$g_apihost = "apitest.authorize.net";
		$g_apipath = "/xml/v1/request.api";
		$g_loginname = "6J8RyjNm8LEd"; // Keep this secure.
		$g_transactionkey = "9A9NJxpt6734Fv8b"; // Keep this secure.
		
		return
	        "<merchantAuthentication>".
	        "<name>" . $g_loginname . "</name>".
	        "<transactionKey>" . $g_transactionkey . "</transactionKey>".
	        "</merchantAuthentication>";
	}  
	
	function validateCreditcard_number($credit_card_number)
	{
	    // Get the first digit
	    $firstnumber = substr($credit_card_number, 0, 1);
	    // Make sure it is the correct amount of digits. Account for dashes being present.
	    switch ($firstnumber)
	    {
	        case 3:
	            if (!preg_match('/^3\d{3}[ \-]?\d{6}[ \-]?\d{5}$/', $credit_card_number))
	            {
	            	return false;
	                //return 'This is not a valid American Express card number';
	            }
	            break;
	        case 4:
	            if (!preg_match('/^4\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number))
	            {
	            	return false;
	                //return 'This is not a valid Visa card number';
	            }
	            break;
	        case 5:
	            if (!preg_match('/^5\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number))
	            {
	            	return false;
	                //return 'This is not a valid MasterCard card number';
	            }
	            break;
	        case 6:
	            if (!preg_match('/^6011[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number))
	            {
	                return false;
	                //return 'This is not a valid Discover card number';
	            }
	            break;
	        default:
	            return false;//return 'This is not a valid credit card number';
	    }
	    // Here's where we use the Luhn Algorithm
	    $credit_card_number = str_replace('-', '', $credit_card_number);
	    $map = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
	                0, 2, 4, 6, 8, 1, 3, 5, 7, 9);
	    $sum = 0;
	    $last = strlen($credit_card_number) - 1;
	    for ($i = 0; $i <= $last; $i++)
	    {
	        $sum += $map[$credit_card_number[$last - $i] + ($i & 1) * 10];
	    }
	    if ($sum % 10 != 0)
	    {
	        return false;
	    }
	    // If we made it this far the credit card number is in a valid format
	    return true;
	}
	function validateCreditCardExpirationDate($month, $year)
	{
	    if (!preg_match('/^\d{1,2}$/', $month))
	    {
	        return false; // The month isn't a one or two digit number
	    }
	    else if (!preg_match('/^\d{4}$/', $year))
	    {
	        return false; // The year isn't four digits long
	    }
	    else if ($year < date("Y"))
	    {
	        return false; // The card is already expired
	    }
	    else if ($month < date("m") && $year == date("Y"))
	    {
	        return false; // The card is already expired
	    }
	    return true;
	}	
	function validateCVV($cardNumber, $cvv)
	{
	    // Get the first number of the credit card so we know how many digits to look for
	    $firstnumber = (int) substr($cardNumber, 0, 1);
	    if ($firstnumber === 3)
	    {
	        if (!preg_match("/^\d{4}$/", $cvv))
	        {
	            // The credit card is an American Express card but does not have a four digit CVV code
	            return false;
	        }
	    }
	    else if (!preg_match("/^\d{3}$/", $cvv))
	    {
	        // The credit card is a Visa, MasterCard, or Discover Card card but does not have a three digit CVV code
	        return false;
	    }
	    return true;
	}	
}
?>