<?php
    class Post {
        private $_userId;
        private $_postId;
        private $_contents;
        private $_pic;
        private $_timeStamp;

        function __construct($id, $postId, $contents, $pic, $timeStamp) {
            $this->_userId = $id;
            $this->_postId = $postId;
            $this->_contents = $contents;
            $this->_pic = $pic;
            $this->_timeStamp = $timeStamp;
            
        }

        public function setId($id) { $this->_userId = $id; }
        public function setContents($contents) { $this->_contents = $contents; }

        public function getId() { return $this->_id; }
        public function getPostId() { return $this->_postId; }
        public function getContents() { return $this->_contents; }
        public function getPic() { return $this->_pic; }
        public function getTime() { return $this->_timeStamp; }
    }
?>
