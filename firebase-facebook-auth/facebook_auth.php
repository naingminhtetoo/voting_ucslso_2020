<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Facebook Auth</title>
    </head>
    <body>
        
        <button onclick="signin()"id="sign-in">
            Sign in with Facebook
        </button>
        <div id="profile-pic">
            
        </div>
        
        <div id="user-email">
            
        </div>
        <div id="display-name">
            
        </div>
        <div id="display-id">
            
        </div>
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.9.0/firebase.js"></script>
<script src="/__/firebase/7.13.1/firebase-auth.js"></script>
<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyCNUaifnyXbqmW9D13PI13blzmSe_pdhss",
    authDomain: "auth-testing-53e02.firebaseapp.com",
    databaseURL: "https://auth-testing-53e02.firebaseio.com",
    projectId: "auth-testing-53e02",
    storageBucket: "auth-testing-53e02.appspot.com",
    messagingSenderId: "937591478393",
    appId: "1:937591478393:web:b0f96e154f293bc4e05ca8",
    measurementId: "G-KSBYEDGH9B"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>
<script type="text/javascript">
    function signin() {

    var provider = new firebase.auth.FacebookAuthProvider();
    provider.addScope('user_birthday');
    firebase.auth().signInWithPopup(provider).then(function(result) {
  // This gives you a Facebook Access Token. You can use it to access the Facebook API.
  var token = result.credential.accessToken;
  // The signed-in user info.
  var user = result.user;
  // ...
  console.log(user);
 
  var userEmail = document.querySelector("#user-email");
 userEmail.innerHTML = user.email;
 
 var displayName = document.querySelector("#display-name");
  displayName.innerHTML = user.displayName;
  
  var displayName = document.querySelector("#display-id");
  displayName.innerHTML = user.uid;
  
  var img = document.createElement('img');
  img.src = user.photoURL;
  document.getElementById("profile-pic").appendChild(img);
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

    
    }
</script>
