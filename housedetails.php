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
              <h5 id='drivermodal' class="modal-title">Add new Building</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" id='changestate'>
            <div class="modal-body">
            <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1">
                  <div class="form-group">
                      <label class="text-muted mandatory">Building Name</label>
                      <input type="text" disabled class="form-control" id='Bname' name='Bname'>
                      <input type="text"   hidden  name='action' value='update' >
                      <input type="text" hidden name='building'id='ActualBname' value=''>
                   
                  </div>
                  <div class="form-group" style="margin-left:10px">
                      <label class="text-muted mandatory">House NO</label>
                      <input type="text" disabled class="form-control" id='houseno' name='houseno'>
                      
                      <input type="text" hidden name='house'id='Actualhouseno' value=''>
                  </div>
              </div>
      
          <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1">
              

          <div class="form-group" style="">
                 <label class="text-muted mandatory">Current Status</label>
                 <input type="text" disabled id='currentstate' class="form-control" value=''>
              </div>
              
              <div class="form-group" style="">
                 <label class="text-muted mandatory">Change Status</label>
                 <select class="form-control" name="status" style='width:228px'>
                 <option value="">Select Status</option>
                    <option value="UnderMaintanance">Under Maintenance</option>
                    
                   
                 </select>
              </div>
          
          </div>
       
             
            </div>
            <div class="modal-footer">
              <button type="submit" id='submit' class="btn btn-primary">Update</button>
              <button type="button" class="btn btn-secondary close">Close</button>
            </div>
            </form>
          </div>
        </div>
      </div>



          
    
        <div class="row" >
          <div class="col-md-12 mb-3">
            <div class="card" style=''>
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span>Houses
              </div>

              <div class="card-body">
                <div class="table-responsive" >
                  <table
                    id="listhousedetails"
                    class="table table-striped data-table"
                    style="width: 100%;font-size:13px;"
                  >
                    <thead >
                      <tr>
                        <th>House No</th>
                        
                        <th>Status</th>
                        <th>Change Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                    <tfoot>
                      <tr>
                     
                       
                      </tr>
                    </tfoot>
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
  

  </body>

</html>

