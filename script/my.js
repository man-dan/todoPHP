$(document).ready(function()
{
    $('#btnflg').click(function(){
        $.ajax({
            url: "addlst.php",
            success: function(html){
                $('#rl').load("load_lists.php");
            }
        });
        return false;
    });



    $('#rl').on('click','.edit',function(){
        $("#list"+this.id).hide();
        $("#form"+this.id).load("form.php");
        $("#form"+this.id).show();
        $('.ids').val(this.id);
        return false;
    });


    $(document).mouseup(function(e){
       var id = $("#form"+$('.ids').val());
       if(!id.is(e.target) && id.has(e.target).length === 0){
            //$(id).val($('.idds').val());
            id.hide();
            $("#list"+$('.ids').val()).show();
            $("#ms").remove();
       }
       return;
    });


    $("#rl").on('click','#save',function(){
        var id = $('.ids').val();
        var namelist = $("#listname").val();
        if(namelist){
            $.ajax({
                type: "POST",
                url: "edit.php",
                data: {name:namelist,idd:id},
                success: function(data) {
                    $("#form"+id).html(data);
                    $("#list"+id).html(data);
                }
            });
        }
    });


    $('#rl').on('click','.delete',function(){
        var del_id = this.id;
        $.ajax({
            type: "POST",
            url: "del_list.php",
            data: {id: del_id},
            success: function() {
                $("."+del_id).next().hide();
                $("."+del_id).remove();
            }
        });
        return false;
    });
    $('#rl').on('click','.adtsk',function(){
        var tval = $(".tsk"+this.id).val();
        var idd = this.id;
        if(tval){
            $.ajax({
                type: "POST",
                url: "ad_tsk.php",
                data: {id: idd, vval: tval },
                success: function() {
                    $('#rl').load("load_lists.php");
                }

            });
        }
        return false;
    });
    $('#rl').on('click','.delt',function(){
        var del_id = this.id;
        $.ajax({
            type: "POST",
            url: "del_task.php",
            data: {id: del_id},
            success: function() {
                $(".t"+del_id).remove();
            }
        });
        return false;
    });
    $('#rl').on('click','.ed_t',function(){
        $("#et"+this.id).hide();
        $("#t_"+this.id).load("form_t.php");
        $("#t_"+this.id).show();
        $('#t_n').val(this.id);
        return false;
    })

    $(document).mouseup(function(e){
        var id = $("#t_"+$('#t_n').val());
        if(!id.is(e.target) && id.has(e.target).length === 0)
        {
                //$(id).val($('.idds').val());
             id.hide();
             $("#et"+$('#t_n').val()).show();
            $("#mss").remove();
        }

            return;
        });


    $('#rl').on('click','#save_t',function(){
        var id = $('#t_n').val();
        var name_t = $("#tname").val();
        if (name_t)
        {    $.ajax({
                type: "POST",
                url: "edit_t.php",
                data: {name:name_t,idd:id},
                success: function(data) {
                    $("#t_"+id).html(data);
                    $("#et"+id).html(data);

                }
            });
        }
    });





});