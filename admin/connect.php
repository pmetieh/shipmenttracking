<?php 
//session_start();
include_once('utils.php');
//connect.php
?>
<?php
 class Connection{
    
   public $server = 'localhost'; //23.229.192.5
   public $username	= 'root'; //lhdiroot
   public $password	= ''; //Pp19690305# P03051969#''
   public $database	= 'cms'; //lhdicms
   
   public $mysql;
   
   public function __construct() 
   {
        $this->mysql  = new mysqli($this->server, $this->username, $this->password, $this->database);
        if(!($this->mysql))
        {
            
        	exit('Error: could not establish database connection');
        }
        else{
            alert('Connected to database...');
            //return $mysql;
        } 
    }
    
    public function query_insert($queryString){
        
            $query = $this->mysql->prepare($query_string);
            ///print_r('Query '.$query);
            $query->bind_param('s', $countryName);
            $query->execute();
            $query->close();
            
    }
}

?>