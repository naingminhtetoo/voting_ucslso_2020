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



  $(document).on('click','.btnvoting', function() {
    var type = $(this).attr('id');
    var uid = $('.uid').val();
    var id = $("span#votedID").text();

    var gender = "";

    if($('#selection').text() == 'King') gender = 'male';
    else if($('#selection').text() == 'Queen') gender = 'female';

    var ref = firebase.database().ref('VoteUser/'+uid+'/'+gender);
    var data = {
      ID: id,
      Type: type,
      Name:$('#votenamehide').text()

    }
    ref.push(data);

     ref = firebase.database().ref('VoteCount/'+gender+'/'+type+'/'+id+'/');
    var data = {
      user:$('.user-name').text(),
    }
    ref.push(data);
    var url ="vote-index.php?param="+$('#selection').text();

    window.location.href = url;

  });

$(document).on('click','#view-more-btn', function() {
  var gender="",age = "" ,dob = "" ,height = "" ,major = "" ,year = "";
  var name = $(this).find('input#votename').val();
  var id = $(this).find('input#voteid').val();

  if(selection == 'King') gender = 'male';
  else if(selection == 'Queen') gender = 'female';
  var result = "";
  var ref=firebase.database().ref('Voting/'+gender+'/'+id);

  ref.once("value", function(snapshot) {
  snapshot.forEach(function(child) {
    switch (child.key) {
      case "Age":
        age = child.val();
        break;
      case "DOB":
        dob = child.val();
        break;
      case "Height":
        height = child.val();
        break;
      case "Major":
        major = child.val();
        break;
      case "Year":
        year = child.val();
        break;
    }
  });
  });
    result = "<table class='table table-striped'>"+
    "<tbody>"+
      "<tr>"+
      "<th scope='row'>ID</th>"+
      "<td>"+id+"</td>"+
    "</tr>"+
    "<tr>"+
      "<th scope='row'>Age</th>"+
      "<td>"+age+"</td>"+
    "</tr>"+
    "<tr>"+
      "<th scope='row'>DOB</th>"+
      "<td>"+dob+"</td>"+
    "</tr>"+
    "<tr>"+
      "<th scope='row'>Height</th>"+
      "<td>"+height+"</td>"+
    "</tr>"+
    "<tr>"+
      "<th scope='row'>Major</th>"+
      "<td>"+major+"</td>"+
    "</tr>"+
    "<tr>"+
      "<th scope='row'>Year</th>"+
      "<td>"+year+"</td>"+
    "</tr>"+
    "</tbody>"+
    "</table>";
    $('.vote-name').text(name);
    $('.viewmore-table').empty().append(result);

});


