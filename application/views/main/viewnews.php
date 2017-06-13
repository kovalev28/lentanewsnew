<?php

foreach ($data as $row) {
    if ($row['image'] == "") {
        echo '
        <div class="container">
          <div class="row">
			   <div class="col-lg-12">
			   <h1>' . $row['title'] . '</h1>
			   <p><h4>' . $row['description'] . '</h4></p>
			   </div>
          </div>
        </div>
        ';
    } else {
        echo '
        <div class="container">
          <div class="row">
			   <div class="col-lg-5">
			     <img src="' . $row['image'] . '" class="img-thumbnail" alt="Responsive image">
			   </div>
			   <div class="col-lg-7">
			   <h1>' . $row['title'] . '</h1>
			   <p><h4>' . $row['description'] . '</h4></p>
			   </div>
         </div>
       </div>
        ';
    }
}
?>