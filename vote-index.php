 
<?php
  require_once "navbar.php";
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Voting Section</title>
     <script src="https://www.gstatic.com/firebasejs/4.9.0/firebase.js"></script>
     <script type="text/javascript">
      $(window).on('load', function () {
        getData($('#selection').text());
      });


     </script>
  </head>
  <body>
<!--
  voting view
-->
<div class="voting-type-name">
  <div class="container-fluid">
    <div class="bg-type-name">
      <h3 id="selection"><?php
        if(isset($_GET['param'])){
          if($_GET['param'] == 'Queen'){
            echo 'Queen';
          }
          else echo 'King';
        }
        else echo 'King';
      ?></h3>
    </div>
  </div>
</div>


<!--
  voting view
-->
<div class="voting-part">
  <div class="container voting-data">
    <div class="container-fluid waiting">
      <img src="images/ball-loading.gif" class="spinner-grow" alt="">
      <h5>Please Wait</h5>
    </div>
</div>
</div>

<!--
  about me
-->
<div class="about-me">
  <div class="container">
    <div class="row text-center">
      <div class="col">Copyright&copy; 2020 NAINGMINHTETOO All rights reserved.</div>
  </div>
  </div>
</div>

<!--
VotingData-Detail
-->

<div class="modal fade" id="viewmore-dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title vote-name" id="exampleModalLongTitle"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid viewmore-table">

        </div>
      </div>

    </div>
  </div>
</div>

<!-- votechoice -->
<div class="modal fade" id="votecategories" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title vote-name-id" id="exampleModalLongTitle">ME</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid view-choice">
          <h1>hello hello!</h1>
        </div>
      </div>

    </div>
  </div>
</div>

  </body>
</html>
<script src="js/action.js" ></script>
                                                                                                                                                                           
