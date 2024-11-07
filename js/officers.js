$(document).ready(function() {        
	var driversdata = $('#listdrivers').DataTable({
		"searching": true,
		"lengthChange": true,
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"drivers.php",
			type:"POST",
			data:{action:'listdrivers'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":false,
			},
		],
		"pageLength": 10
	});	

    	
	$(document).on('click','#adddriverbtn', function(event){
	
		$('input[disabled]').removeAttr('disabled');
		$('select[disabled]').removeAttr('disabled');
		$('textarea[disabled]').removeAttr('disabled');
		$('#adddriver')[0].reset();
		$('#driveraction').val('adddriver')
		$('#drivermodal').html("Add Driver");
		$('#adddrivermodal').modal('show');	
		$('#submit').css('display', 'block'); 
		$('#submit').html('Save'); 			
				
		
	});

	
        $(".datepicker").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
 
		$(document).on('submit','#adddriver', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"drivers.php",
			method:"POST",
			data:formData,
			success:function(data){	
						if(data==0){
							$('#adddriver')[0].reset();
							$('#adddrivermodal').modal('hide');
							$('#error').modal('show');	
						}else if(data==1){
							$('#adddriver')[0].reset();
							$('#adddrivermodal').modal('hide');
							$('#messagemodal').modal('show');					
							driversdata.ajax.reload();
						}
                        else if(data==2){
							$('#adddriver')[0].reset();
							$('#adddrivermodal').modal('hide');
							$('#emessagemodal').modal('show');					
							driversdata.ajax.reload();
						}
						else if(data==4){
							$('#adddriver')[0].reset();
							$('#adddrivermodal').modal('hide');
							$('#Dsmessagemodal').modal('show');					
							driversdata.ajax.reload();
						}
				
			}
		})
	});		
	
	


	$(document).on('click','#viewdriver', function(event){
      
		var id=$(this).attr("value")
	$('#drivermodal').html("Driver Details");
	
			
			$.ajax({
				url:'drivers.php',
				method:"POST",
				data:{driverid:id, action:'data'},
				dataType:"json",
				success:function(data){
					$('#fname').val(data.fname).attr('disabled','disabled');;
					$('#lname').val(data.lname).attr('disabled','disabled');
					$('#driverbirth').val(data.dateofbirth).attr('disabled','disabled');;
					$('#driverphone').val(data.phone).attr('disabled','disabled');;
					$('#driveremail').val(data.email).attr('disabled','disabled');;
					$('#drivergender').val(data.Gender).attr('disabled','disabled');;
					$('#kinname').val(data.nextofkinname).attr('disabled','disabled');;
					$('#kinphone').val(data.nextofkinphone).attr('disabled','disabled');;
					$('#driverid').val(data.idno).attr('disabled','disabled');;
					
					$('#submit').css('display', 'none');       
					$('#adddrivermodal').modal('show');
				}
			})
					
				
			});
		
			$(document).on('click','#deletedriver', function(event){
	
				var id=$(this).attr("value")
		
				if(confirm("Are you sure you want to delete this Driver?")) {
				$.ajax({
					url:"drivers.php",
					method:"POST",
					data:{action:'delete',delete:id},
					success:function(data){	
								if(data==0){
									$('#error').modal('show');	
								}else if(data==1){
									$('#deletemessage').modal('show');					
								}
								driversdata.ajax.reload();
						
					}
				})
			}else{
					return false;
				}
				
					
			});
	
			$(document).on('click','.btn.btn-success.editofficer', function(event){
				var id=$(this).attr("value")
				
				$.ajax({
					url:'house.php',
					method:"POST",
					data:{Id:id, action:'editofficer'},
					dataType:"json",
					success:function(data){
					$('#name').val(data.officer_name);
					$('#email').val(data.email);
					$('#officerbirth').val(data.Dob);
					$('#officerphone').val(data.phone);
					$('#Cbuiding').val(data.project_name).removeAttr("hidden")
					$('#gender').val(data.gender);
					$('#recordid').val(data.id);
					
					$('#officeraction').val('update')
					$('#currents').css("display", "flex");
					
					$('#familysize').val(data.familysize);
					$('#selectHouse').removeAttr("required")
					$('#housenos').removeAttr("required")
					if(data.officer_type=='normal'){
						alert()
						var type='apartment';
					}else{
						var type='single';
					}
					$('#houseType').val(type);;
					$('#officerno').val(data.officer_no);;
					$('#Hno').val(data.house_no).removeAttr("hidden");
					$("#addofficermodal").modal('show');
					$("#HouseNOHeader").html("Change House No")
					$("#typeHeader").html("Change Officer Type")
					$("#officerHeader").html("Edit Officer")
					
					$("#HouseHeader").html("Change Building")
					$("#submit").html("Update")
					
					}
				})
						
				
			});

});

