getStudents();

function addStudent() {
  var name = $("#name").val();
  var fname = $("#fname").val();
  var roll = $("#roll").val();
  var semester = $("#semester").val();
  var branch = $("#branch").val();

  if (
    name == "" ||
    fname == "" ||
    roll == "" ||
    semester == "" ||
    branch == ""
  ) {
    alert("Fields should be blank!");
  } else {
    $.ajax({
      url: "../api/api.php",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      data: JSON.stringify({
        call: 3,
        name: name,
        fname: fname,
        roll: roll,
        semester: semester,
        branch: branch,
      }),
      success: function (data) {
        if (data == 1) {
          swal({
            title: "Student added!",
            text: "New student added successfully!",
            icon: "success",
            button: "OK!",
          });

          $("#name").val("");
          $("#fname").val("");
          $("#roll").val("");
          $("#semester").val("");
          $("#branch").val("");
          getStudents();
        } 
        else if(data == 2){ 
          swal({
            title: "Student already exists!",
            text: "Use different roll no/branch/semester",
            icon: "info",
            button: "OK!",
          });
        }
        else{
          swal({
            title: "Error!",
            text: "Some error occured!",
            icon: "error",
            button: "OK!",
          });
        }
      },
    });
  }
}

function getStudents() {
  $.ajax({
    url: "../api/api.php",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      call: 4,
    }),
    success: function (data) {
      var sr = 1;
      var students = "";

      $.each(data, function (i, d) {
        students +=
          "<tr>" +
          '<th scope="row">' +
          sr +
          "</th>" +
          '<td colspan="2">' +
          d.name +
          "</td>" +
          '<td scope="col">' +
          d.roll_no +
          "</td>" +
          '<td scope="col">' +
          d.semester +
          "</td>" +
          '<td scope="col">' +
          d.branch +
          "</td>" +
          '<td scope="col">' +
          '<button class="btn btn-sm text-white" style="background-color:#341f97" onclick="getRecord('+d.id+')">Record</button>'
          "</td>" +
          "</tr>";
        sr++;
      });

      $("#studentList").html(
        '<div class="table-responsive-md" style="background-color:white">' +
          '<table class="table table-bordered">' +
          "<thead>" +
          "<tr>" +
          '<th scope="col">Sr.no.</th>' +
          '<th colspan="2">Name</th>' +
          '<th scope="col">Roll No</th>' +
          '<th scope="col">Semester</th>' +
          '<th scope="col">Branch</th>' +
          '<th scope="col">Action</th>' +
          "</tr>" +
          "</thead>" +
          "<tbody>" +
          students +
          "</tbody>" +
          "</table></div>"
      );
    },
  });
}

function getRecord(id){
  sid = id;
  $.ajax({
    url: "../api/api.php",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      call: 12,
      sid: sid,
    }),
    success: function (data) {
      if(data==1){
        window.location="record.php";
      }
    },
  });

}