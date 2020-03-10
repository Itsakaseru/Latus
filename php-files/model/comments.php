<?php
    class Comment() {
        private $_userId;
        private $_postId;
        private $_commenterId;
        private $_timeStamp;
        private $_contents;

        function __construct($user, $post, $commenter, $time, $contents) {
            $this->_userId = $user;
            $this->_postId = $post;
            $this->_commenterId = $commenter;
            $this->_timeStamp = $time;
            $this->_contents = $contents;
        }

        public function setUserId($id) { $this->_userId = $id; }
        public function setPostId($id) { $this->_postId = $id; }
        public function setCommenterId($id) { $this->_commenterId = $id; }
        public function setTime($time) { $this->_timeStamp = $time; }
        public function setContents($contents) { $this->_contents = $contents; }

        public function getUserId() { return $this->_userId; }
        public function getPostId() { return $this->_postId; }
        public function getCommenterId() { return $this->_commenterId; }
        public function getTime() { return $this->_timeStamp; }
        public function getContents() { return $this->_contents; }
    }
?>
