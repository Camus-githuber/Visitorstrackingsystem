
<p class="text-center">Select Period Below to See Record</p>
<div class="form-group row d-flex justify-content-center">
        <div class=" row d-flex justify-content-center">
    <div class='col-xl-2 col'><label for="StartDate">Start_Date</label><input type='date' name='StartDate' id='StartDate' class='form-control'required></div>
    <div class='col-xl-2 col'><label for="EndDate">End_Date</label><input type='date' name='EndDate' id='EndDate' class='form-control'required></div>
   
    

<script type="text/javascript">
    $(document).ready(function(){
        $('#StartDate').change(function(e){
            e.preventDefault()
            var start = $('#StartDate').val()
            $('#EndDate').change(function(e){
                e.preventDefault()
                var end = $('#EndDate').val()
            $.post(
                'Pages/dshboardhelp.php',{
                StartDate:start,
                EndDate:end
            },
            function(data,status,jqXHR){
                $('table > tbody').empty()
                $('table > tbody').append(data)
            }
            )
            })
           
        })
        

     }); 
 </script>

    <div class=' justify-content-center d-flex' id="result">
        <table class="table-light table-respoonsive table-striped table table-bordered mt-4">
            <thead>
                <tr>
                    <td><h3>Total Visitors</h3></td>
                    <td><h3>Total Visits</h3></td>
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
    </div>



</div>

<p></p>
 <p></p>