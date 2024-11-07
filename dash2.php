
    <!-- partial:partials/_navbar.html -->
    <?php require 'header.php';?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php require 'sidebar.php';?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <!--begin-->
<?php 
require 'class/database.php';
$database= new database;

$conn=$database->dbConnect();
$officers=$conn->query("select * from officers");
$officer=mysqli_num_rows($officers);

$conn=$database->dbConnect();
$Appart=$conn->query("select * from buildings where house_type='apartment'");
$AppartNo=mysqli_num_rows($Appart);


$conn=$database->dbConnect();
$single=$conn->query("select * from buildings where house_type='single'");
$singles=mysqli_num_rows($single);

?>

        <div class="modal" tabindex="-1" role="dialog" id='addofficermodal' style='font-weight:bold' >
        <div class="modal-dialog" role="document">
          <div class="modal-content" >
            <div class="modal-header">
              <h5 id='drivermodal' class="modal-title">Add new Officer</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" id='addofficer'>
            <div class="modal-body">
            <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1">
                  <div class="form-group">
                      <label class="text-muted mandatory">Officer Name</label>
                      <input type="text" required class="form-control" id='name' name='Oname'>
                      <input type="text"  id='driveraction' hidden  name='action' value='addofficer'>
                      <input type="text"  id='driverids' hidden  name='driverid' value=''>
                  </div>
                  <div class="form-group" style="margin-left:10px">
                      <label class="text-muted mandatory">Email</label>
                      <input type="text" required class="form-control" id='email' name='email'>
                  </div>
              </div>
      
          <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1">
              
              <div class="form-group" style="">
                 <label class="text-muted mandatory">Date of Birth</label>
                 <input type="date" name='DoB' id='officerbirth' class="datepicker form-control">
              </div>
              <div class="form-group" style="margin-left:10px">
                      <label class="text-muted mandatory">Id No</label>
                      <input type="text" required class="form-control" id='driverid' name='idno'>
                     
                  </div>
          </div>
          <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1">
      
          <div class="form-group" style='width:228px'>
              <label class="text-muted mandatory">Officer No</label>
              <input type="text" name='officerNo'id='officerno' required class="form-control">
          </div>
          
          <div class="form-group" style='width:228px'>
              <label class="text-muted mandatory">Phone No</label>
              <input type="text" name='phone'id='driverphone' required class="form-control">
          </div>

      </div>
      
          <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1">
          <div class="form-group">
              <label class="text-muted mandatory">Gender</label>
              <select class="form-control" required name='gender' id='drivergender'  style='width:228px'>
                  <option value="">Choose...</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
               
                  <!-- Add more options here -->
              </select>
          </div>
          <div class="form-group" style="margin-left:10px">
              <label class="text-muted mandatory">Family Size</label>
              <input type="number" name='familysize' id='' required class="form-control">
          </div>
      </div>
      
      <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1">
                  <div class="form-group">
                      <label class="text-muted mandatory">Select Officer Type</label>
                      <select class="form-control" required name='housetype' id='houseType'  style='width:228px'>
                  <option value="">Choose...</option>
                  <option value="apartment">Normal</option>
                  <option value="single">Senior</option>
                  <!-- Add more options here -->
              </select>
                      
                  </div>
                  <div class="form-group" style="margin-left:10px">
                      <label class="text-muted mandatory">Select House Name</label>
                      <select class="form-control" required name='houseId' id='selectHouse'  style='width:228px'>
                  <option value="">Choose...</option>
                  <option value="apartment">apartment</option>
                  <option value="single">Single</option>
                  <!-- Add more options here -->
              </select>
                  </div>
                  
              </div>

              <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1">
                  <div class="form-group">
                      <label class="text-muted mandatory">Select House No</label>
                      <select class="form-control" required name='houseno' id='housenos'  style='width:228px'>
                  <option value="">Choose...</option>
                
                  <!-- Add more options here -->
              </select>
                      
                  </div>
                 
                  
              </div>

             
            </div>
            <div class="modal-footer">
              <button type="submit" id='submit' class="btn btn-primary">Add Officer</button>
              <button type="button" class="btn btn-secondary close">Close</button>
            </div>
            </form>
          </div>
        </div>
      </div>



         
        <div class="row" >

          <div class="col-md-3 mb-3">

           <div class="shadow p-3 mb-5 bg-white rounded" style='height:200px'>
<?php
echo $officer;?>
           <div><i style="font-size:40px" class='fas fa-users'></i>
           </div>
           <hr>
           Officers
        </div>

          </div>
          
          <div class="col-md-3 mb-3">

           <div class="shadow p-3 mb-5 bg-white rounded" style='height:200px'>
           <?php
           echo $AppartNo;?>
           <div><i style="font-size:40px" class='fas fa-building'></i>
           </div>
           <hr>
           Apartments
        </div>

          </div>

          
          <div class="col-md-3 mb-3">

           <div class="shadow p-3 mb-5 bg-white rounded" style='height:200px'>
           <?php
           echo $singles;?>
           <div><i style="font-size:40px" class='fas fa-building'></i>
           </div>
           <hr>
           Single Houses
        </div>

          </div>




        </div>

        
        <!--start-->
        
        

        <!--end--> 
          
          
        <!--end-->
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
      <?php  require 'footer.php';?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>

<script src="./js/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

  <script src="js/ajax.js"></script>
  </body>

</html>

