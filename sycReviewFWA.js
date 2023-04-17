
//When a table row with class="row_submit" is clicked, get the value of the first column of row selected (requestID),
//then pass it to reviewFWA2.php to get the FWA request details from the database
$(document).ready(function(){
  $('tr.row_submit').on('click', function(e){
    $rID = $(this).find("td:eq(0)").html().substr(2);
    $.post(
      "reviewFWA2.php",
      {rid: $rID},
      function(data) {

          $('#selectFWA').html(data); //show the output data in the div with id = selectFWA
          $('#selectFWA').show();
          $('#listEmp').hide();
          $('#fwaBtn').show();
        }
    );
  });
});


//When a table row with class="row_submit" is clicked, get the value of the second column of row selected (employeeID),
//then pass it to reviewPast.php to check if the employee has past FWA request in the database
$(document).ready(function(){
  $('tr.row_submit').on('click', function(e){
    $eID = $(this).find("td:eq(1)").html();
    $.post(
      "reviewPast.php",
      {eid: $eID},
      function(data) {
          $('#pastList').html(data); //show the output data in the div with id = pastList
        }
    );
  });
});

//show the list of employee
function showList(){
    var listEmp = document.getElementById("listEmp");
    var fwa = document.getElementById("selectFWA");
    var btn = document.getElementById("fwaBtn");

    btn.style.display="none";
    fwa.style.display="none";
    listEmp.style.display="block";
  }

  //show the list of past request
  function showPast(){
    var fwa = document.getElementById("selectFWA");
    var btn = document.getElementById("fwaBtn");
    var past = document.getElementById("pastList");
    var btnFWA = document.getElementById("backFWA");

    btn.style.display="none";
    fwa.style.display="none";
    past.style.display="block";
    btnFWA.style.display="block";
  }

  //show the FWA request of the employee
  function showFWA(){
    var fwa = document.getElementById("selectFWA");
    var btn = document.getElementById("fwaBtn");
    var past = document.getElementById("pastList");
    var btnFWA = document.getElementById("backFWA");

    btn.style.display="block";
    fwa.style.display="block";
    past.style.display="none";
    btnFWA.style.display="none";
  }