<?php 

namespace Lotus\Framework\Session;

use Lotus\Framework\Facade\DatabaseFacade as DB;
use Lotus\Framework\Exception\DatabaseException as DatabaseException;

class WPSessionHandler implements \SessionHandlerInterface {


	var $table;
	var $idCol;
	var $dataCol;
	var $lifetimeCol;
	var $timeCol;


	function __construct() {

        $this->table = DB::prefix()."lf_session";
        $this->idCol = "sess_id";
        $this->dataCol = "sess_data";
        $this->lifetimeCol = "sess_time";
        $this->timeCol = "sess_lifetime";

        // Create session table
        $this->initTable();
        
        $this->write(2,2);

	}

    function initTable() {

        // If table not exist ,create the table
        $tableExist = DB::execute("SHOW TABLES LIKE '{$this->table}'");

        if(!$tableExist) {
            $result = DB::execute("CREATE TABLE `$this->table` (
                `{$this->idCol}` VARBINARY(128) NOT NULL PRIMARY KEY,
                `{$this->dataCol}` BLOB NOT NULL,
                `{$this->colSess_time}` INTEGER UNSIGNED NOT NULL,
                `{$this->timeCol}` MEDIUMINT NOT NULL
            ) COLLATE utf8_bin, ENGINE = InnoDB;");

            $tableExist = DB::execute("SHOW TABLES LIKE '{$this->tableName}'");

            // Check table creation result, if not throw error
            if(!$tableExist)
                throw new DatabaseException('Fail to create database session table');
        }

    }

	/**
     * Re-initializes existing session, or creates a new one.
     *
     * @see http://php.net/sessionhandlerinterface.open
     *
     * @param string $savePath    Save path
     * @param string $sessionName Session name, see http://php.net/function.session-name.php
     *
     * @return bool true on success, false on failure
     */
    public function open($savePath, $sessionName) {

    	// LF Always boot after WP, which means database is ready to use. If not, WP can't be started
    	return true;
    }

    /**
     * Closes the current session.
     *
     * @see http://php.net/sessionhandlerinterface.close
     *
     * @return bool true on success, false on failure
     */
    public function close() {

    }

    /**
     * Reads the session data.
     *
     * @see http://php.net/sessionhandlerinterface.read
     *
     * @param string $sessionId Session ID, see http://php.net/function.session-id
     *
     * @return string Same session data as passed in write() or empty string when non-existent or on failure
     */
    public function read($sessionId) {

        $selectSql = $this->getSelectSql();
        $selectStmt = $this->pdo->prepare($selectSql);
        $selectStmt->bindParam(':id', $sessionId, \PDO::PARAM_STR);
        $selectStmt->execute();

        $sessionRows = $selectStmt->fetchAll(\PDO::FETCH_NUM);

    }

    /**
     * Writes the session data to the storage.
     *
     * Care, the session ID passed to write() can be different from the one previously
     * received in read() when the session ID changed due to session_regenerate_id().
     *
     * @see http://php.net/sessionhandlerinterface.write
     *
     * @param string $sessionId Session ID , see http://php.net/function.session-id
     * @param string $data      Serialized session data to save
     *
     * @return bool true on success, false on failure
     */
    public function write($sessionId, $data) {

        $maxlifetime = (int) ini_get('session.gc_maxlifetime');

        $mergeSql = $this->mergeSql();

        DB::prepare($mergeSql);
        
        DB::bind(':id', $sessionId);
        DB::bind(':data', $data);
        DB::bind(':lifetime',$maxlifetime);
        DB::bind(':time',time());

        DB::execute();

        //Clean ?

        DB::prepare('asdsad ? adsasd');

        DB::bind('todi');

        DB::bind(array('todi','asdas','adads')) ;

        return true;
   
    }

    /**
     * Destroys a session.
     *
     * @see http://php.net/sessionhandlerinterface.destroy
     *
     * @param string $sessionId Session ID, see http://php.net/function.session-id
     *
     * @return bool true on success, false on failure
     */
    public function destroy($sessionId) {

    }

    /**
     * Cleans up expired sessions (garbage collection).
     *
     * @see http://php.net/sessionhandlerinterface.gc
     *
     * @param string|int $maxlifetime Sessions that have not updated for the last maxlifetime seconds will be removed
     *
     * @return bool true on success, false on failure
     */
    public function gc($maxlifetime) {

    }

    public function mergeSQL() {
       return "INSERT INTO $this->table ($this->idCol, $this->dataCol, $this->lifetimeCol, $this->timeCol) 
               VALUES (:id, :data, :lifetime, :time) ".
               "ON DUPLICATE KEY UPDATE $this->dataCol = VALUES($this->dataCol), $this->lifetimeCol = VALUES($this->lifetimeCol), $this->timeCol = VALUES($this->timeCol)";
       
    }

}