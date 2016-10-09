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
        var txt = $("#list"+this.id).text();
        $("#idds").val(txt);
        $("#list"+this.id).hide();
        $("#form"+this.id).load("form.php");
        $("#form"+this.id).show();
        $('.ids').val(this.id);
        return false;
    });

    jQuery(function($){
        $(document).mouseup(function(e){
            var id = $("#form"+$('.ids').val());
            var current = $(event.target).attr('id');
            if(!id.is(e.target) && id.has(e.target).length === 0){
                //$(id).val($('.idds').val());
                id.hide();
                $("#list"+$('.ids').val()).show();
            }
            else{
                id.show();
            }
            return;
        });
     });

    $(document).submit(function(){
          var id = $('.ids').val();
          var namelist = $("#listname").val();
          $.ajax({
                type: "POST",
                url: "edit.php",
                data: {name:namelist,idd:id},
                success: function(data) {
                $("#form"+id).html(data);
                $("#list"+id).html(data);

                }
           });
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
 });
