<?php
    class Disc {
        private $_id;
        private $_fname;
        private $_lname;

        public function setID($id) { $this->_id = $id; }
        public function setFName($fname) { $this->_fname = $fname; }
        public function setLName($lname) { $this->_lname = $lname; }

        public function getID() { return $this->_id; }
        public function getFName() { return $this->_fname; }
        public function getLName() { return $this->_lname; }
    }
?>
