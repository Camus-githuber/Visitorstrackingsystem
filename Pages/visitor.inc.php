


 	
<div class=" row d-flex justify-content-center">

    <div class='col-xl-2 col mt-4'>

        <select class="custom-select form-control" id="inputGroupSelect02" name="period">
        <option selected>Choose... Period</option>
        <option value="1">Today</option>
        <option value="2">Yesterday</option>
        <option value="3">This Week</option>
        <option value="4">This Month</option>
        <option value="5">This Year</option>
        </select>

    </div>

    <div class='col-xl-2 col'><label for="StartDate">Start_Date</label><input type='date' name='StartDate' id='StartDate' class='form-control'></div>

    <div class='col-xl-2 col'><label for="EndDate">End_Date</label><input type='date' name='EndDate' id='EndDate' class='form-control'></div>

</div>


<div class="row justify-content-center">
  <!-- <div class="col-lg-4"><input type="search" name="" id="search" class=" form-control mt-4" placeholder="search"></div> -->
      
      <div class="table-responsive col-md-10 mt-3">

            <div class="row justify-content-center">

                <div class=" col-md-10 mt-3">

                  <table class="table table-light table-striped" id="dtBasicExample">

                      <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">SSN</th>
                              <th scope="col">Email</th>
                              <th scope="col">Tel_Num</th>
                              <th scope="col">Gender</th>
                              <th scope="col">Total_Visits</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                      </tbody>

                  </table>

              </div>

            </div>

      </div>

</div>

</script> 
<script>
$(document).ready(function () {
  
  var pselect = ""
  var stardate = ""
  var enddate = ""
  
  $('#inputGroupSelect02').change(function(){
        // $('#dtBasicExample').DataTable();   
        pselect = $('#inputGroupSelect02').val();
        $.post('Pages/search.php',{
          period:pselect,
          StartDate:"",
          EndDate:""},
          function(data, status, jqXHR){
            $('table  tbody').empty()
            $('table  tbody').append(data)
            $('#dtBasicExample').DataTable(); 
          })

  
  })

  $('#StartDate,#EndDate').change(function(){
        // $('#dtBasicExample').DataTable(); 
        stardate = $('#StartDate').val()
        enddate = $('#EndDate').val()
        $.post('Pages/search.php',{
          period:" ",
          StartDate:stardate,
          EndDate:enddate},
          function(data, status, jqXHR){
            $('table  tbody').empty()
            $('table  tbody').append(data)
            $('#dtBasicExample').DataTable(); 
          })

  
  })

  $.post('Pages/search.php',{
          period:"",
          StartDate:"",
          EndDate:""},
          function(data, status, jqXHR){
            $('table  tbody').append(data)
            $('#dtBasicExample').DataTable(); 
          })

//   $("#search").on("keyup", function() {
//   var value = $(this).val().toLowerCase();
//     $("#dtBasicExample tbody tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
//   });
   
        
});

</script>