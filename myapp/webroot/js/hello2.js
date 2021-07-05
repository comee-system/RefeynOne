import {write1} from './hello1.js'
import {write2} from './dropimage.js'
import {write3} from './graph.js'

write1();
write3();

//グラフを作る処理のみ
if($("#createGraf").length){
    var _id = $("#id").val();
    var _data = {};
    $.ajax({
        url:"/graphs/beforeStep3/"+_id,
        type:"post",
        data:_data,
        datatype: "json",
    }).done(function(data){
        location.href = "/graphs/step3/"+_id;
    }).fail(function(){

    });

};

//リセット
$("#dataResetButton").click(function(){
    $("[name='min_x']").val("");
    $("[name='max_x']").val("");
    $("[name='min_y']").val("");
    $("[name='max_y']").val("");

    $("#dataAreaButton").click();

});


$("#nextStep3").click(function(){
    //(グラフの終了値 - グラフの開始値)/ Binサイズが　３００までOKとする。
    var _fin = $("#dispareamax").val();
    var _start = $("#defaultpoint").val();
    var _bin = $("#binsize").val();
    var _result = (_fin-_start)/_bin;
    if(_result > 300 || _result <= 0 || !_result){
        var _message = " (グラフの終了値 - グラフの開始値)/ Binサイズが0です。\n0より大きく、300以下になるように再設定してください。";
        alert(_message);
        return false;
    }
    return true;

});

$("#finishbutton").click(function(){
    if(confirm("終了後、データを削除します。解析情報を残すには「取込データ出力」と「SOP設定出力」、「エリア毎の結果テーブル出力」をしてから終了してください。")){
        return true;
    }
    return false;
});


//解析ページのselectbox
//Bootstrap Duallistbox
$('.duallistbox').bootstrapDualListbox({
    filterTextClear:'全件表示',
    filterPlaceHolder:'検索',
    moveSelectedLabel:'選択済みに移動',
    moveAllLabel:'選択済みに全て移動',
    removeSelectedLabel:'選択を解除',
    removeAllLabel:'選択を全て解除',
    moveOnSelect: true,
    nonSelectedListLabel: '取り込まれたデータ',
    selectedListLabel: '表示させるデータ',
    infoText:'{0}件',
    showFilterInputs:false,
    infoTextEmpty:'0件',
    infoTextFiltered:'{1}件中{0}件表示',
    selectorMinimalHeight:400
});

$("#sortable").sortable({
    /*
    update: function(){
        //console.log($('#sortable').sortable("toArray"));
        var _data = {"array":$('#sortable').sortable("toArray")};
        var _id = $("#id").val();
        $.ajax({
            url:"/graphs/editSortArray/"+_id,
            type:"post",
            data:_data,
            datatype: "json",
        }).done(function(data){
            console.log(data);
            console.log("Sort");

        }).fail(function(){

        });

    },
    */
    axis: 'y',
});

$("#pngExport").on("click",function(){
    let canvas = document.getElementById('lineChart');
    let png = canvas.toDataURL();
    let link = document.createElement("a");
    link.href = canvas.toDataURL("image/png");
    var date = new Date() ;
    var _y = date.getFullYear();
    var _m = ("0"+(date.getMonth() + 1)).slice(-2);
    var _d = ("0"+date.getDate()).slice(-2);
    var _h = ("0"+date.getHours()).slice(-2);
    var _i = ("0"+date.getMinutes()).slice(-2);
    var _s = ("0"+date.getTime()).slice(-2);
    var _f = _y.toString()+_m.toString()+_d.toString()+_h.toString()+_i.toString()+_s.toString();
    link.download = "Graph-Image-"+_f+".png";
    link.click();

    return false;
});


