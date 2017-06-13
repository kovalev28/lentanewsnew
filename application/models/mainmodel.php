<?php

include_once 'application/core/database.php';

class mainmodel extends Model {
    
    //Функция загрузки и печати ленты новостей
    public function rssExpPrint() {
        $dbClass = new database();
        $dbh = $dbClass->getdb();

        $rss = "http://lenta.ru/rss/news";
        $xml = @simplexml_load_file($rss);
        if ($xml === false)
            die('Error parse RSS: ' . $rss);

        $i = 1;
        $n = 50;
        $statement = $dbh->prepare("INSERT INTO news(title, description, link, pubDate, image)
        VALUES(?,?,?,?,?)");

        foreach ($xml->xpath('//item') as $item) {
            $stmt = $dbh->query("SELECT * FROM news WHERE link = '$item->link'");
            $row_count = $stmt->rowCount();


            if ($row_count == 0) {
                if ($item->enclosure = !0) {
                    $enclosure = (string) $item->enclosure->attributes()->url;
                    $statement->execute(array($item->title, $item->description, $item->link, $item->pubDate = date("Y-m-d H:i:s"), $enclosure));
                } else {
                    $statement->execute(array($item->title, $item->description, $item->link, $item->pubDate = date("Y-m-d H:i:s"), ""));
                }
            }
            if ($i >= $n)
                break;
            $i++;
        }

        $stmt = $dbh->query('SELECT id,title FROM news ORDER BY id DESC LIMIT 50');
        $data = $stmt->fetchAll();
        return $data;
    }
    
    //Функция возвращает полную ин. о новости
    public function newsPrint($id_news) {
        $dbClass = new database();
        $dbh = $dbClass->getdb();

        $stmt = $dbh->query("SELECT * FROM news WHERE id = '$id_news'");
        $data = $stmt->fetchAll();
        return $data;
    }
    
    //Функция экспорта
    public function dbExp() {
        $dbClass = new database();
        $dbh = $dbClass->getdb();
        
        $newdate = date('Y-m-d');

        $result_users = $dbh->prepare("SELECT title, pubDate, link FROM news WHERE pubDate LIKE '%" . $newdate . "%'");
        $result_users->execute(array($_SESSION['current_group_id']));

        $list = array();

        while ($row = $result_users->fetch(PDO::FETCH_ASSOC)) {
            array_push($list, array_values($row));
        }

        return $list;
    }
}
