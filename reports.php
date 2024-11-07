
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
        <div class="row" >

        <div class="col-12">
          <form action="" method='POST'>
        <div class="d-sm-flex align-items-sm-center justify-content-sm-between pt-1">
                  <div class="form-group">
                      <label class="mandatory" id='typeHeader'>Select Start Date</label>
                      <input type="date"  id='officeraction'  class='form-control'    name='from' value='addofficer'>
                      
                  </div>

                  <div class="form-group">
                      <label class="mandatory" id='typeHeader'>Select End Date</label>
                      
                      <input type="date"  id='officeraction' class='form-control' name='to' value='addofficer'>
                  </div>
                

                  <div class="form-group" style="margin-left:10px;margin-top:">
                    <button class='btn btn-info' name='View'>View Report</button>
                  </div> 
                  </form>
              </div>

        </div>
          <div class="col-md-12 mb-3">
            <div class="card" style=''>
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span>Occupation Reports
              </div>


              
              <div class="card-body">
                <div class="table-responsive" >
                  <table
                    id=""
                    class="table table-striped data-table"
                    style="width: 100%;font-size:13px;"
                  >
                    <thead >
                      <tr>
                        <th>Officer Name</th>
                        <th>Officer ID</th>
                        <th>Officer Phone</th>
                        <th>House Name</th>
                        <th>House No</th>
                        <th>Occupied_Date</th>
                        <th>Vacated_Date</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                    if( isset($_POST['View'])){

                      $sql = "SELECT o.*, of.officer_name,of.phone,of.officer_no, b.project_name
                      FROM occupations o
                      LEFT JOIN officers of ON o.officer_id = of.officer_no
                      LEFT JOIN buildings b ON o.building_id = b.building_id
                        WHERE (o.from BETWEEN '{$_POST['from']}' AND '{$_POST['to']}')
                        OR (o.leave_date BETWEEN '{$_POST['from']}' AND '{$_POST['to']}')";
                    require 'class/database.php';
                    
                    $database= new Database;
                    $conn=$database->dbConnect();
                    $query=$conn->query($sql);
                       
                       while($results=$query->fetch_assoc()){
    echo"
    <tr>
    <td>{$results['officer_name']}</td>
    

    
    <td>{$results['officer_no']}</td>
    

    
    <td>{$results['phone']}</td>
    
    
    
    <td>{$results['project_name']}</td>
    

    
    <td>{$results['house_no']}</td>
    

  
    <td>{$results['from']}</td>
  
  
    <td>{$results['leave_date']}</td>
    </tr>
    ";


                       }


                    }
                    
                    ?>
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
  <script src="js/officers.js"></script>
  </body>

</html>