//グラフの作成
var _maxTicksLimit = 10; //値の最大表示数
var _areamin = 0;
var _areamax = 0;
createGraf();
//グラフ反映ボタン
$("[name='reflect_graf']").click(function(){

    //値のチェック
    var _id = $(this).attr("id").split("-");
    var _minpoint = $("#minpoint-"+_id[2]).val();
    var _maxpoint = $("#maxpoint-"+_id[2]).val();
     if(parseInt(_minpoint) >= parseInt(_maxpoint)){
        alert("エリア設定の入力値に不備があります。");
        return false;
    }

    creatLine();
    createGraf();
});

//解析基準
$(document).on("click","[name='analyticsBasic']",function(){
    //表示用データの切り替えを行う
    createDispGraph();
});
$(document).on("click","[name='dataDisplay']",function(){
    //表示用データの切り替えを行う
    createDispGraph();
});
//データ範囲
$(document).on("click","#dataAreaButton",function(){
    //表示用データの切り替えを行う
    createDispGraph();
});

//スムージングの切り替えを行う
$(document).on("change","select#selectSmoothId",function(){
    editSmooth();
});
//CSVExport
$(document).on("click","#CSVExport",function(){
    var _basic = $("[name='analyticsBasic']:checked").attr("id");
    //データ表示
    var _display = $("[name='dataDisplay']:checked").attr("id");
    $("#CSVExport_analyticsBasic").val(_basic);
    $("#CSVExport_dataDisplay").val(_display);


    var _min_x = $("input[name='min_x']").val();
    var _max_x = $("input[name='max_x']").val();
    var _min_y = $("input[name='min_y']").val();
    var _max_y = $("input[name='max_y']").val();
    $("#CSVExport_min_x").val(_min_x);
    $("#CSVExport_max_x").val(_max_x);
    $("#CSVExport_min_y").val(_min_y);
    $("#CSVExport_max_y").val(_max_y);

    $("#CSVExportForm").submit();
    return false;
});
function editSmooth(){
    var _id = $("#id").val();
    var _selectSmoothId = $("#selectSmoothId").val();
    var _data = {
        "smooth":_selectSmoothId,
    };
    $.ajax({
        url:"/graphs/editDispSmooth/"+_id,
        type:"post",
        data:_data,
        datatype: "json",
    }).done(function(data){
        //表示用データの切り替えを行う
        createDispGraph();

    }).fail(function(){

    });
    return true;
}
var _defaultlabels = $("#binline").val();

function createDispGraph(){


    //X軸の表示範囲指定
    var _labels = _defaultlabels.split(",");
    var _min_x = $("input[name='min_x']").val();
    var _max_x = $("input[name='max_x']").val();
    var _min_y = $("input[name='min_y']").val();
    var _max_y = $("input[name='max_y']").val();
    if(parseFloat(_min_x) >= parseFloat(_max_x)){
        alert("表示データ範囲に誤りがあります。");
        return false;
    }
    if(parseFloat(_min_y) >= parseFloat(_max_y)){
        alert("表示データ範囲に誤りがあります。");
        return false;
    }

    $("#screen").show();

    var _bl = [];
    var _i=0;
    if(_min_x && _max_x ){
        $("#defaultpoint").val(_min_x);
        $("#dispareamax").val(_max_x);
        $.each(_labels,function(key,value){
            if(
                parseInt(_min_x) <= parseInt(value) &&
                parseInt(value) <= parseInt(_max_x)
            ){
                _bl[_i] = value;
                _i++;
            }
        });
        var _join = _bl.join();
       // console.log(_join);
        $("#binline").val(_join);
    }else{
        $("#binline").val(_defaultlabels);
    }

    var _id = $("#id").val();
    //解析基準
    var _basic = $("[name='analyticsBasic']:checked").attr("id");
    //データ表示
    var _display = $("[name='dataDisplay']:checked").attr("id");
    var _data = {
        "basic":_basic,
        "display":_display,
        "min_x":_min_x,
        "max_x":_max_x,
        "min_y":_min_y,
        "max_y":_max_y,
    };
    $.ajax({
        url:"/graphs/createDispGraph/"+_id,
        type:"post",
        data:_data,
       // datatype: "json",
    }).done(function(data){
        console.log(data);
        $(".graphe_point").remove();
        $(".graphe_data").remove();
        var _num = 1;
        var _cnt = "";
        var _label = "";

        $.each(data['list'],function(key,value){
            var _hidden = "";
            _cnt = value.cnt;
            _label = value.label;
            _hidden += "<input type='hidden' class='graphe_point' id='line"+_num+"' value='"+_cnt+"' />";
            _hidden += "<input type='hidden' class='graphe_data' id='label"+_num+"' value='"+_label+"' />";
            _num = _num+1;
            $("#cardbody").append(_hidden);
        });

        $("#screen").hide();
        console.log("OK");
        creatLine();

        $("#maxcountlimit").val(data['max']);
        createGraf();

    }).fail(function(){

    });

}
//エリア設定で縦ラインを引く値
function creatLine(){
    var _dispareamax = $("#dispareamax").val();
    var _memori = _dispareamax/_maxTicksLimit; //グラフの区切り値
    var _separate = _dispareamax/_memori;
    var _chk = $("[name='reflect_graf']:checked").attr("id");
    if(!_chk) return false;
    var _id = _chk.split("-")[2];
    var _maxpoint = $("#maxpoint-"+_id).val();
    var _bin = $("#binsize").val()/_maxTicksLimit;


    var _min_x = $("input[name='min_x']").val();
    var _max_x = $("input[name='max_x']").val();

    _areamax = ((_maxpoint-_min_x)/_separate)/_bin;
    var _minpoint = $("#minpoint-"+_id).val();
    _areamin = ((_minpoint-_min_x)/_separate)/_bin;

}


