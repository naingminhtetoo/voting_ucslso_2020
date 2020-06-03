
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
    <script type="text/javascript">
    firebase.auth().onAuthStateChanged(function(user) {
    if (user) {

         window.location.href = "vote-index.php"

    } else {

    }
    });
    </script>
    <title></title>
  </head>
  <body>
    <div class="container-fluid voting-logo">
      <a class="text-center" href="#"><img src="images/mylogo.png" class=" mx-auto d-block" width="200px" alt="logo"></a>
    </div>
    <div class="login-state">
      <div class="container">
        <img src="images/ucslso.jpg" class="mx-auto d-block space-top-down"  alt="UCSLso0's Logo">
        <div class="button-center">


            <button type="submit" class="btn btn-primary login-button" id="facebook-login" onclick="window.location = '<?php echo $loginURL ?>'">
            <i class="fa fa-facebook-square" style="font-size:20px;color:white;line-height:1.3;"></i> Log in with Facebook
          </button>

        </div>
      </div>
    </div>
</body>
</html>

<script type="text/javascript">
    $("#facebook-login").click(function (){
        var provider = new firebase.auth.FacebookAuthProvider();
        //provider.addScope('user_birthday');
        firebase.auth().signInWithPopup(provider).then(function(result) {
        // This gives you a Facebook Access Token. You can use it to access the Facebook API.
        var token = result.credential.accessToken;
        // The signed-in user info.
        var user = result.user;

         window.location = "vote-index.php";


          }).catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        // The email of the user's account used.
        var email = error.email;
        // The firebase.auth.AuthCredential type that was used.
        var credential = error.credential;
        // ...
   });
    // if (firebase.auth().currentUser !== null)
     //   alert("user id: " + firebase.auth().currentUser.uid);
    });





</script>
