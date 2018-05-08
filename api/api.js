$(document).ready(function(){
    var api_field_edit = 0
	function API(){
		this.getstaff = function(){
			var jqXHR = $.ajax({
				url:"/api/index.php",
				data: "q=staff",
				async: false
			});
			return $.parseJSON(jqXHR.responseText);
		}
		this.getpatients = function(){
			var jqXHR = $.ajax({
				url:"/api/index.php",
				data: "q=patients",
				async: false
			});
			return $.parseJSON(jqXHR.responseText);
		}
		this.update_record = function(table,field,inp,pid){
			var jqXHR = $.ajax({
                type: "POST",
				url:"/api/index.php",
                async: false,
				data: {
                    "table":table,
                    "field":field,
                    "inp":inp,
                    "patient":pid
                },
                success: function(){
                    location.reload();   
                }
			});
			return $.parseJSON(jqXHR.responseText);
		}        
	}
	api = new API();
    data = '';
    db_table = '';
    db_field = ''; 
    db_pid = ''; 
    $(".api-edit-field").click(function(){
        if($(this).attr("api-edit-editing")!=1 && api_field_edit==0){
            api_field_edit = 1
            $(this).attr("api-edit-editing","1");
            db_table = $(this).attr("data-db-table");
            db_field = $(this).attr("data-db-field");
            db_pid = $(this).attr("data-patient-id");
            $(this).parent().append("<form action='javascript:GET_FIELD_DATA()'><input type='text' class='form-control' id='api-field-edit'/><input id='api-button-edit' type='submit' class='form-control btn btn-primary'/></form>");
        }else{
            if($(this).attr("api-edit-editing")==1 && api_field_edit==1){
                $("#api-field-edit").remove();
                $("#api-button-edit").remove();
                api_field_edit=0
                $(this).attr("api-edit-editing","0");
            }
        }
    })    
});
function GET_FIELD_DATA(){
    api.update_record(db_table,db_field,$("#api-field-edit").val(),db_pid)
}

