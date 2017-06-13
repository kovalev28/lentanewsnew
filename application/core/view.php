<?php

class view {
    /*
      $content_file - виды отображающие контент страниц;
      $template_file - общий для всех страниц шаблон;
      $data - массив, содержащий элементы контента страницы.
     */

    function generate($contentView, $templateView, $puth, $data = null, $data2 = null) {

        if (is_array($data)) {

            // преобразуем элементы массива в переменные
            extract($data);
        }

        /*
          динамически подключаем общий шаблон (вид),
         */
        if ($templateView != NULL) {
            include 'application/views/layouts/' . $templateView;
        } else {
            include 'application/views/' . $puth . '/' . $contentView;
        }
    }
}
