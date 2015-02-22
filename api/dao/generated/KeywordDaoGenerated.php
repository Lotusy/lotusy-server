<?php
abstract class KeywordDaoGenerated extends LotusyDaoParent {

    protected static $table = 'keyword';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['code'] = null;
        $this->var['color'] = null;

        $this->update['id'] = false;
        $this->update['code'] = false;
        $this->update['color'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setCode($code) {
        if ($this->var['code'] !== $code) {
            $this->var['code'] = $code;
            $this->update['code'] = true;
        }
    }
    public function getCode() {
        return $this->var['code'];
    }

    public function setColor($color) {
        if ($this->var['color'] !== $color) {
            $this->var['color'] = $color;
            $this->update['color'] = true;
        }
    }
    public function getColor() {
        return $this->var['color'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}