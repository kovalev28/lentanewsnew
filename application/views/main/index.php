<div class="container">
    <div class="row">
        <h1>Лента новостей</h1>
    </div>
</div>
<?php
foreach ($data as $row) {
    echo '
         <div class="container">
            <div class="row">
                <div class="thumbnail">
				
                  <p>' . mb_substr($row['title'], 0, 200, 'UTF-8') . '</p>
				  <a href="/main/viewnews/' . $row["id"] . '" class="btn btn-success btn-xs">Подробнее</a>
                </div>
            </div>
         </div>
         ';
}
?>