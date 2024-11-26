<?php

class TopicController extends Controller
{
    public function create() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if(!$this->isLoggedIn()) {
            $this->redirect('user', 'login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('home', 'index');
            return;
        }

        if (!isset($_POST['title']) ||
            !isset($_POST['description']) ||
            $_POST['title'] == '' ||
            $_POST['description'] == '') {
            $this->redirect('home', 'index', ['error_msg' => 'Please fill out the form']);
            return;
        }

        $username = Session::getSession('login');
        $title = $_POST['title'];
        $description = $_POST['description'];

        $pdo = Database::getPDO();
        $topic_manager = new Topic($pdo);
        $user_manager = new User($pdo);
        $user_id = $user_manager->getUserId($username);

        if (!$topic_manager->createTopic($user_id, $title, $description)) {
            $this->redirect('home', 'index', ['error_msg' => $topic_manager->error_message]);
            return;
        }

        $this->redirect('home', 'index', ['success_msg' => 'Topic created successfully']);
    }

    public function voteUp() {
        $this->vote('up');
    }

    public function voteDown() {
        $this->vote('down');
    }

    public function vote($vote_type) {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if(!$this->isLoggedIn()) {
            $this->redirect('user', 'login');
            return;
        }

        $topic_id = $_GET['id'];
        $username = Session::getSession('login');

        $pdo = Database::getPDO();
        $vote_manager = new Vote($pdo);
        $user_manager = new User($pdo);
        $user_id = $user_manager->getUserId($username);

        if ($vote_manager->hasVoted($user_id, $topic_id)) {
            $this->redirect('home', 'index', ['error_msg' => 'You have already voted']);
            return;
        }

        if (!$vote_manager->vote($user_id, $topic_id, $vote_type)) {
            $this->redirect('home', 'index', ['error_msg' => $vote_manager->error_message]);
            return;
        }

        $this->redirect('home', 'index', ['success_msg' => 'Voted successfully']);
    }

    public function comment() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if(!$this->isLoggedIn()) {
            $this->redirect('user', 'login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('home', 'index');
            return;
        }

        if (!isset($_POST['comment']) ||
            $_POST['comment'] == '') {
            $this->redirect('home', 'index', ['error_msg' => 'Please fill out the form']);
            return;
        }

        $username = Session::getSession('login');
        $comment = $_POST['comment'];
        $topic_id = $_POST['topic_id'];

        $pdo = Database::getPDO();
        $comment_manager = new Comment($pdo);
        $user_manager = new User($pdo);
        $user_id = $user_manager->getUserId($username);

        if (!$comment_manager->addComment($user_id, $topic_id, $comment)) {
            $this->redirect('home', 'index', ['error_msg' => $comment_manager->error_message]);
            return;
        }

        $this->redirect('home', 'index', ['success_msg' => 'Comment created successfully']);
    }
}