function getData(gender){
  if(gender == "King") gender = "male";
  else if(gender == "Queen") gender = "female";

  var refVoting = firebase.database().ref("Voting/");
refVoting.once("value")
  .then(function(snapshot) {

   var dataExist = snapshot.child(gender).exists();

   if(dataExist == true) {

     var ref=firebase.database().ref('Voting/'+gender);
     ref.on('value',gotData, errData);

   }
   else {
     var noData="<div class='container-fluid waiting'><img src='images/no-data-found.png' class='' alt=''>"+
                 "</div>";
        $('.voting-data').empty().append(noData);
   }

  });


  function gotData(data) {

    var check = 0;
    var result = "";
    var testing = data.val();
    var keys = Object.keys(testing);

    for (var i = 0; i < keys.length; i++) {
      var k = keys[i];
      var image = testing[k].Image;
      var name = testing[k].Name;
      var id = testing[k].ID;
      //console.log(id, name, age, gender, height, major, year, dob);


            if(check == 0){
                result += "<div class='card-deck card-margin'>"+
                   "<div class='card text-center card-margin'>"+
                       "<a href='#myModal"+id+"' role='button' data-toggle='modal'>"+
                           "<img class='card-img-top' src='"+image+"' height='350px' alt='"+name+"'>"+
                         "</a>"+
                       "<div class='modal fade' id='myModal"+id+"' tabindex='-1' role='dialog'"+ "arialabelledby='exampleModalCenterTitle' aria-hidden='true'>"+
                         "<div class='modal-dialog modal-dialog-centered' role='document'>"+
                                 "<div class='modal-content no-backgorund no-border'>"+
                                     "<div class='modal-header no-border'>"+
                                         "<button type='button' class='close color-white close-font' data-dismiss='modal'>"+
                                         "<span aria-hidden='true'>&times;</span>"+
                                         "</button>"+
                                     "</div>"+
                                     "<div class='modal-body' id='dynamic-content'>"+
                                         "<img src='"+image+"' class='img-fluid img-round' alt=''/>"+
                                         "<div class='card-img-overlay'>"+
                                             "<h5 class='card-title ' style='padding-left: 3px;'>"+name+"</h5>"+
                                         "</div>"+
                                     "</div>"+
                                 "</div>"+
                            "</div>"+
                         "</div>"+
                       "<div class='card-body'>"+
                       "<h5 class='card-title'>"+
                         "<span>"+name+"</span>"+
                         " <span><i class='fa fa-user' style='font-size:20px;color:#0069d9;'></i></span> "+
                         "<span>ID : "+id+"</span>"+
                       "</h5>"+
                       "<div class='text-center'>"+
                           "<a href='#' data-toggle='modal' data-target='#votecategories' class='btn btn"+id+" btn-primary button-margin dis-none' id='vote-btn'>"+
                             "<i class='fa fa-heart' ></i>"+
                             "<input type='hidden' id='voteid' value='"+id+"'>"+
                             "<input type='hidden' id='votename' value='"+name+"'>"+
                            " Vote</a>"+
                         "<a href='#' data-toggle='modal' data-target='#viewmore-dialog' class='btn btn-secondary button-margin'"+
                          "id='view-more-btn'>"+
                             "<i class='fa fa-folder' ></i>"+
                            " View More"+
                            " <input type='hidden' id='voteid' value='"+id+"'>"+
                            " <input type='hidden' id='votename' value='"+name+"'>"+
                         "</a>"+
                       "</div>"+
                     "</div>"+
                  " </div>";

            }
            else if(check % 3 == 0){
              result += "</div><div class='card-deck card-margin'>"+
                 "<div class='card text-center card-margin'>"+
                     "<a href='#myModal"+id+"' role='button' data-toggle='modal'>"+
                         "<img class='card-img-top' src='"+image+"' height='350px' alt='"+name+"'>"+
                       "</a>"+
                     "<div class='modal fade' id='myModal"+id+"' tabindex='-1' role='dialog'"+ "arialabelledby='exampleModalCenterTitle' aria-hidden='true'>"+
                       "<div class='modal-dialog modal-dialog-centered' role='document'>"+
                               "<div class='modal-content no-backgorund no-border'>"+
                                   "<div class='modal-header no-border'>"+
                                       "<button type='button' class='close color-white close-font' data-dismiss='modal'>"+
                                       "<span aria-hidden='true'>&times;</span>"+
                                       "</button>"+
                                   "</div>"+
                                   "<div class='modal-body' id='dynamic-content'>"+
                                       "<img src='"+image+"' class='img-fluid img-round' alt=''/>"+
                                       "<div class='card-img-overlay'>"+
                                           "<h5 class='card-title ' style='padding-left: 3px;'>"+name+"</h5>"+
                                       "</div>"+
                                   "</div>"+
                               "</div>"+
                          "</div>"+
                       "</div>"+
                     "<div class='card-body'>"+
                     "<h5 class='card-title'>"+
                       "<span>"+name+"</span>"+
                       " <span><i class='fa fa-user' style='font-size:20px;color:#0069d9;'></i></span> "+
                       "<span>ID : "+id+"</span>"+
                     "</h5>"+
                     "<div class='text-center'>"+
                         "<a href='#' data-toggle='modal' data-target='#votecategories' class='btn btn"+id+" btn-primary button-margin dis-none' id='vote-btn'>"+
                           "<i class='fa fa-heart' ></i>"+
                           "<input type='hidden' id='voteid' value='"+id+"'>"+
                           "<input type='hidden' id='votename' value='"+name+"'>"+
                          " Vote</a>"+
                       "<a href='#' data-toggle='modal' data-target='#viewmore-dialog' class='btn btn-secondary button-margin'"+
                        "id='view-more-btn'>"+
                           "<i class='fa fa-folder' ></i>"+
                          " View More"+
                          " <input type='hidden' id='voteid' value='"+id+"'>"+
                          " <input type='hidden' id='votename' value='"+name+"'>"+
                       "</a>"+
                     "</div>"+
                   "</div>"+
                " </div>";
                   check = 0;
            }
            else{
              result += ""+
                 "<div class='card text-center card-margin'>"+
                     "<a href='#myModal"+id+"' role='button' data-toggle='modal'>"+
                         "<img class='card-img-top' src='"+image+"' height='350px' alt='"+name+"'>"+
                       "</a>"+
                     "<div class='modal fade' id='myModal"+id+"' tabindex='-1' role='dialog'"+ "arialabelledby='exampleModalCenterTitle' aria-hidden='true'>"+
                       "<div class='modal-dialog modal-dialog-centered' role='document'>"+
                               "<div class='modal-content no-backgorund no-border'>"+
                                   "<div class='modal-header no-border'>"+
                                       "<button type='button' class='close color-white close-font' data-dismiss='modal'>"+
                                       "<span aria-hidden='true'>&times;</span>"+
                                       "</button>"+
                                   "</div>"+
                                   "<div class='modal-body' id='dynamic-content'>"+
                                       "<img src='"+image+"' class='img-fluid img-round' alt=''/>"+
                                       "<div class='card-img-overlay'>"+
                                           "<h5 class='card-title ' style='padding-left: 3px;'>"+name+"</h5>"+
                                       "</div>"+
                                   "</div>"+
                               "</div>"+
                          "</div>"+
                       "</div>"+
                     "<div class='card-body'>"+
                     "<h5 class='card-title'>"+
                       "<span>"+name+"</span>"+
                       " <span><i class='fa fa-user' style='font-size:20px;color:#0069d9;'></i></span> "+
                       "<span>ID : "+id+"</span>"+
                     "</h5>"+
                     "<div class='text-center'>"+
                         "<a href='#' data-toggle='modal' data-target='#votecategories' class='btn btn"+id+" btn-primary button-margin dis-none' id='vote-btn'>"+
                           "<i class='fa fa-heart'></i>"+
                           "<input type='hidden' id='voteid' value='"+id+"'>"+
                           "<input type='hidden' id='votename' value='"+name+"'>"+
                          " Vote</a>"+
                       "<a href='#' data-toggle='modal' data-target='#viewmore-dialog' class='btn btn-secondary button-margin'"+
                        "id='view-more-btn'>"+
                           "<i class='fa fa-folder' ></i>"+
                          " View More"+
                          " <input type='hidden' id='voteid' value='"+id+"'>"+
                          " <input type='hidden' id='votename' value='"+name+"'>"+
                       "</a>"+
                     "</div>"+
                   "</div>"+
                " </div>"
            }
            check++;
            checkVoteUser(id);





    }


    for (var j = 3; j > check; j--) {
        result+="<div class='card card-destroy'></div>";
    }
       result+="</div>";
       $('.voting-data').empty().append(result);

       result="";

       checkServer();

  }
  function errData(err) {

  }


}


