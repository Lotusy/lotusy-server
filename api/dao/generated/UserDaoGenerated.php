<?php
abstract class UserDaoGenerated extends LotusyDaoParent {

    protected static $table = 'user';

    protected function init() {
        $this->var['id'] = 0;
        $this->var['email'] = null;
        $this->var['password'] = null;
        $this->var['username'] = null;
        $this->var['nickname'] = null;
        $this->var['gender'] = null;
        $this->var['rank'] = null;
        $this->var['profile_pic'] = null;
        $this->var['description'] = null;
        $this->var['last_login'] = null;
        $this->var['superuser'] = null;
        $this->var['blocked'] = null;

        $this->update['id'] = false;
        $this->update['email'] = false;
        $this->update['password'] = false;
        $this->update['username'] = false;
        $this->update['nickname'] = false;
        $this->update['gender'] = false;
        $this->update['rank'] = false;
        $this->update['profile_pic'] = false;
        $this->update['description'] = false;
        $this->update['last_login'] = false;
        $this->update['superuser'] = false;
        $this->update['blocked'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setEmail($email) {
        if ($this->var['email'] !== $email) {
            $this->var['email'] = $email;
            $this->update['email'] = true;
        }
    }
    public function getEmail() {
        return $this->var['email'];
    }

    public function setPassword($password) {
        if ($this->var['password'] !== $password) {
            $this->var['password'] = $password;
            $this->update['password'] = true;
        }
    }
    public function getPassword() {
        return $this->var['password'];
    }

    public function setUsername($username) {
        if ($this->var['username'] !== $username) {
            $this->var['username'] = $username;
            $this->update['username'] = true;
        }
    }
    public function getUsername() {
        return $this->var['username'];
    }

    public function setNickname($nickname) {
        if ($this->var['nickname'] !== $nickname) {
            $this->var['nickname'] = $nickname;
            $this->update['nickname'] = true;
        }
    }
    public function getNickname() {
        return $this->var['nickname'];
    }

    public function setGender($gender) {
        if ($this->var['gender'] !== $gender) {
            $this->var['gender'] = $gender;
            $this->update['gender'] = true;
        }
    }
    public function getGender() {
        return $this->var['gender'];
    }

    public function setRank($rank) {
        if ($this->var['rank'] !== $rank) {
            $this->var['rank'] = $rank;
            $this->update['rank'] = true;
        }
    }
    public function getRank() {
        return $this->var['rank'];
    }

    public function setProfilePic($profile_pic) {
        if ($this->var['profile_pic'] !== $profile_pic) {
            $this->var['profile_pic'] = $profile_pic;
            $this->update['profile_pic'] = true;
        }
    }
    public function getProfilePic() {
        return $this->var['profile_pic'];
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

    public function setLastLogin($last_login) {
        if ($this->var['last_login'] !== $last_login) {
            $this->var['last_login'] = $last_login;
            $this->update['last_login'] = true;
        }
    }
    public function getLastLogin() {
        return $this->var['last_login'];
    }

    public function setSuperuser($superuser) {
        if ($this->var['superuser'] !== $superuser) {
            $this->var['superuser'] = $superuser;
            $this->update['superuser'] = true;
        }
    }
    public function getSuperuser() {
        return $this->var['superuser'];
    }

    public function setBlocked($blocked) {
        if ($this->var['blocked'] !== $blocked) {
            $this->var['blocked'] = $blocked;
            $this->update['blocked'] = true;
        }
    }
    public function getBlocked() {
        return $this->var['blocked'];
    }

    public function getTableName() {
        return self::$table;
    }

    protected function getIdColumnName() {
        return 'id';
    }
}