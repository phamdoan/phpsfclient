# phpsfclient
Salesforce Force.com Toolkit SOAP API
- Install : composer require phamdoan/phpsfclient
- Doc detail : https://developer.salesforce.com/index.php?title=Getting_Started_with_the_Force.com_Toolkit_for_PHP&oldid=51397
- Query data
$this->mySforceConnection = new SforcePartnerClient();
$path = base_path() . '/soapclient/partner.wsdl.xml'; // link lưu trữ thông tin của API WSDL(a Lộc)
$this->mySforceConnection->createConnection($path);
$this->mySforceConnection->login($USERNAME, $PASSWORD);

$query = "SELECT Id, FirstName, LastName, Phone from Contact";

$response = $this->mySforceConnection->query($query);
