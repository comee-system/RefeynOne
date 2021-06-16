export const write3 = function () {

};
$(function(){
    $(this).getGraphData();

    //エリアごとのテーブル反映
    $("#tableReflect").click(function(){
        $(this).tableReflect();
    });
    $("#tableDataExport").click(function(){
        $(this).tableReflect("export");
    });

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
        }).fail(function(){

        });
        return false;
    });

    $("#addSop").on("click",function(){
        var _id = $("#id").val();
        $.ajax({
            url:"/graphs/setSop/"+_id,
            type:"post",
        }).done(function(jsonstr){
            $(this).getSop();
        });
    });
    $(this).getSop();

    //sopText
    $(".sopText").on("blur",function(){
        var _val = $(this).val();
        var _name = $(this).attr("name");
        var _id = $("input[name='sopdefaultid']").val();
        var _data = {
            name:_name,
            value:_val
        };
        $.ajax({
            url:"/graphs/editsop/"+_id,
            type:"post",
            data:_data,
            datatype: "json",
        }).done(function(jsonstr){
            console.log(jsonstr);
        });
    });

    var sopArea = $(".sopArea").length;
    var _before = [];
    if(sopArea > 0){
        $(".sopArea").each(function(i, elem) {
            var _id = $(this).attr("id");
            _before[_id] = $(this).val();
        });
    }

    //SOPエリアの設定
    $(".sopArea").on("blur",function(event){
        var _val = $(this).val();
        var _name = $(this).attr("name").split("-");
        var _id = parseInt(_name[1]);
        //値のチェック
        /*
        var _minpoint = $("#minpoint-"+_id).val();
        var _maxpoint = $("#maxpoint-"+_id).val();
        if(parseInt(_minpoint) >= parseInt(_maxpoint)){
            alert("エリア設定の入力値に不備があります。");
            var _id = $(this).attr("id");
            $("#"+_id).val(_before[_id]);
            return false;
        }
        */

        _name = _name[0];
        var _data = {
            name:_name,
            value:_val
        };
        $.ajax({
            url:"/graphs/editsoparea/"+_id,
            type:"post",
            data:_data,
            datatype: "json",
        }).done(function(jsonstr){
        });

        return false;
    });
    //グラフ表示ステータス変更
    $(".graph_status_edit").click(function(){
        var _id = $(this).parent("li").attr("id").split("-");
        var _chk = $(this).prop("checked");

        var _data = {"id":_id[1],"chk":_chk};
        $.ajax({
            url:"/graphs/editDispStatus/",
            type:"post",
            data:_data,
        }).done(function(data){
            console.log(data);
        }).fail(function(){

        });

        return true;
    });

});
var ex = "";
$.fn.tableReflect = function(ex = ""){
    var _id = $("#id").val();
    //解析基準
    var _basic = $("[name='analyticsBasic']:checked").attr("id");
    //データ表示
    var _display = $("[name='dataDisplay']:checked").attr("id");
    var _data = {
        "basic":_basic,
        "display":_display,
        "exflag":ex
    };
    $.ajax({
        url:"/graphs/getAreaTable/"+_id,
        type:"post",
        data:_data,
        datatype: "json",
    }).done(function(data){
        if(ex == "export"){ //tableDataExportボタンを押下
            console.log(data);


        }else{
            console.log(data);

            var _areas = data.areas;
            var _tbl = "";
            $.each(_areas,function(key,value){
                var _areamins = "#areamins-"+value[ 'id' ];
                var _areamaxs = "#areamaxs-"+value[ 'id' ];
                $(_areamins).html(value['minpoint']);
                $(_areamaxs).html(value['maxpoint']);
            });
            var _label = data.label;
            var _lists = data.lists;
            var _table = "";
            var _num = 1;
            $("#areaTables").html("");
            $.each(_label,function(_key,_value){
                _table = "<tr>";
                _table += "<td>"+_num+"</td>";
                _table += "<td>"+_value.label+"</td>";
                var _detail = _lists[_key];
                console.log(_detail);
                $.each(_detail,function(_k,_val){
                    _table += "<td>"+_val.lot+"%</td>";
                    _table += "<td>"+_val.ave+"</td>";
                    _table += "<td>"+_val.median+"</td>";
                    _table += "<td>"+_val.mode+"</td>";
                });
                _table += "</tr>";
                $("#areaTables").append(_table);
                _num++;
            });
        }
    }).fail(function(e){
        console.log("error");
        console.log(e);
    });
    return false;

};

$.fn.getSop = function(){

    try{
        var _id = $("#id").val();
        if(!_id) return false;
        $.ajax({
            url:"/graphs/getSop/"+_id,
            type:"post",
            datatype: "json",
        }).done(function(jsonstr){
            var _tbl = "";

        //  var data = $.parseJSON(jsonstr);
            var data = jsonstr;
            var _num = 1;
            $("#soptbody").html("");
            $.each(data, function(key, value){
                _tbl = "<tr class='sopcount' >";
                _tbl += "<td>"+value.name+"</td>";
                _tbl += "<td class='text-right'>";
                if(value.edit == 1){
                    _tbl += "<input type='text' id='sopmin-"+value.id+"' value='"+value.minpoint+"' class='form-control-sm' />";
                }else{
                    _tbl += value.minpoint;
                    _tbl += "<input type='hidden' id='sopmin-"+value.id+"' value='"+value.minpoint+"' />";
                }
                _tbl += "</td>";
                _tbl += "<td></td>";
                _tbl += "<td class='text-right'>";
                if(value.edit == 1){
                    _tbl += "<input type='text' id='sopmax-"+value.id+"' value='"+value.maxpoint+"' class='form-control-sm' />";
                }else{
                    _tbl += value.maxpoint;
                    _tbl += "<input type='hidden' id='sopmax-"+value.id+"' value='"+value.maxpoint+"' />";
                }

                _tbl += "</td>";
                _tbl += "<td class='text-center'><input type='radio' id='sop-"+value.id+"' name='sop' /></td>";
                _tbl += "</tr>";
                $("#soptbody").append(_tbl);
                _num += 1;
            });

        }).fail(function(){

        });
    }catch(e){

    }

};


$.fn.getGraphData = function(){

    try{
        var _id = $("#id").val();
        if(!_id){
            return false;
        }
        $.ajax({
            url:"/graphs/graphdata/"+_id,
            type:"post",
            datatype: "json",
        }).done(function(jsonstr){
            var _tbl = "";

        //  var data = $.parseJSON(jsonstr);
            var data = jsonstr;
            var _num = 1;
            $("#tbody").html("");
            $.each(data, function(key, value){
                _tbl = "<tr>";
                _tbl += "<td>"+_num+"</td>";
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
