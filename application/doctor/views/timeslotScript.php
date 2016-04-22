<script>
    $(document).ready(function(){
        
        hideMI();
        $("#div_psChamber_name").hide();
        $("#div_Mi_name").hide();
        $("#div_address").hide();
        
        
        
        $("#selectAllDay").click(function(){
            if($("#selectAllDay").is(':checked') ){
                $("#docTimeDay_day > option").prop("selected","selected");
                $("#docTimeDay_day").trigger("change");
            }else{
                $("#docTimeDay_day > option").removeAttr("selected");
                $("#docTimeDay_day").trigger("change");
            }
        }); 
        
        $(".docTimeTable_stayAt").click(function(){
           
        });
        
        $("#docTimeTable_MItype").change(function(){
            
           if($("#docTimeTable_MItype").val() == "1" ){
               $("#div_docTimeTable_HprofileId").toggle();
               $("#div_docTimeTable_DprofileId").hide();
               $("#div_address").show();
           } 
           else if($("#docTimeTable_MItype").val() == "2" ){
               $("#div_docTimeTable_DprofileId").toggle();
               $("#div_docTimeTable_HprofileId").hide();
               $("#div_address").show();
           }
        });
        
        $("#docTimeTable_MIprofileId").change(function(){
            var proId = $("#docTimeTable_MIprofileId").val() ;
            alert(proId);
           if(proId == 0 ){
               $("#div_docTimeTable_HprofileId").show();
           } 
           else{
               
               $("#div_docTimeTable_DprofileId").show();
               $("#div_address").show();
           }
        });
    });
    
    function hideMI(){
        $("#div_docTimeTable_MItype").hide();
        $("#div_docTimeTable_HprofileId").hide();
        $("#div_docTimeTable_DprofileId").hide();
    }
    
    function placeDetail(stayAtVal){
        if(stayAtVal == "1" ){
           $("#div_docTimeTable_MItype").show();
           $("#div_psChamber_name").hide();
        } 
        else if(stayAtVal == "0" ){
           $("#div_psChamber_name").show();
           hideMI();
           $("#div_address").show();
        }
    }
    </script>