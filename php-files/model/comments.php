<?php
    class Comment {
        private $_postId;
        private $_commenterId;
        private $_userId;
        private $_firstName;
        private $_lastName;
        private $_pic;
        private $_contents;
        private $_timeStamp;

        function __construct($postId, $commenterId, $userId, $firstName, $lastName, $pic, $contents, $timeStamp) {
            $this->_postId = $postId;
            $this->_commenterId = $commenterId;
            $this->_userId = $userId;
            $this->_firstName = $firstName;
            $this->_lastName = $lastName;
            $this->_pic = $pic;
            $this->_contents = $contents;
            $this->_timeStamp = $timeStamp;
        }

        public function getPostId() { return $this->_postId; }
        public function getCommenterId() { return $this->_commenterId; }
        public function getUserId() { return $this->_userId; }
        public function getFName() { return $this->_firstName; }
        public function getLName() { return $this->_lastName; }
        public function getPic() { return $this->_pic; }
        public function getContent() { return $this->_contents; }
        public function getTime() { return $this->_timeStamp; }
    }
?>