function checkServer(){
  var getRef=firebase.database().ref('Server');
  getRef.once("value", function(snapshot) {
  snapshot.forEach(function(child) {

    if(child.key == 'Check' && child.val() == '1') $('a#vote-btn').show();
  });
  });

}

function checkVoteUser(id){
  var gender = "";
  var uid = $('.uid').val();
  var type = $('#selection').text();
  if($('#selection').text() == 'King') gender = 'male';
  else if($('#selection').text() == 'Queen') gender = 'female';

  var checkref=firebase.database().ref('VoteUser/'+uid);

  checkref.child(gender).orderByChild("ID").equalTo(id).once("value",snapshot => {
      if (snapshot.exists()){
        $('a.btn'+id).addClass('btn-success disabled').html("<i class='fa fa-check'></i> Voted");

      }

  });
}

var vote_list_ui = "";
$('.view-choice').hide();
$(document).on('click','#vote-btn', function() {

  var dataNameId ="<span id='votenamehide'>"+$(this).find('input#votename').val()+ "</span> <span><i class='fa fa-user'"+
                    "style='font-size:20px;color:#0069d9;'></i>"+
                    " ID : <span id='votedID'>"+$(this).find('input#voteid').val()+"</span></span>";
  $('.vote-name-id').empty().html(dataNameId);

  $('.view-choice').hide();
  vote_list_ui = ""

  if($("#selection").text() == 'King') getVoteTypeList('male');
  else if($("#selection").text() == 'Queen') getVoteTypeList('female');

});


