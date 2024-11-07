
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


        <div class="modal" tabindex="-1" role="dialog" id='addofficermodal' style='font-weight:bold' >
        <div class="modal-dialog" role="document">
          <div class="modal-content" >
            <div class="modal-header">
              <h5 id='officerHeader' class="modal-title">Add new Officer</h5>
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
                      <input type="text"  id='officeraction' hidden  name='action' value='addofficer'>
                     
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
                      
                      <input type="text" class="form-control" id='recordid' hidden name='recordid'>
                  </div>
          </div>
          <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1">
      
          <div class="form-group" style='width:228px'>
              <label class="text-muted mandatory">Officer No</label>
              <input type="text" name='officerNo'id='officerno' required class="form-control">
          </div>
          
          <div class="form-group" style='width:228px'>
              <label class="text-muted mandatory">Phone No</label>
              <input type="text" name='phone' id='officerphone' required class="form-control">
          </div>

      </div>
      
          <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1">
          <div class="form-group">
              <label class="text-muted mandatory">Gender</label>
              <select class="form-control" required name='gender' id='gender'  style='width:228px'>
                  <option value="">Choose...</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
               
                  <!-- Add more options here -->
              </select>
          </div>
          <div class="form-group" style="margin-left:10px">
              <label class="text-muted mandatory">Family Size</label>
              <input type="number" name='familysize' id='familysize' required class="form-control">
          </div>
      </div>
      
      <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1"  >
        <div style='display:none;' id='currents'>
                  <div class="form-group">
                      <label class="text-muted mandatory">Current Building/Phase Name</label>
                      <input type="text" name='Current Building' id='Cbuiding'  disabled  class="form-control">
                  </div>
                
                  <div class="form-group">
                      <label class="text-muted mandatory">Current House NO</label>
                   
                      <input type="number" style='margin-left:10px'name='Current Building' id='Hno' disabled  required class="form-control">
                  </div>
      
                  </div>
                 
                  
              </div>



      <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1">
                  <div class="form-group">
                      <label class="text-muted mandatory" id='typeHeader'>Select Officer Type</label>
                      <select class="form-control" required name='housetype' id='houseType'  style='width:228px'>
                  <option value="">Choose...</option>
                  <option value="apartment">Normal</option>
                  <option value="single">Senior</option>
                  <!-- Add more options here -->
              </select>
                      
                  </div>
                  <div class="form-group" style="margin-left:10px">
                      <label class="text-muted mandatory" id='HouseHeader'>Select House Name</label>
                      <select class="form-control" required name='houseId' id='selectHouse'  style='width:228px'>
                  <option value="">Choose...</option>
                  
                  <!-- Add more options here -->
              </select>
                  </div> 
                  
              </div>

              <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1">
                  <div class="form-group">
                      <label class="text-muted mandatory" id='HouseNOHeader'>Select House No</label>
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



          <button class='btn btn-info' id='addofficerbtn' style='margin:20px;'>Add Officer <i class='fas fa-plus' style='font-size:10px'></i></button>
    
        <div class="row" >
          <div class="col-md-12 mb-3">
            <div class="card" style=''>
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span>Officers
              </div>

              <div class="card-body">
                <div class="table-responsive" >
                  <table
                    id="listofficers"
                    class="table table-striped data-table"
                    style="width: 100%;font-size:13px;"
                  >
                    <thead >
                      <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Officer Type</th>
                        
                        <th>Date of Birth</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>House Project Name</th>
                        <th>House No</th>
                        <th>Registration Date</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                   
                  </table>
                </div>
              </div>

            </div>
          </div>
        </div>
         
          
          
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
  <script src="js/officers.js"></script>
  </body>

</html>

