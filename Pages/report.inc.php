



<div>
    <p class=" text-primary text-center">Select Period to Generate Report</Select></p>
</div>
<div class="row justify-content-center">
<div class="col-md-6">
<form action="Pages/reportgen.php" method="post">
<div class="row g-3 mt-4  m-5">
            <div class="col-md-6">
                <label for="Start_Date">Period_Start</label>
                <input type="date" name="period_start" id="Start_Date" class=" form-control">
            </div>
            <div class="col-md-6">
                <label for="End_Date">Period End</label>
                <input type="date" name="period_end" id="Start_Date"  class=" form-control">
            
            </div>
            <div class="row justify-content-center m-auto mt-4">
            <button type="submit" class=" btn btn-danger">Generate</button>
     
            </div>
         

</div>
</form>

</div>
</div>