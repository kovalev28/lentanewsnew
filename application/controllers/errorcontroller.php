<?php

class errorcontroller extends controller {

    function actionindex() {
        $this->view->generate('index.php', 'template.php', 'error');
    }
}
