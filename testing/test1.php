<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
      <script src="https://code.jquery.com/jquery-3.1.1.js"></script>

    </head>
    <body>

    </body>
</html>
<script src="https://www.gstatic.com/firebasejs/4.9.0/firebase.js"></script>
<script type="text/javascript">
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
var ref=firebase.database().ref('Voting/male');
ref.on('value',gotData, errData);

function gotData(data) {
  var testing = data.val();
  var keys = Object.keys(testing);

  for (var i = 0; i < keys.length; i++) {
    var k = keys[i];
    var age = testing[k].Age;
    var gender = testing[k].Gender;
    var height = testing[k].Height;
    var major = testing[k].Major;
    var name = testing[k].Name;
    var year = testing[k].Year;
    var dob = testing[k].DOB;
    var id = testing[k].ID;
    console.log(id, name, age, gender, height, major, year, dob);

  }
}
function errData(err) {

}
</script>
