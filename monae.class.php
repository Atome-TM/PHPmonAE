<?php
class MonaeException extends Exception { }

class MonAE
{
    private $_firmid;
    private $_login;
    private $_password;

    private $_format;
    private $_type;
    
    /*
     * Constructeur
     * 
     *  
     */
    public function __construct($_firmid, $_login, $_password, $_format = "json", $_type = false)
    {
        $this->set_firmid($_firmid);
        $this->set_login($_login);
        $this->set_password($_password);    
        $this->set_format($_format);    
        $this->set_type($_type);    
    }    
    
    /**
     * Set the firm ID
     * 
     * @param String $_firmid
     */
    private function set_firmid($_firmid)
    {
        if(!$_firmid) { throw new MonaeException('$_firmid doit être renseigné.'); }
        $this->_firmid = $_firmid;
    }     
    
    /**
     * Set the login access
     * 
     * @param String $_login
     */
    private function set_login($_login)
    {
        if(!$_login) { throw new MonaeException('$_login doit être renseigné.'); }
        $this->_login = $_login;
    }    
    
    /**
     * Set the password access
     * 
     * @param String $_password
     */ 
    private function set_password($_password)
    {
        if(!$_password) { throw new MonaeException('$_password doit être renseigné.'); }
        $this->_password = $_password;
    }
    
    /**
     * Set the return format
     * 
     * @param String $_format
     */ 
    public function set_format($_format)
    {
        if($_format != "json" AND $_format != "xml") 
            throw new MonaeException('Le format "'.$_format.'" n\'est pas autorisé. Formats autorisés : xml ou json.');
        $this->_format = $_format;
    }

    public function set_type($_type)
    {
        $type = strtolower($_type);
        $type = str_replace(array('_','-',' '), "", $_type);
        
        if($_type !== "array" && $_type !== "object" && $_type !== "objet" && $_type !== false) 
            throw new MonaeException('Le type de sortie en "'.$_type.'" n\'est pas autorisé. Types autorisés : array, object (ou objet) et false.');
        $this->_type = $_type;
    }
    
    /**
     *  CUSTOMERS
     *
     */
    
    /**
     * Get the list of all customers that corresponds with options
     * 
     * @param array $options
     *          int page
     *          int api_id
     *          int api_custom
     *          String company
     *          String last_name
     *          String email
     * 
     */
    public function getCustomers($options = array())
    {
        return $this->getListe("customers", $options);
    }
    
    /**
     * Get a customer with the $_ID
     * 
     * @param int $_ID
     */
    public function getCustomer($_ID)
    {
        return $this->getUnique("customers", $_ID);
    }

    
    /**
     * Create a new customer with options values
     * 
     * @param array $options
     * 
     */
    public function newCustomer($options = array())
    {
        return $this->newItem("customer","customers", $options);
    }
    
    /**
     * Quotes
     *
     */
    
    /**
     * Get the list of all quotes that corresponds with options
     * 
     * @param array $options
     *          int page
     *          int quote_ref
     *          String title
     *          int customer_id
     *          int api_id
     *          int api_custom
     *          String company
     *          String last_name
     * 
     */
    public function getQuotes($options = array())
    {
        return $this->getListe("quotes", $options);
    }
    
    
    /**
     * Get a quote with the $_ID
     * 
     * @param int $_ID
     *
     */
    public function getQuote($_ID)
    {
        return $this->getUnique("quotes", $_ID);
    }
    
    /**
     * Get the PDF's quote with the $_ID
     * 
     * @param int $_ID
     * @param bool $afficher
     *          Show or not the pdf document
     */
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
    
    /**
     * Create a new quote with options values
     * 
     * @param array $options
     * 
     */
    public function newQuote($options = array())
    {
        return $this->newItem("quote","quotes", $options);
    }
    
    /**
     * Invoices
     *
     */
    
    /**
     * Get the list of all invoices that corresponds with options
     * 
     * @param array $options
     *          int page
     *          int invoice_ref
     *          String title
     *          int customer_id
     *          int api_id
     *          int api_custom
     *          String company
     *          String last_name
     * 
     */
    public function getInvoices($options = array())
    {
        return $this->getListe("invoices", $options);
    }
    
    
    /**
     * Get a invoice with the $_ID
     * 
     * @param int $_ID
     */
    public function getInvoice($_ID)
    {
        return $this->getUnique("invoices", $_ID);
    }
    
    /**
     * Get the PDF's invoice with the $_ID
     * 
     * @param int $_ID
     * @param bool $afficher
     *          Show or not the pdf document
     */
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

    
    /**
     * Create a new invoice with options values
     * 
     * @param array $options
     * 
     */
    public function newInvoice($options = array())
    {
        return $this->newItem("invoice","invoices", $options);
    }
    
    /**
     * Suppliers
     *
     */
    
    /**
     * Get the list of all supplier that corresponds with options
     * 
     * @param array $options
     *          int page
     *          int api_id
     *          int api_custom
     *          String company
     * 
     */
    public function getSuppliers($options = array())
    {
        return $this->getListe("suppliers", $options);
    }
    
    
    /**
     * Get a supplier with the $_ID
     * 
     * @param int $_ID
     */
    public function getSupplier($_ID)
    {
        return $this->getUnique("suppliers", $_ID);
    }

    
    /**
     * Create a new supplier with options values
     * 
     * @param array $options
     * 
     */
    public function newSupplier($options = array())
    {
        return $this->newItem("supplier","suppliers", $options);
    }
    
    /**
     * Purchases
     *
     */
    
