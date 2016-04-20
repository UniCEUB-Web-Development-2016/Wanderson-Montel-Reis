<?PHP

class DBConnector{
	private $driver;
	private $host;
	private $port;
	private $username;
	private $password;
	
	public function __constructor($driver, $host, $port, $username, $password){
		$this->set_driver=$driver;
		$this->set_host=$host;
		$this->set_port=$port;
		$this->set_username=$username;
		$this->set_password=$password;
	}
	
public function Connection (){	
  $dns = $this->driver.':dbname='.$this->database.";host=".$this->host; 
        parent::__construct( $dns, $this->user, $this->pass );
}