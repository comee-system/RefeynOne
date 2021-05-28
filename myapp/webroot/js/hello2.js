import {write1} from './hello1.js'
import {write2} from './dropimage.js'
import {write3} from './graph.js'

write1();
write3();


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
    update: function(){
        console.log($('#sortable').sortable("toArray"));
    },
    axis: 'y',
});
$(".graph_status_edit").on("click",function(){
    console.log("click");
});

$("#pngExport").on("click",function(){
    let canvas = document.getElementById('lineChart');
    let png = canvas.toDataURL();
    let link = document.createElement("a");
    link.href = canvas.toDataURL("image/png");
    var date = new Date() ;
    link.download = date.getTime()+".png";
    link.click();

    return false;
});
//-------------
//- LINE CHART -
//--------------
//色指定
var _r = [];
var _g = [];
var _b = [];
_r[1] = "255";
_g[1] = "0";
_b[1] = "0";

_r[2] = "255";
_g[2] = "255";
_b[2] = "0";

_r[3] = "255";
_g[3] = "0";
_b[3] = "255";

_r[4] = "128";
_g[4] = "0";
_b[4] = "0";

_r[5] = "128";
_g[5] = "128";
_b[5] = "0";

_r[6] = "128";
_g[6] = "0";
_b[6] = "128";


_r[7] = "255";
_g[7] = "128";
_b[7] = "0";

_r[8] = "128";
_g[8] = "255";
_b[8] = "0";

_r[9] = "128";
_g[9] = "0";
_b[9] = "255";

_r[0] = "0";
_g[0] = "0";
_b[0] = "0";


var _pt = 0;
var _line = [];
var _count = $(".graphe_point").length;
for(var _i=1;_i<=_count;_i++){
    _line[_i] = $("#line"+_i).val().split(",");
}
var _data = [];
var _label = "";
for(var _i=1;_i<=_count;_i++){
    _label = $("#label"+_i).val();
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
     //   borderDash:[5,5],
        data                : _line[_i]
    };
}

var _line = _line[1];
var areaChartData = {

    labels  : _line,

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
        _data[20], //グラフを最大20個まで準備　より必要であれば増やす

  ]
}


var areaChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: true
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : true,
        },
        ticks: {
            min: "0",
            max: "8000",
            maxTicksLimit: 8,
            minRotation: 0,
            maxRotation: 0,
            start:0
        }
      }],
      yAxes: [{
        gridLines : {
          display : true,
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
                value: 10, // 基準となる数値
                borderWidth: 3, // 基準線の太さ
                borderColor: 'red'  // 基準線の色
            },
            {
                type: 'line', // 線を描画
                id: 'hLine2',
                mode: 'vertical', // 線を水平に引く
                scaleID: 'x-axis-0',
                value: 20, // 基準となる数値
                borderWidth: 3, // 基準線の太さ
                borderColor: 'blue'  // 基準線の色
            }
        ]
    },
}


try{
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

}




