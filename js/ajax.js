$(document).ready(function() { 

  var tripdata = $('#listhouses').DataTable({
		"searching": true,
		"lengthChange": true,
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"house.php",
			type:"POST",
			data:{action:'listhouses'},
			dataType:"json"
		}
	});	

  function getid(){
    
    var urlParams = new URLSearchParams(window.location.search);
    var Id= urlParams.get('id');
    return Id

  }
  
  var listdetails = $('#listhousedetails').DataTable({
		"searching": true,
		"lengthChange": true,
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"house.php",
			type:"POST",
			data:{action:'listhousedetails',id:getid()},
			dataType:"json"
		}
	});	
  
  var officerdata = $('#listofficers').DataTable({
		"searching": true,
		"lengthChange": true,
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"house.php",
			type:"POST",
			data:{action:'listofficers'},
			dataType:"json"
		}
	});	


    $(document).on('click','#addofficerbtn', function(event){

$("#addofficermodal").modal('show');

    })

    
    $(document).on('click','#Changestatus', function(event){
      var houseno=$(this).attr('house');
      var buildingId=$(this).attr('value');

      
    
      $.ajax({
        url:"house.php",
        method:"POST",
        data:{action:'getstatus',id:buildingId,house:houseno},
        dataType:"json",
        success:function(data){	
          $('#ActualBname').val(buildingId);
          $('#Bname').val(data.project_name);
  
          $('#houseno').val(houseno);
          $('#Actualhouseno').val(houseno);
          $('#currentstate').val(data.status);
          $("#addofficermodal").modal('show');
          
          
        }
      })
      
          })

          $(document).on('submit','#changestate', function(event){
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
              url:"house.php",
              method:"POST",
              data:formData,
              success:function(data){	
                    if(data==0){
                      location.reload();
                      
                    }else if(data==1){
                     					
        
                    }
                
              }
            })
          });	

	$(document).on('click','.close', function(event){

		$('.modal').modal('hide');
				
		
	});

    $("#houseType").on("change", function () {
        // Get the selected value
        var selectedValue = $(this).val();
        
        $.ajax({ 
        url: "house.php",
        method: "POST",
        data:{action:'data',type:selectedValue},
        dataType: "json",
        success: function (data) {
          
          // Get the select element
          const selectElement = $("#selectHouse");
    
          // Clear the initial loading option
          selectElement.empty();
                 
          selectElement.append(
            $("<option>", {
              
              value: '', // Replace 'value' with the appropriate property name from your data
              text: 'Select House', // Replace 'label' with the appropriate property name from your data
            })
          );
          // Populate the select options with the fetched data
          $.each(data, function (index, item) {
  
              
            selectElement.append(
              $("<option>", {
                
                value: item.building_id, // Replace 'value' with the appropriate property name from your data
                text: item.project_name, // Replace 'label' with the appropriate property name from your data
              })
            );
          });
        },
        error: function (error) {
          console.error("Error fetching data:", error);
        },
      });
    
    
    })



    $("#selectHouse").on("change", function () {
        // Get the selected value
        var selectedValue = $(this).val();
        
        $.ajax({
            
        url: "house.php",
        method: "POST",
        data:{action:'housedata',type:selectedValue},
        dataType: "json",
        success: function (data) {
          
          // Get the select element
          const selectElement = $("#housenos");
    
          // Clear the initial loading option
          selectElement.empty();
                 
          selectElement.append(
            $("<option>", {
              
              value: '', // Replace 'value' with the appropriate property name from your data
              text: 'Select House', // Replace 'label' with the appropriate property name from your data
            })
          );
          // Populate the select options with the fetched data
          $.each(data, function (index, item) {
  
              
            selectElement.append(
              $("<option>", {
                
                value: item.house_no, // Replace 'value' with the appropriate property name from your data
                text:'House No '+item.house_no, // Replace 'label' with the appropriate property name from your data
              })
            );
          });
        },
        error: function (error) {
          console.error("Error fetching data:", error);
        },
      });
    
    
    
    })

    $(document).on('submit','#addbuilding', function(event){
		event.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url:"house.php",
			method:"POST",
			data:formData,
			success:function(data){	
						if(data==0){
							

              
						}else if(data==1){
							$('#addtrip')[0].reset();
							$('#addtripmodal').modal('hide');
							$('#messagemodal').modal('show');					

						}
				
			}
		})
	});	

    $(document).on('submit','#addofficer', function(event){
		event.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url:"users.php",
			method:"POST",
			data:formData,
			success:function(data){	
						if(data==0){
							$("#addofficermodal").modal('hide');
              officerdata.ajax.reload();
						}else if(data==1){
              alert("successfully added ")
              $("#addofficermodal").modal('hide');	
              officerdata.ajax.reload();			

						}
				
			}
		})
	});	




 })