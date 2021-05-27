export const write3 = function () {

};
$(function(){
    $(this).getGraphData();

    //ファイル削除
    $(document).on("click",".grapdelete",function(){
        if(confirm("取込みファイルの削除を行います。よろしいですか?")){
            var _graph_id = $("#id").val();
            var _graph_data_id = $(this).attr("id").split("-")[1];
            location.href="/graphs/delete/"+_graph_id+"/"+_graph_data_id;
            return true;
        }
        return false;
    });
    //label名変更
    $(document).on("blur",".editlabel",function(){
        var _id = $(this).attr("id").split("-")[1];
        var _val = $(this).val();
        var _data = {"label":_val};
        $.ajax({
            url:"/graphs/edit/"+_id,
            type:"post",
            data:_data,
            datatype: "json",
        }).done(function(data){
            console.log("ddd");
        }).fail(function(){

        });
        return false;
    });

});
$.fn.getGraphData = function(){

    try{
        var _id = $("#id").val();
        $.ajax({
            url:"/graphs/graphdata/"+_id,
            type:"post",
            datatype: "json",
        }).done(function(jsonstr){
            //console.log(jsonstr);
            var _tbl = "";

        //  var data = $.parseJSON(jsonstr);
            var data = jsonstr;
            var _num = 1;
            $("#tbody").html("");
            $.each(data, function(key, value){
                _tbl = "<tr>";
                _tbl += "<td>"+_num,+"</td>";
                _tbl += "<td><input type='text' class='form-control editlabel' id='label-"+value.id+"' value='"+value.label+"' /></td>";
                _tbl += "<td>"+value.filename+"</td>";
                _tbl += "<td class='text-right'>"+value.counts+"</td>";
                _tbl += "<td class='text-center'><button class='btn-sm btn-danger grapdelete' id='delete-"+value.id+"'>削除</button></td>";
                _tbl += "</tr>";
                $("#tbody").append(_tbl);
                _num += 1;
            });

        }).fail(function(){

        });
    }catch(e){

    }

};
