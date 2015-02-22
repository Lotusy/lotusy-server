<?php
abstract class ItermDaoGenerated extends LotusyDaoParent {

    protected static $table = 'iterm';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['code'] = null;
        $this->var['type'] = null;
        $this->var['language'] = null;
        $this->var['description'] = null;
        $this->var['active'] = null;
        $this->var['modyfied_by'] = null;
        $this->var['ctime'] = null;
        $this->var['mtime'] = null;

        $this->update['id'] = false;
        $this->update['code'] = false;
        $this->update['type'] = false;
        $this->update['language'] = false;
        $this->update['description'] = false;
        $this->update['active'] = false;
        $this->update['modyfied_by'] = false;
        $this->update['ctime'] = false;
        $this->update['mtime'] = false;
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

    public function setType($type) {
        if ($this->var['type'] !== $type) {
            $this->var['type'] = $type;
            $this->update['type'] = true;
        }
    }
    public function getType() {
        return $this->var['type'];
    }

    public function setLanguage($language) {
        if ($this->var['language'] !== $language) {
            $this->var['language'] = $language;
            $this->update['language'] = true;
        }
    }
    public function getLanguage() {
        return $this->var['language'];
    }

    public function setDescription($description) {
        if ($this->var['description'] !== $description) {
            $this->var['description'] = $description;
            $this->update['description'] = true;
        }
    }
    public function getDescription() {
        return $this->var['description'];
    }

    public function setActive($active) {
        if ($this->var['active'] !== $active) {
            $this->var['active'] = $active;
            $this->update['active'] = true;
        }
    }
    public function getActive() {
        return $this->var['active'];
    }

    public function setModyfiedBy($modyfied_by) {
        if ($this->var['modyfied_by'] !== $modyfied_by) {
            $this->var['modyfied_by'] = $modyfied_by;
            $this->update['modyfied_by'] = true;
        }
    }
    public function getModyfiedBy() {
        return $this->var['modyfied_by'];
    }

    public function setCtime($ctime) {
        if ($this->var['ctime'] !== $ctime) {
            $this->var['ctime'] = $ctime;
            $this->update['ctime'] = true;
        }
    }
    public function getCtime() {
        return $this->var['ctime'];
    }

    public function setMtime($mtime) {
        if ($this->var['mtime'] !== $mtime) {
            $this->var['mtime'] = $mtime;
            $this->update['mtime'] = true;
        }
    }
    public function getMtime() {
        return $this->var['mtime'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}