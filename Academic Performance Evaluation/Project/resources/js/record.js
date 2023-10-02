$(document).ready(function () {
  getStudent();
  getRecord();
});


function addRecord() {
  var subname = $("#subname").val();
  var subcode = $("#subcode").val();
  var subtype = $("#subtype").val();
  var midmarks = $("#midmarks").val();
  var sessionalmarks = $("#sessionalmarks").val();
  var endmarks = $("#endmarks").val();

  if (
    subname == "" ||
    subcode == "" ||
    subtype == "" ||
    midmarks == "" ||
    sessionalmarks == "" ||
    endmarks == ""
  ) {
    alert("Fields should not be blank!");
  } else {
    $.ajax({
      url: "../api/api.php",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      data: JSON.stringify({
        call: 8,
        subname: subname,
        subcode: subcode,
        subtype: subtype,
        midmarks: midmarks,
        sessionalmarks: sessionalmarks,
        endmarks: endmarks  
      }),
      success: function (data) {
        if (data == 1) {
          swal({
            title: "Record added!",
            text: "Record is added successfully!",
            icon: "success",
            button: "OK!",
          });

          $("#subname").val("");
          $("#subcode").val("");
          $("#midmarks").val("");
          $("#sessionalmarks").val("");
          $("#endmarks").val("");
          getRecord();
        } 
        else if(data==2){
          swal({
            title: "Subject already exists!",
            text: "Same subject cannot be added twice!",
            icon: "error",
            button: "OK!",
          });
        }
        else {
          swal({
            title: "Error!",
            text: "This item is already added in cart!",
            icon: "error",
            button: "OK!",
          });
        }
      },
    });
  }
}

function getStudent(){
  $.ajax({
    url: "../api/api.php",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      call: 13,
    }),
    success: function (data) {
      // console.log(data);
      $("#sname").html(data.name);
      $("#fname").html(data.fname);
      $("#roll").html(data.roll_no);
    },
  });
}

function getRecord() {
  $.ajax({
    url: "../api/api.php",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      call: 9,
    }),
    success: function (data) {
      console.log(data);
      var sr = 1;
      var records = "";
      var grade = '';
      var result_point = 1;
      var result = '';
      var performance = '';
      var overall_total = 0;
      var subject_total = 0;
      var sgpa = 0;

      if(data==0){
        $("#recordList").html('<p>No records available.</p>');
      }
      else{
        $.each(data, function (i, d) {
          overall_total = overall_total + parseInt(d.midmarks)+parseInt(d.sessionmarks)+parseInt(d.endmarks);
          subject_total = parseInt(d.midmarks)+parseInt(d.sessionmarks)+parseInt(d.endmarks);
  
  
          // grade calculation
          if(subject_total>=85){
            grade = 'A';
          }
          else if(subject_total>=75){
            grade = 'B';
          }
          else if(subject_total>=65){
            grade = 'C';
          }
          else if(subject_total>=50){
            grade = 'D';
          }
          else{
            grade = 'E';
          }
  
          // result checking
          if(subject_total<40){
            result_point = 0;
          }
  
          records +=
            "<tr>" +
            '<th scope="row">' +
            sr +
            "</th>" +
            '<td colspan="2">' +
            d.sname +
            "</td>" +
            '<td scope="col">' +
            d.scode +
            "</td>" +
            '<td scope="col">' +
            d.stype +
            "</td>" +
            '<td scope="col">' +
            d.midmarks +
            "/25</td>" +
            '<td scope="col">' +
            d.sessionmarks +
            "/25</td>" +
            '<td scope="col">' +
            d.endmarks +
            "/50</td>" +
            '<td scope="col">' +
            subject_total+
            "/100</td>" +
            '<td scope="col">' +
            grade+
            "</td>" +
            
            "</tr>";
          sr++;
        });

      sgpa = overall_total/(parseInt(data.length)*10);
      console.log(overall_total);

      // sgpa calculation
      if(sgpa>=8.5){
        performance = 'Excellent';
      }
      else if(sgpa>=7.0){
        performance = 'Very Good';
      }
      else if(sgpa>=5.5){
        performance = 'Good';
      }
      else if(sgpa>=4.0){
        performance = 'Poor';
      }
      else{
        performance = 'Very Poor';
      }

      // result calculation
      if(result_point==1){
        result = 'Pass';
      }
      else{
        result = 'Fail';
      }

      $("#recordList").html(
        '<div class="text-center"><div class="table-responsive-md" style="background-color:white">' +
          '<table class="table table-bordered">' +
          "<thead>" +
          "<tr>" +
          '<th scope="col">Sr. No.</th>' +
          '<th colspan="2">Subject Name</th>' +
          '<th scope="col">Subject Code</th>' +
          '<th scope="col">Subject Type</th>' +
          '<th scope="col">Mid Semester Marks</th>' +
          '<th scope="col">Sessional Marks</th>' +
          '<th scope="col">End Semester Marks</th>' +
          '<th scope="col">Total Marks Obtained</th>' +
          '<th scope="col">Grade</th>' +
          "</tr>" +
          "</thead>" +
          "<tbody>" +
          records +
          "</tbody>" +
          "</table>"+
          '</div></div><br>'+
          '<b>Result:</b> '+result+'<br>'+
          '<b>Performance:</b> '+performance+'<br>'+
          '<b>SGPA:</b> '+sgpa.toFixed(2)+'<br><br><hr>'+
          '<b>Note:</b><br>'+
          'Pass - Total Marks Obtained >= 40 <br>'+
          'Fail - Total Marks Obtained < 40 <br><br>'+
          'A - Total Marks Obtained >= 85 <br>'+
          'B - Total Marks Obtained >= 75 <br>'+
          'C - Total Marks Obtained >= 65 <br>'+
          'D - Total Marks Obtained >= 50 <br>'+
          'E - Total Marks Obtained < 50 <br>'
      );
      }
    },
  });
}
