
//These are for the table which shows the summarized daily schedules of employee
    //When btnDaily is clicked, get the value of $start(startDate value) and $end (endDate value),
    //then pass them to viewAnalytics3.php to get the summarized daily schedule of employee in the department chosen
    $(document).ready(function() {
        $("#btnDaily").click(function(event){
        $.post(
            "viewAnalytics3.php",
            { start: $start, end: $end},
            function(data) {
                $('#dailyList').html(data); //show the output data in the div with id = dailyList
                $('#beforeTable').hide();
            }
        );
        });
    });

    function find() {
        $start= document.getElementById('startDate').value;
        $end= document.getElementById('endDate').value;
    }





//These are for the table which shows the number of employees making fwa request
    //define variables
    var inputDate, filter, dtable, tr, td, i, dateValue;

    //function to filter and show the data on the date selected by user
    function showDate() {
        inputDate = document.getElementById("dateInput");
        filter = inputDate.value;
        dtable = document.getElementById("mytable");
        tr = dtable.getElementsByTagName("tr");

        // Loop through all table rows, and hide the rows which don't match the input date value
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
            dateValue = td.textContent || td.innerText;
            if (dateValue.includes(filter)) { //if the table cell contain the input date value
                tr[i].style.display = "";  //show the table row with the data
            } else {
                tr[i].style.display = "none"; //hide the table row without the data
            }
            }
        }
    }

    //function to clear the filter date value and display back all table rows
    function refresh(){
        inputDate = document.getElementById("dateInput");
        dtable = document.getElementById("mytable");
        tr = dtable.getElementsByTagName("tr");

        inputDate.value = "";

        // Loop through all table rows and display all rows
        for (i = 0; i < tr.length; i++) {
            tr[i].style.display = "";
        }

    }