    /**
     * Get the list of all purchase that corresponds with options
     * 
     * @param array $options
     *          int page
     *          String title
     *          int api_id
     *          int api_custom
     *          String company
     * 
     */
    public function getPurchases($options = array())
    {
        return $this->getListe("purchases", $options);
    }
    
    
    /**
     * Get a purchase with the $_ID
     * 
     * @param int $_ID
     */
    public function getPurchase($_ID)
    {
        return $this->getUnique("purchases", $_ID);
    }
    
    /**
     * Create a new purchase with options values
     * 
     * @param array $options
     * 
     */
    public function newPurchase($options = array())
    {
        return $this->newItem("purchase","purchases", $options);
    }
    
    
    /**
     * Produits
     */
     
    /**
     * Get the list of all products that corresponds with options
     * 
     * @param array $options
     *          String ref
     *          String title
     *          int api_id
     *          int api_custom
     */
    public function getProducts($options = array())
    {
        $return = $this->getListe("products", $options);
        return $return;
    }    
    
    /**
     * Get a product with the $_ID
     * 
     * @param int $_ID
     */
    public function getProduct($_ID)
    {
        $return = $this->getUnique("products", $_ID);
        return $return;
    }    
    
    /**
     * Create a new product with options values
     * 
     * @param array $options
     *          String title
     *          int status
     */
    public function newCategory($options = array())
    {
        if($this->_format == "xml")
        {
            $creation = "<category>";
            foreach($options as $key => $value)
            {
                $creation .= "<$key>$value</$key>";
            }
            $creation .= "</category>";
        }
        if($this->_format == "json")
        {
            $creation = json_encode($options);
        }

        return $this->newItem("products", $creation);
    }
    
    /**
     * Categories
     */
     
    /**
     * Get the list of all categories that corresponds with options
     * 
     * @param array $options
     *          int page
     *          String title
     *          int status
     */
    public function getCategories($options = array())
    {
        $return = $this->getListe("categories", $options);
        return $return;
    }    
    
    /**
     * Get a category with the $_ID
     * 
     * @param int $_ID
     */
    public function getCategory($_ID)
    {
        $return = $this->getUnique("categories", $_ID);
        return $return;
    }    
    
    /**
     * Create a new category with options values
     * 
     * @param array $options
     *          String title
     *          int status
     */
    public function newCategory($options = array())
    {
        if($this->_format == "xml")
        {
            $creation = "<category>";
            foreach($options as $key => $value)
            {
                $creation .= "<$key>$value</$key>";
            }
            $creation .= "</category>";
        }
        if($this->_format == "json")
        {
            $creation = json_encode($options);
        }

        return $this->newItem("categories", $creation);
    }
    
    /**
     * Mains functions
     *
     */
    private function getListe($name, $options = array())
    {
        $url = "";
        if(!empty($options)) {
            $url = "?".http_build_query($options);
        }
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://www.facturation.pro/firms/".$this->_firmid."/".$name.".".$this->_format . $url);
        curl_setopt($curl, CURLOPT_USERPWD, $this->_login.":".$this->_password);
        curl_setopt($curl, CURLOPT_SSLVERSION, 3);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        $return = curl_exec($curl);
        curl_close($curl);
        
        return $this->get_output($return);
    }
    
    private function getUnique($name, $_ID)
    {
        if(!$_ID) { throw new MonaeException("Vous avez oublié l'ID !"); }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://www.facturation.pro/firms/".$this->_firmid."/".$name."/".$_ID.".".$this->_format);
        curl_setopt($curl, CURLOPT_USERPWD, $this->_login.":".$this->_password);
        curl_setopt($curl, CURLOPT_SSLVERSION, 3);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        $return = curl_exec($curl);
        curl_close($curl);

        return $this->get_output($return);
    }
    
    private function getPDF($name, $_ID){
        if(!$_ID) { throw new MonaeException("Vous avez oublié l'ID !"); }
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://www.facturation.pro/firms/".$this->_firmid."/".$name."/".$_ID.".pdf");
        curl_setopt($curl, CURLOPT_USERPWD, $this->_login.":".$this->_password);
        curl_setopt($curl, CURLOPT_SSLVERSION, 3);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        $return = curl_exec($curl);
        curl_close($curl);
       
       return $return;
    }

    private function newItem($name, $plurial, $options = array())
    {
        if($this->_format == "xml")
        {
            $creation = "<$name>";
            foreach($options as $key => $value)
            {
                $creation .= "<$key>";
                if(is_array($value)) {
                    foreach($value as $key2 => $value2)
                    {
                        $creation .= "<$key2>$value2</$key2>";
                    }
                }
                else
                {
                    $creation .= $value;
                }
                $creation .= "</$key>";
            }
            $creation .= "</$name>";
        } else if($this->_format == "json") {
            $creation = json_encode($options);
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://www.facturation.pro/firms/'.$this->_firmid.'/'.$plurial.'.'.$this->_format);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $creation);
        curl_setopt($curl, CURLOPT_USERPWD, $this->_login.":".$this->_password);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_SSLVERSION, 3);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/".$this->_format));
                 
        $return = curl_exec($curl);
        curl_close($curl);  
        return $this->get_output($return);
    }

    private function get_output($return)
    {
        if($this->_type === false)
        {
            return $return;
        }
        else
        {
            $array = $this->_type === "array" ? true : false;

            if($this->_format === "xml")
            {
                $return = new SimpleXmlElement($return);
                return json_decode(json_encode($return),$array);
            }
            elseif($this->_format === "json")
                return json_decode($return,$array);
        }
    }
}
?>
