<?php
abstract class LotusyDaoParent {

    protected $var = array();

	protected $update = array();

	protected $fromdb = FALSE;


	public function __construct( $id=0 ) {
        if ($id==0) { $this->init(); }
        else { $this->retrieve($id); }
    }


    public static function getRange($ids, $idMap=false) {
        if (empty($ids)) return array();

        $class = get_called_class();

        $builder = new QueryMaster();
        $res = $builder->select('*', $class::$table)
                       ->in('id', $ids)
                       ->findList();
    
        $objs = self::makeObjectsFromSelectListResult($res, $class, $idMap);

        return $objs;
    }


    public static function saveBatch($daos) {
        if (empty($daos)) { return FALSE; }

        $inserts = array();
        foreach ($daos as $dao) {
            $inserts[] = $dao->toArray(array($dao->getTableName()));
        }

        $builder = new QueryMaster();
        $res = $builder->insertBatch($inserts, $dao->getTableName())
                       ->query();
        return $res;
    }


    protected function retrieve($id) {
		$idColumn = $this->getIdColumnName();

		$query = new QueryMaster();
		$res = $query->select('*', $this->getTableName())
					 ->where($idColumn, $id)
					 ->find();
    
        if (isset($res) && $res) {
            $this->var = $res;
            $this->fromdb = TRUE;
        } else {
            $this->init();
        }
    }


    public function save() {
        $id = $this->var[$this->getIdColumnName()];

        if ( isset($id) && !empty($id) && $id!=0 ) {
            $this->beforeUpdate();
            return $this->update();
        }
        else {
            $this->beforeInsert();
            return $this->insert();
        }
    }


    public function delete() {
        $id = $this->var[$this->getIdColumnName()];

		$this->beforeInsert();

        $builder = new QueryMaster();
        $res = $builder->delete($this->getTableName())
                       ->where($this->getIdColumnName(), $id)
                       ->query();
        if ($res) {
            $this->fromdb = FALSE;
        }

        return $res;
    }


    public function toArray($skips=array()) {
        $rv = $this->var;
        foreach ($skips as $skip) {
            unset($rv[$skip]);
        }
        return $rv;
    }


    public function isFromDatabase() {
        return $this->fromdb;
    }


    private function insert() {
		$idColumn = $this->getIdColumnName();

		$fields = $this->var;
		unset($fields[$idColumn]);

		$query = new QueryMaster();
		$res = $query->insert($fields, $this->getTableName())
					 ->query();

		$this->update = array_fill_keys(array_values($this->update), false);

		if ($res!=-1) {
		    $this->var[$idColumn] = $res;
		    $this->fromdb = TRUE;
		} else {
		    $message = '';
		    foreach ($query->getErrors() as $error) {
		        $message .= $error.' | ';
		    }
		    error_log('[DB ERROR] Insert Failed: ' . $message);
		}

		return $res!=-1;
    }


    private function update() {
        $idColumn = $this->getIdColumnName();

		$set = array();
		foreach ($this->update as $key=>$val) {
			if ($val) {
				$set[$key] = $this->var[$key];
			}
		}

		if (!empty($set)) {
    		$builder = new QueryMaster();
    		$res = $builder->update($set, $this->getTableName())
    				       ->where($idColumn, $this->var[$idColumn])
    					   ->query();
    	    if ($res) {
        		$this->update = array_fill_keys(array_values($this->update), false);
    	    }
		} else {
		    $res = true;
		}

		return $res;
    }


    protected static function makeObjectFromSelectResult($res, $class) {
        $object = null;
        if ($res) {
            $object = new $class;
            $object->var = $res;
            $object->fromdb = TRUE;
        }

        return $object;
    }


    protected static function makeObjectsFromSelectListResult($res, $class, $idMap=false) {
        $objects = array();
        if (isset($res)) {
            foreach ($res as $row) {
                $object = new $class;
                $object->var = $row;
                $object->fromdb = TRUE;
                if ($idMap) {
        			$idColumn = $object->getIdColumnName();
                	$objects[$object->var[$idColumn]] = $object;
                } else {
                	array_push($objects, $object);
                }
            }
        }

        return $objects;
    }

//====================================== override functions ======================================

    protected function beforeInsert() {}

    protected function beforeUpdate() {}

    protected function beforeDelete() {}

//====================================== abstract functions ======================================

    abstract protected function init();

	abstract public function getTableName();

	abstract protected function getIdColumnName(); 
}