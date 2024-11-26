<?php

class UserController extends Controller
{
    public function register()
    {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if ($this->isLoggedIn()) {
            $this->redirect('home', 'index');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->render('register');
            return;
        }

        if (!isset($_POST['username']) ||
            !isset($_POST['email']) ||
            !isset($_POST['password']) ||
            !isset($_POST['confirm-password']) ||
            $_POST['username'] == '' ||
            $_POST['email'] == '' ||
            $_POST['password'] == '' ||
            $_POST['confirm-password'] == '') {
            $this->render('register', ['error_msg' => 'Please fill out the form']);
            return;
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];

        $pdo = Database::getPDO();
        $user_manager = new User($pdo);

        if (!$user_manager->registerUser($username, $email, $password, $confirm_password)) {
            $this->render('register', [
                'error_msg' => $user_manager->error_message,
                'username' => $username,
                'email' => $email]);
            return;
        }

        // Successfully registered
        $this->redirect('user', 'login', ['registered' => 'Successfully registered']);
        exit();
    }

    public function login()
    {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if ($this->isLoggedIn()) {
            $this->redirect('home', 'index');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->render('login', ['successful' => Session::getSession('registered')]);
            Session::setSession('registered', null);
            return;
        }

        if (!isset($_POST['username']) ||
            !isset($_POST['password']) ||
            $_POST['username'] == '' ||
            $_POST['password'] == '') {
            $this->render('login', ['error_msg' => 'Please fill out the form']);
            return;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        $pdo = Database::getPDO();
        $user_manager = new User($pdo);

        if (!$user_manager->authenticateUser($username, $password)) {
            $this->render('login', [
                'error_msg' => $user_manager->error_message,
                'username' => $username]);
            return;
        }

        Session::setSession('login', $username);
        $this->redirect('home', 'index');
        exit();
    }

    public function profile() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!$this->isLoggedIn()) {
            $this->redirect('user', 'login');
            return;
        }

        $username = Session::getSession('login');

        $pdo = Database::getPDO();
        $topic_manager = new Topic($pdo);
        $vote_manager = new Vote($pdo);
        $user_manager = new User($pdo);
        $comment_manager = new Comment($pdo);

        $user_id = $user_manager->getUserID($username);

        $topics = $topic_manager->getCreatedTopics($user_id);
        $created_votes = $vote_manager->getUserVoteHistory($user_id);

        // process topic to include creator username
        //    vote count
        //    user vote status
        //    comments
        foreach ($topics as $key => $topic) {
            $topics[$key]['username'] = $user_manager->getUsername($topic['user_id']);
            $topics[$key]['votes'] = $vote_manager->getTopicVotes($topic['id']);
            // check if user has voted
            $topics[$key]['voted'] = $vote_manager->getUserVoteOption($topic['user_id'], $topic['id']) ?? '';
            $topics[$key]['comments'] = $comment_manager->getComments($topic['id']);
        }

        // process vote to include topic title and creator
        foreach ($created_votes as $key => $vote) {
            $topic = $topic_manager->getTopic($vote['topic_id']);
            $created_votes[$key]['topic'] = [
                'title' => $topic['title'],
                'creator' => $user_manager->getUsername($topic['user_id'])
            ];
        }

        $this->render('profile', [
            'username' => $username,
            'created_topics' => $topics,
            'created_votes' => $created_votes
        ]);
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) session_start();
        session_unset();
        session_destroy();
        $this->redirect('user', 'login');
    }
}
