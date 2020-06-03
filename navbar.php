
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="stylesheet/style.css">
    <script src="https://www.gstatic.com/firebasejs/4.9.0/firebase.js"></script>
    <script src="/__/firebase/7.13.1/firebase-auth.js"></script>
    <script src="js/firebaseConfig.js"></script>

    <title></title>
    <script type="text/javascript">
    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
        // User is signed in.

          $('#profile-picture').attr('src',user.photoURL);
          $('.user-name').text(user.displayName);
          $('.uid').val(user.uid);

        } else {
          window.location.href = "voting-login.php";

        }
        });

    </script>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-white-border">
    <a class="navbar-brand nav-title " href="vote-index.php"><img src="images/mylogo.png" width="200px" alt=""></a>
      <button class="navbar-toggler nav-hide" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto ">

      </ul>
      <ul class="nav navbar-nav navbar-right ">
        <li class="nav-item">
            <a class="nav-link " href="#" id="selectionType">King</a>
      </li>
      <li class="nav-item ">
          <a class="nav-link" href="#" id="selectionType">Queen</a>
      </li>
      <li class="nav-item ">
          <a class="nav-link" href="#" style="font-weight:bold;" id="choice" data-toggle="modal" data-target="#myvotechoice">My Choice</a>
      </li>

        <li class="left-sm">
            <img src="images/ucslso.jpg" data-toggle="modal" data-target="#exampleModalCenter" class="rounded-circle img-shadow"  id="profile-picture" width="40px" height="40px"  alt="Profile">

           </li>

        <li class="left"></li>
      </ul>
    </div>
</nav>

<!-- points_logout -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title user-name" id="exampleModalLongTitle"></h4><input type="hidden" class='uid' value="">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid voting-count">
          <table class="table">
            <tbody id="gotVoteCount"></tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" id="facebook-logout" class="btn btn-primary"><i class="fa fa-sign-out" style="font-size: 18px;"></i> Log Out</button>
      </div>
    </div>
  </div>
</div>

<!-- my choice -->
<div class="modal fade" id="myvotechoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title " id="exampleModalLongTitle">My Voted Selection</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid voting-choice">
          <table class="table">
            <tbody></tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">
      var selection="";
      $(document).on('click', '#selectionType', function(){

        var value = $(this).text();
        var wait="<div class='container-fluid waiting'><img src='images/ball-loading.gif' class='spinner-grow' alt=''>"+
                  "<h5>Please Wait</h5>"+
                    "</div>";
        if(selection != value){
            $('.voting-data').empty().append(wait);
             $('#selection').text(value);
             selection = value;
          getData(value);
        }




      });



      $(document).on('click', '#facebook-logout', function(){

        firebase.auth().signOut().then(function() {

          window.location.href = "voting-login.php";
        }).catch(function(error) {
        });

      });

      $(document).on('click', '#profile-picture', function(){



      });
</script>