$(document).on('click', '#profile-picture', function(){
  var gender={
    'King':'male',
    'Queen':'female'
  };
  vote_list_ui="";
  $('.voting-count table tbody').empty().hide();
  $.each(gender, function( key, value ) {
    getVoteTypeList1(key,value);
  });
});

function getVoteTypeList1(title,gender){
  var getRef=firebase.database().ref('CrownTitle');
  getRef.once('value', function(snapshot) {
    var snap = snapshot.val();
  //  alert(snapshot.val());
  var keys = Object.keys(snapshot.val());
  for (var i = 0; i < keys.length; i++) {

    var k = keys[i];
    var name  = snap[k].Name;

     checkVoteIsDone1(title,gender,name);

  }
});

}
function checkVoteIsDone1(title,gender, name){

  var uid = $('.uid').val();
  var type = title;

  //alert(gender+ " "+uid);

  var checkref=firebase.database().ref('VoteUser/'+uid);

  checkref.child(gender).orderByChild("Type").equalTo(name).once("value",snapshot => {
      if (!snapshot.exists()){
        //var userData = snapshot.val();
        vote_list_ui = "<tr><td>"+name+" "+type+"</td><td><span id='voteLeft'>left</span></td><td>"+
        "<i class='fa fa-minus' style='color:red'></i></td></tr>";
        $('#gotVoteCount').prepend(vote_list_ui).show();
        //alert(name);

      }
      else{
        vote_list_ui = "<tr><td>"+name+" "+type+"</td><td><span id='voted'>Voted</span></td><td>"+
        "<i class='fa fa-check'></i></td></tr>";
        $('#gotVoteCount').prepend(vote_list_ui).show();
      }
  });

}

function getVoteTypeList(gender){

  var getRef=firebase.database().ref('CrownTitle');
  getRef.once('value', function(snapshot) {
    var snap = snapshot.val();
  //  alert(snapshot.val());
  var keys = Object.keys(snapshot.val());
  for (var i = 0; i < keys.length; i++) {

    var k = keys[i];
    var name  = snap[k].Name;

     checkVoteIsDone(gender,name);

  }
});

}

function checkVoteIsDone(gender, name){
  var uid = $('.uid').val();
  var type = $('#selection').text();
  var voteOver=true;
  //alert(gender+ " "+uid);

  var checkref=firebase.database().ref('VoteUser/'+uid);

  checkref.child(gender).orderByChild("Type").equalTo(name).once("value",snapshot => {
      if (!snapshot.exists()){
        //var userData = snapshot.val();

            vote_list_ui += "<button type='button' id="+name+" class='btn btn-success btnvoting btn-block button-margin'>"+
                            ""+name+" "+type+""+
                            "</button>";
          $('.view-choice').empty().append(vote_list_ui).show();
        //alert(name);
        voteOver = false;
  }

  });
//  if(voteOver) {

    //var voteFinished="<h5 class='text-center dis-none'>You've not left any vote for <span style='color:#007bff;"+
                    "font-weight:bold;'>"+
                    ""+type+"</h5><p class='text-center dis-none'>You can check that in Your Profile</p>";
    //$('.view-choice').append(voteFinished).show();
//  }

}



function getmyChoice() {
  var uid = $('.uid').val();
  var type = $('#selection').text();
  var gender={
    'King':'male',
    'Queen':'female'
  };

  $('.voting-count table tbody').empty().hide();
  $.each(gender, function( key, value ) {

    var checkref=firebase.database().ref('VoteUser/'+uid);

    checkref.child(value).once("value",snapshot => {
        if (snapshot.exists()){
          var userData = snapshot.val();
          var keys = Object.keys(userData);
          for (var i = 0; i < keys.length; i++) {

            var k = keys[i];
            var id  = userData[k].ID;
            var type  = userData[k].Type;
            var name =  userData[k].Name;

            alert(name);
            alert(type);

          }
        }


    });
  });
}
