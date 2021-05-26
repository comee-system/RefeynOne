export const write3 = function () {

};
$(function(){
    $(this).getGraphData();



});
$.fn.getGraphData = function(){

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
        $.each(data, function(key, value){
            _tbl = "<tr>";
            _tbl += "<td>"+_num,+"</td>";
            _tbl += "<td><input type='text' class='form-control editlabel' id='label-"+value.id+"' value='"+value.label+"' /></td>";
            _tbl += "<td>"+value.filename+"</td>";
            _tbl += "<td class='text-right'>"+value.counts+"</td>";
            _tbl += "<td class='text-center'><button class='btn-sm btn-danger' id='delete-"+value.id+"'>削除</button></td>";
            _tbl += "</tr>";
            $("#tbody").append(_tbl);
            _num += 1;
        });

    }).fail(function(){

    });

};
