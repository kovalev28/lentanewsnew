<?php

include_once 'application/core/database.php';

class maincontroller extends controller {

    function __construct() {
        $this->model = new mainmodel();
        $this->view = new view();
    }

    function actionindex() {
        $data = $this->model->rssExpPrint();
        $this->view->generate('index.php', 'template.php', 'main', $data);
    }
    
    //аction вывода полной ин. новости
    function actionviewnews($id_news) {
        if (isset($id_news)) {
            $data = $this->model->newsPrint($id_news);
            $this->view->generate('viewnews.php', 'template.php', 'main', $data);
        } else {
            echo 'Ошибка';
        }
    }
    
    //аction экспорт
    function actiondbexp() {
        $data = $this->model->dbExp();

        $filename = $_SESSION['current_group'] . '-' . date('d.m.Y') . '.csv';
        $fp = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        foreach ($data as $ferow) {
            fputcsv($fp, $ferow);
        }

        header('Refresh: 0; url=/');
    }

}
