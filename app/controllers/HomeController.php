<?php

class HomeController extends Controller
{
    public function index()
    {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!$this->isLoggedIn()) {
            $this->redirect('user', 'login');
            return;
        }

        // access state from previous request (using session) if it exists
        $error_msg = Session::getSession('error_msg') ?? '';
        $success_msg = Session::getSession('success_msg') ?? '';
        $title = Session::getSession('title') ?? '';
        $description = Session::getSession('description') ?? '';

        // reset all session state variables
        Session::setSession('error_msg', null);
        Session::setSession('success_msg', null);
        Session::setSession('title', null);
        Session::setSession('description', null);

        $pdo = Database::getPDO();
        $topic_manager = new Topic($pdo);
        $user_manager = new User($pdo);
        $vote_manager = new Vote($pdo);
        $comment_manager = new Comment($pdo);

        $username = Session::getSession('username');
        $topics = $topic_manager->getTopics();
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
            $topics[$key]['created_at'] = TimeFormatter::formatTimestamp(strtotime($topic['created_at']));
        }

        $this->render('home', [
            'username' => $username,
            'error_msg' => $error_msg,
            'success_msg' => $success_msg,
            'title' => $title,
            'description' => $description,
            'topics' => $topics
        ]);
    }
}