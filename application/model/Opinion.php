<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitriy
 * Date: 11.04.12
 * Time: 0:54
 * To change this template use File | Settings | File Templates.
 */
namespace application\model;
class Opinion extends \library\Base
{
    static $add_opinion = "INSERT INTO opinions (title, author, email, text, type) VALUES(?, ?, ?, ?, ?)";
    static $read_opinion = "SELECT * FROM opinions WHERE id = ? LIMIT 1";
    static $edit_opinion = "UPDATE opinions SET title = ?, author = ?, email = ?, text = ?, type = ?, public = ? WHERE id = ?";
    static $delete_opinion = "DELETE FROM opinions WHERE id = ? LIMIT 1";
    static $list_opinions = "SELECT * FROM opinions WHERE public = 1";
    static $admin_list_opinions = "SELECT * FROM opinions WHERE public = 1";

    public function add_opinion($title, $author, $email, $text, $type)
    {
        $params = array($title, $author, $email, $text, $type);
        $this->doStatement(self::$add_opinion, $params);
        $id = self::$DB->lastInsertId();
        return $id;
    }

    public function list_opinions()
    {
        $result = self::$DB->query(self::$list_opinions);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function admin_list_opinions()
    {
        $result = self::$DB->query(self::$admin_list_opinions);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function edit_opinion($id, $title, $author, $email, $text, $type, $public)
    {
        $params = array($title, $author, $email, $text, $type, $public, $id);
        $this->doStatement(self::$edit_opinion, $params);
        $id = self::$DB->lastInsertId();
        return $id;
    }

    public function del_opinion($id) {
        $this->doStatement(self::$edit_opinion, array($id));
        return true;
    }
}
