<?php
class MonaeException extends Exception { }

class MonAE
{
    private $_firmid;
    private $_login;
    private $_password;
    private $_format;
    
    public function __construct($_firmid, $_login, $_password, $_format = "json")
    {
       	$this->set_firmid($_firmid);
   		$this->set_login($_login);
   		$this->set_password($_password); 	
   		$this->set_format($_format); 	
    }
    
    private function set_firmid($_firmid)
    {
    	if(!$_firmid) { throw new MonaeException('$_firmid doit être renseigné.'); }
	    $this->_firmid = $_firmid;
    } 
    private function set_login($_login)
    {
    	if(!$_login) { throw new MonaeException('$_login doit être renseigné.'); }
	    $this->_login = $_login;
    } 
    private function set_password($_password)
    {
    	if(!$_password) { throw new MonaeException('$_password doit être renseigné.'); }
	    $this->_password = $_password;
    }
    public function set_format($_format)
    {
    	if($_format != "json" AND $_format != "xml") { throw new MonaeException('Le format "'.$_format.'" n\'est pas autorisé. Formats autorisés : xml ou json.'); }
	    $this->_format = $_format;
    }
    
    public function getCustomers($options = array())
    {
	   	$return = $this->getListe("customers", $options);
		return $return;
    }
    
    public function getCustomer($_ID)
    {
	    $return = $this->getUnique("customers", $_ID);
		return $return;
    }

    public function newCustomer($options = array())
    {
        if($this->_format == "xml")
        {
            $creation = "<customers>";
            foreach($options as $key => $value)
            {
                $creation .= "<$key>$value</$key>";
            }
            $creation .= "</customers>";
        }
        if($this->_format == "json")
        {
            $creation = json_encode($options);
        }

        $return = $this->newItem("customers", $creation);
        return $return;
    }
    
    public function getQuotes($options = array())
    {
	   	$return = $this->getListe("quotes", $options);
		return $return;
    }
    
    public function getQuote($_ID)
    {
	    $return = $this->getUnique("quotes", $_ID);
		return $return;
    }
    
    public function getQuotePDF($_ID, $afficher = false)
    {
	    $return = getPDF("quotes", $_ID);
		if($afficher)
		{
			header("Content-type: application/pdf");
			echo $return;
		}
		else
		{
			return $return;
		}
    }
    
    public function getInvoices($options = array())
    {
	   	$return = $this->getListe("invoices", $options);
		return $return;
    }
    
    public function getInvoice($_ID)
    {
	    $return = $this->getUnique("invoices", $_ID);
		return $return;
    }
    
    public function getInvoicePDF($_ID, $afficher = false)
    {
	    $return = getPDF("invoices", $_ID);
		if($afficher)
		{
			header("Content-type: application/pdf");
			echo $return;
		}
		else
		{
			return $return;
		}
    }
    
    public function getSuppliers($options = array())
    {
	    $return = $this->getListe("suppliers", $options);
		return $return;
    }
    
    public function getSupplier($_ID)
    {
	    $return = $this->getUnique("suppliers", $_ID);
		return $return;
    }
    
    public function getPurchases($options = array())
    {
	    $return = $this->getListe("purchases", $options);
		return $return;
    }
    
    public function getPurchase($_ID)
    {
	    $return = $this->getUnique("purchases", $_ID);
		return $return;
    }
    
    private function getListe($name, $options = array())
    {
    	$url = "";
    	if(!empty($options)) {
	    	$url = "?".http_build_query($options);
	    }
	    
	    $curl = curl_init();

	    curl_setopt($curl, CURLOPT_URL, "https://www.facturation.pro/firms/".$this->_firmid."/".$name.".".$this->_format . $url);
		curl_setopt($curl, CURLOPT_USERPWD, $this->_login.":".$this->_password);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_COOKIESESSION, true);
		$return = curl_exec($curl);
		curl_close($curl);
		
		return $return;
    }
    
    private function getUnique($name, $_ID)
    {
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, "https://www.facturation.pro/firms/".$this->_firmid."/".$name."/".$_ID.".".$this->_format);
		curl_setopt($curl, CURLOPT_USERPWD, $this->_login.":".$this->_password);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_COOKIESESSION, true);
		$return = curl_exec($curl);
		curl_close($curl);
		
		return $return;
    }
    
    private function getPDF($name, $_ID){
    	if(!$_ID) { throw new MonaeException("Vous avez oublié l'ID !"); }
    
	    $curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://www.facturation.pro/firms/".$this->_firmid."/".$name."/".$_ID.".pdf");
		curl_setopt($curl, CURLOPT_USERPWD, $this->_login.":".$this->_password);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_COOKIESESSION, true);
		$return = curl_exec($curl);
		curl_close($curl);
    }

    private function newItem($name, $creation = "")
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://www.facturation.pro/firms/'.$this->_firmid.'/'.$name.'.'.$this->_format);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $creation);
        curl_setopt($curl, CURLOPT_USERPWD, $this->_login.":".$this->_password);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/".$this->_format));
                 
        $return = curl_exec($curl);
        curl_close($curl);  
        return $return;
    }
}

?>
