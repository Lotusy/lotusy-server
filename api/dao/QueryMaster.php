<?php
class QueryMaster {

    private $errors = array();
    private $query = '';
    private $and = false;
    private $isInsert = false;
    private $connection = null;

// ============================================================================= transactional start

    private static $tran_connection = null; 

    public static function start_transaction() {
        if (!isset(self::$tran_connection)) {
            self::$tran_connection = new QueryMaster(FALSE);
            mysqli_autocommit(self::$tran_connection, FALSE);
        }

        return self::$tran_connection;
    }

    public static function commit($roll_back=TRUE, $end_transaction=TRUE) {
        $transactions = self::start_transaction();

        $errors = $transactions->get_errors();
        $qeuryResults = empty($errors);

        if ($qeuryResults) {
            mysqli_commit(self::$tran_connection);
        } else if ($roll_back) {
            mysqli_rollback(self::$tran_connection);
        }

        if ($end_transaction) { 
            mysqli_close(self::$tran_connection);
            self::$tran_connection = NULL;
        }

        return $qeuryResults;
    }

    public static function end_transaction() {
        self::$tran_connection = NULL;
    }

// =============================================================================== transactional end

    public function __construct($persist=TRUE) {
        if (isset(self::$tran_connection)) {
            return self::$tran_connection;
        }

        global $DB_HOST, $DB_USER, $DB_PASS, $DB_NAME;
        $db_host = $DB_HOST;
        $db_user = $DB_USER;
        $db_pass = $DB_PASS;
        $db_sche = $DB_NAME;

        if ($persist) { $db_host = 'p:'.$db_host; }

        $this->connection = mysqli_connect( $db_host, $db_user, $db_pass, $db_sche );

        if( !$this->connection->connect_errno ) {
            $this->connection->query("SET character_set_results=utf8");
            $this->connection->query("SET character_set_client=utf8"); 
            $this->connection->query("SET character_set_connection=utf8");
        } else {
            throw new Exception('Cannot establish db connection - '.$db_host, '1001');
        }
    }

    public function insertBatch($inserts, $table) {
        $this->isInsert = true;
        $this->and = false;

        $map = $inserts[0];
        $fileds = '(';
        foreach ($map as $key=>$val)
        {
            $fileds .= $key . ',';
        }
        $fileds = rtrim($fileds, ',') . ')';

        $values = '';
        foreach ($inserts as $insert) {
            $values .= '(';
            foreach ($insert as $key=>$val)
            {
                $values .= $this->checkNull($val) . ',';
            }
            $values = rtrim($values, ',') . '),';
        }
        $values = rtrim($values, ',');

        $this->query = "INSERT INTO $table $fileds VALUES $values";

        return $this;
    }

    public function insert($inserts, $table) {
        $this->isInsert = true;
        $this->and = false;

        $fileds = '(';
        $values = '(';
        foreach ($inserts as $key=>$val)
        {
            if ( isset($val) )
            {
                $fileds .= $key . ',';
                $values .= $this->checkNull($val) . ',';
            }
        }
        $fileds = rtrim($fileds, ',') . ')';
        $values = rtrim($values, ',') . ')';

        $this->query = "INSERT INTO $table $fileds VALUES $values";

        return $this;
    }

    public function update($set, $table, $expression=false) {
        $this->isInsert = false;
        $this->and = false;

        $update = "UPDATE $table SET ";
        foreach ($set as $key=>$val) {
            if ($expression) {
                $update.= $key.'='.$val.',';
            } else {
                $update.= $key.'='.$this->checkNull($val).',';
            }
        }

        $this->query = rtrim($update, ',');

        return $this;
    }

    public function select($fields, $table) {
        $this->isInsert = false;
        $this->and = false;

        $select = 'SELECT ';
        if (is_array($fields)) {
            foreach ($fields as $field) {
                $select.= $field.',';
            }
            $select = rtrim($select, ',');
        } else {
            $select.= trim($fields);
        }

        $this->query = $select.' FROM '.$table;

        return $this;
    }

    public function delete($table) {
        $this->isInsert = false;
        $this->and = false;

        $this->query = "DELETE FROM $table";

        return $this;
    }

    public function where($field, $value, $operator='=', $or=FALSE) {
        if ($this->and) {
            $where = $or ? ' OR ' : ' AND '; 
        } else {
            $where = ' WHERE ';
        }

        $where.= $field.' '.$operator.' '.$this->checkNull($value);

        $this->and = true;

        $this->query.= $where;

        return $this;
    }

    public function in($field, $range, $is_in=TRUE, $or=FALSE) {
        if ($this->and) {
            $in = $or ? ' OR ' : ' AND '; 
        } else {
            $in = ' WHERE ';
        }

        $operator = $is_in ? 'IN' : 'NOT IN';

        $in.= "`$field` $operator (";
        foreach ($range as $value) {
            $in.= "'".$value."',";
        }
        $in = rtrim($in, ',').')';

        $this->and = true;

        $this->query.= $in;

        return $this;
    }

	public function having($field, $value, $operator='=') {
		$having = ' HAVING';

		$having.=" $field ".$operator." '".mysqli_real_escape_string($this->connection, $value)."'";

		$this->query.= $having;

		return $this;
	}

    public function limit($start, $size) {
        $this->query.= " LIMIT $start, $size";

        return $this;
    }

    public function order($field, $desc=false) {
        $this->query.= " ORDER BY $field";

        if ($desc) {
            $this->query.= " DESC";
        }

        return $this;
    }

    public function group($field) {
        $this->query.= " GROUP BY $field";

        return $this;
    }

    public function query() {
    	global $DB_LOG_LEVEL;
        if ($DB_LOG_LEVEL>=2) {
           	Logger::info($this->query, Logger::DB);
        }

        if ($this->isInsert) {
            if ($this->connection->query($this->query)) {
                $result = $this->connection->insert_id;
            } else {
                $result = -1;
                array_push($this->errors, mysqli_error($this->connection));
            }
        } else {
            $result = $this->connection->query($this->query);
            if (!($result)) {
                array_push($this->errors, mysqli_error($this->connection));
            }
        }

        if ($DB_LOG_LEVEL>=1 && !empty($this->errors)) {
        	if ($DB_LOG_LEVEL<2) {
            	Logger::info($this->query, Logger::DB);
            }
            Logger::error(json_encode($this->errors), Logger::DB);
        }

        return $result;
    }

    public function find() {
        $this->query.= " LIMIT 1";

        $result = $this->query();

        if ($result) {
            $result = $result->fetch_array(MYSQLI_ASSOC);
        } else {
            $result = null;
        }

        return $result;
    }

    public function findList() {
        $result = $this->query();

        if ($result) {
            $res = array();
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                array_push($res, $row);
            }
            return $res;
        }

        return array();
    }

    public function getErrors() {
        return $this->errors;
    }

// ========================================================================================= private

    private function checkNull($input)
    {
        return (isset($input) ? "'". $this->connection->real_escape_string($input) . "'" : "NULL");
    }
}