<?php
    class Comment() {
        private $_userId;
        private $_firstName;
        private $_lastName;
        private $_email;
        private $_birthDate;
        private $_gender;
        private $_pic;
        private $_cover;
        private $_theme;

        function __construct($id, $fname, $lname, $email, $bdate, $gender, $pic, $cover, $theme) {
            $this->_userId = $id;
            $this->_firstName = $fname;
            $this->_lastName = $lname;
            $this->_email = $email;
            $this->_birthDate = $bdate;
            $this->_gender = $gender;
            $this->_pic = $pic;
            $this->_cover = $cover;
            $this->_theme = $theme;
        }

        public function setUserId($id) { $this->_userId = $id; }
        public function setFName($fname) { $this->_firstName = $fname; }
        public function setLName($lname) { $this->_lastName = $lname; }
        public function setEmail($email) { $this->_email = $email; }
        public function setBirthDate($bdate) { $this->_birthDate = $bdate; }
        public function setGender($gender) { $this->_gender = $gender; }
        public function setPicture($pic) { $this->_pic = $pic; }
        public function setCover($cover) { $this->_cover = $cover; }
        public function setTheme($theme) { $this->_theme = $theme; }

        public function getUserId() { return $this->_userId; }
        public function getFName() { return $this->_firstName; }
        public function getLName() { return $this->_lastName; }
        public function getEmail() { return $this->_email; }
        public function getBirthDate() { return $this->_birthDate; }
        public function getGender() { return $this->_gender; }
        public function getPicture() { return $this->_pic; }
        public function getCover() { return $this->_cover; }
        public function getTheme() { return $this->_theme; }
    }
?>
