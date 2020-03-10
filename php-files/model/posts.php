<?php
    class Post() {
        private $_userId;
        private $_firstName;
        private $_lastName;
        private $_timeStamp;
        private $_contents;

        function __construct($id, $fname, $lname, $time, $contents) {
            $this->_userId = $id;
            $this->_firstName = $fname;
            $this->_lastName = $lname;
            $this->_timeStamp = $time;
            $this->_contents = $contents;
        }

        public function setId(id) { $this->_userId = $id; }
        public function setFName($fname) { $this->_firstName = $fname; }
        public function setLName($lname) { $this->_lastName = $lname; }
        public function setTime($time) { $this->_timeStamp = $time; }
        public function setContents($contents) { $this->_contents = $contents; }

        public function getId() { return $this->_id; }
        public function getFName() { return $this->_firstName; }
        public function getLName() { return $this->_lastName; }
        public function getTime() { return $this->_timeStamp; }
        public function getContents() { return $this->_contents; }
    }
?>