function createGraf(){

    var _basic = $("[name='analyticsBasic']:checked").next().text();
    var _display = $("[name='dataDisplay']:checked").attr("id");
    if(_display == "dataDisplay1") _display = "counts";
    if(_display == "dataDisplay2") _display = "signal ratio";

    //-------------
    //- LINE CHART -
    //--------------
    //色指定
    var _r = [];
    var _g = [];
    var _b = [];
    _r[1] = "0";
    _g[1] = "176";
    _b[1] = "240";

    _r[2] = "0";
    _g[2] = "176";
    _b[2] = "240";

    _r[3] = "175";
    _g[3] = "171";
    _b[3] = "171";

    _r[4] = "175";
    _g[4] = "171";
    _b[4] = "171";

    _r[5] = "0";
    _g[5] = "176";
    _b[5] = "80";

    _r[6] = "0";
    _g[6] = "176";
    _b[6] = "80";


    _r[7] = "255";
    _g[7] = "192";
    _b[7] = "0";

    _r[8] = "255";
    _g[8] = "192";
    _b[8] = "0";

    _r[9] = "0";
    _g[9] = "112";
    _b[9] = "192";

    _r[0] = "0";
    _g[0] = "112";
    _b[0] = "192";

    var _pt = 0;
    var _line = [];
    var _count = $(".graphe_point").length;
    for(var _i=1;_i<=_count;_i++){
        _line[_i] = $("#line"+_i).val().split(",");
    }
    var _data = [];
    var _label = "";
    var _bd = 0;
    for(var _i=1;_i<=_count;_i++){
        _label = $("#label"+_i).val();
        _bd = 0;
        if(_i%2 == 0)_bd = 5;
        _data[_i] =
        {
            label               : _label,
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba('+_r[_i%10]+','+_g[_i%10]+','+_b[_i%10]+',0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            lineTension: 0,
            borderDash:[_bd,_bd],
            data                : _line[_i]
        };
    }
    try{
        var _min_y = $("[name='min_y']").val();
        var _max_y = $("[name='max_y']").val();

        var _labels = $("#binline").val().split(",");
        var areaChartData = {

            labels  : _labels,

            datasets: [
                _data[1],
                _data[2],
                _data[3],
                _data[4],
                _data[5],
                _data[6],
                _data[7],
                _data[8],
                _data[9],
                _data[10],
                _data[12],
                _data[13],
                _data[14],
                _data[15],
                _data[16],
                _data[17],
                _data[18],
                _data[19],
                _data[20],
                _data[21],
                _data[22],
                _data[23],
                _data[24],
                _data[25],
                _data[26],
                _data[27],
                _data[28],
                _data[29],
                _data[30], //グラフを最大30個まで準備　より必要であれば増やす
            ]
        }
        var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
            display: true,
            align:"end"
            },
            scales: {
            xAxes: [{
                gridLines : {
                display : true,
                },
                ticks: {                       // 目盛り
                    min: 0,                        // 最小値
                    autoSkip: true,
                    maxTicksLimit: _maxTicksLimit, //値の最大表示数
                    fontColor: "black",             // 目盛りの色
                    fontSize: 11,                   // フォントサイズ
                    maxRotation: 0,
                    minRotation: 0,
                },
                scaleLabel: {                  // 軸ラベル
                    display: true,                 // 表示の有無
                    labelString: 'Mw('+_basic+')',     // ラベル
                    fontFamily: "sans-serif",
                    fontColor: "black",             // 文字の色
                    fontFamily: "sans-serif",
                    fontSize: 11                   // フォントサイズ
                },
            }],
            yAxes: [{
                gridLines : {
                display : true,
                color: "rgba(0, 0, 255, 0.2)", // 補助線の色
                zeroLineColor: "black",         // y=0（Ｘ軸の色）
                },
                scaleLabel: {                  // 軸ラベル
                    display: true,                 // 表示の有無
                    labelString: _display,     // ラベル
                    fontFamily: "sans-serif",
                    fontColor: "black",             // 文字の色
                    fontFamily: "sans-serif",
                    fontSize: 11,                   // フォントサイズ
                },

                ticks: {                       // 目盛り
                 //   min: 0,                        // 最小値
                 //   max : _mpoint,                       // 最大値
                 //   stepSize: 100,                   // 軸間隔
                    fontColor: "black",             // 目盛りの色
                    fontSize: 11                   // フォントサイズ
                }
            }]

            },

            annotation: {
                annotations: [
                    {
                        type: 'line', // 線を描画
                        id: 'hLine',
                        mode: 'vertical', // 線を水平に引く
                        scaleID: 'x-axis-0',
                        value: _areamin, // 基準となる数値
                        borderWidth: 3, // 基準線の太さ
                        borderColor: 'red'  // 基準線の色
                    },
                    {
                        type: 'line', // 線を描画
                        id: 'hLine2',
                        mode: 'vertical', // 線を水平に引く
                        scaleID: 'x-axis-0',
                        value: _areamax, // 基準となる数値
                        borderWidth: 3, // 基準線の太さ
                        borderColor: 'red'  // 基準線の色
                    }
                ]
            },
        }

        if(_min_y){
            areaChartOptions['scales']['yAxes']['0']['ticks']['min'] = parseInt(_min_y);
        }
        if(_max_y){
            areaChartOptions['scales']['yAxes']['0']['ticks']['max'] = parseInt(_max_y);
        }
        var canvas = $('#lineChart').get(0);
        var lineChartCanvas = canvas.getContext('2d');

        var lineChartOptions = $.extend(true, {}, areaChartOptions);
        var lineChartData = $.extend(true, {}, areaChartData);
        for(var _i=0;_i<_count;_i++){
            lineChartData.datasets[_i].fill = false;
        }
        lineChartOptions.datasetFill = false;


        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        });

    }catch(e){
        console.log("error");
        console.log(e);
    }
}

datestatus();
$("#datestatus").click(function(){
    datestatus();
});
function datestatus(){
    if($("#div-datestatus").length){
        var _chk = $("#datestatus").prop("checked");
        $("#div-datestatus").children("select").attr("disabled",_chk);
    }
    return false;
}
