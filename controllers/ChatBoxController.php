<?php
include '../DAO/CommentDAO.php';
class ChatBoxController
{

    public function getchat()
    {
        $CommentDAO = new CommentDAO();
        $CommentDAO->getChat();
    }
    public function insertChat()
    {
        $CommentDAO = new CommentDAO();
        $CommentDAO->insertChat();
    }
    public function getusers()
    {
        $CommentDAO = new CommentDAO();
        $CommentDAO->getusers();
    }
    public function Search($sql)
    {
        $CommentDAO = new CommentDAO();
        $CommentDAO->searchUser($sql);
    }
}
