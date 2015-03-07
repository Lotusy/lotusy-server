<?php
abstract class Model {

    protected $dao = null;

    public function __construct() {
        $this->init();

        return $this;
    }

    public static function alloc() {
        return new static();
    }

    public function getId() {
        if (isset($this->dao)) {
            return $this->dao->getId();
        }
        return 0;
    }

    public function initWithDao($dao) {
        $this->dao = $dao;
        return $this;
    }

    public function duplicate() {
        $model = new static();
        $model->dao = $model->dao->copy($this->dao);
        return $model;
    }

    public function delete() {
        if (isset($this->dao)) {
            $this->dao->delete();
        }
    }

    abstract public function init();

    abstract public function initWithId($id);

    public function persist() {
        if (isset($this->dao)) {
            $this->dao->save();
        }
    }
}
?>