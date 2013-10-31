<?php
// classes/EmailTracker.php

class EmailTracker {
    private $mysql; // mysql resource connection
    private $campaignID; // the email campaign ID
    
    /**
     * Initialize the EmailTracker.
     * In this class, we are also connecting to the 
     * MySQL server.  In a larger project, connections would
     * be managed by a separate Database abstraction
     * class
	 * 
	 * @param the id of the email campaign
     */
    public function __construct($campaignID, $settings) {
        // connect to mysql server.  
        $this->mysql = mysqli(
            $settings['server'],
            $settings['username'],
            $settings['password'],
            $settings['schema']);
        if ($this->mysql->connect_errno) {
            throw new Exception("MySQL connection error: ".$this->mysql->connect_errno);
        }
        
        $this->campaignID = $campaignID;
    }
    
    public function __destruct() {
        mysql_close($this->mysql);.
    }
    
    /**
     * Record that a client has opened the email in the Database
     */
    public openedBy($subscriptionID, $timestamp) {
        $sql = "insert into `".get_class($this)."` ";
        $sql .= "(campaignID, subscriptionID, timestamp) ";
        $sql .= " values ";
        $sql .= "('".$campaignID."','".$subscriptionID."','".$timestamp."')";
        
        $result = $this->mysqli->query($sql);
        if (!$result) {
            throw new Exception("MySQL Query Error: ".mysql->error());
        }
    }
}

?>
