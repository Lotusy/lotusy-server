<?php
abstract class UserDaoGenerated extends LotusyDaoBase {

    protected function init() {
        $this->var['id'] = '';
        $this->var['external_type'] = '';
        $this->var['external_ref'] = '';
        $this->var['username'] = '';
        $this->var['nickname'] = '';
        $this->var['profile_pic'] = '';
        $this->var['description'] = '';
        $this->var['last_login'] = '';
        $this->var['superuser'] = '';
        $this->var['blocked'] = '';

        $this->update['id'] = false;
        $this->update['external_type'] = false;
        $this->update['external_ref'] = false;
        $this->update['username'] = false;
        $this->update['nickname'] = false;
        $this->update['profile_pic'] = false;
        $this->update['description'] = false;
        $this->update['last_login'] = false;
        $this->update['superuser'] = false;
        $this->update['blocked'] = false;
    }

    public function getId() {
        return $this->var['id'];
    }

    public function setExternalType($externalType) {
        $this->var['external_type'] = $externalType;
        $this->update['external_type'] = true;
    }
    public function getExternalType() {
        return $this->var['external_type'];
    }

    public function setExternalRef($externalRef) {
        $this->var['external_ref'] = $externalRef;
        $this->update['external_ref'] = true;
    }
    public function getExternalRef() {
        return $this->var['external_ref'];
    }

    public function setUsername($username) {
        $this->var['username'] = $username;
        $this->update['username'] = true;
    }
    public function getUsername() {
        return $this->var['username'];
    }

    public function setNickname($nickname) {
        $this->var['nickname'] = $nickname;
        $this->update['nickname'] = true;
    }
    public function getNickname() {
        return $this->var['nickname'];
    }

    public function setProfilePic($profilePic) {
        $this->var['profile_pic'] = $profilePic;
        $this->update['profile_pic'] = true;
    }
    public function getProfilePic() {
        return $this->var['profile_pic'];
    }

    public function setDescription($description) {
        $this->var['description'] = $description;
        $this->update['description'] = true;
    }
    public function getDescription() {
        return $this->var['description'];
    }

    public function setLastLogin($lastLogin) {
        $this->var['last_login'] = $lastLogin;
        $this->update['last_login'] = true;
    }
    public function getLastLogin() {
        return $this->var['last_login'];
    }

    public function setSuperuser($superuser) {
        $this->var['superuser'] = $superuser;
        $this->update['superuser'] = true;
    }
    public function getSuperuser() {
        return $this->var['superuser'];
    }

    public function setBlocked($blocked) {
        $this->var['blocked'] = $blocked;
        $this->update['blocked'] = true;
    }
    public function getBlocked() {
        return $this->var['blocked'];
    }

// ======================================================================================== override

    public function getTableName() {
        return 'user';
    }

    protected function getIdColumnName() {
        return 'id';
    }

    public function getShardDomain() {
        return 'l_acct_user';
    }
}
?>