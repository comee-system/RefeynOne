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
    var _labels = $("#binline").val().split(",");
    console.log(_labels);

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
                maxTicksLimit: 50, //値の最大表示数
                fontColor: "black",             // 目盛りの色
                fontSize: 11,                   // フォントサイズ
                maxRotation: 90,
                minRotation: 90
            },
            scaleLabel: {                  // 軸ラベル
                display: true,                 // 表示の有無
                labelString: 'Mv',     // ラベル
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
            zeroLineColor: "black"         // y=0（Ｘ軸の色）
            },
            scaleLabel: {                  // 軸ラベル
                display: true,                 // 表示の有無
                labelString: 'Y',     // ラベル
                fontFamily: "sans-serif",
                fontColor: "black",             // 文字の色
                fontFamily: "sans-serif",
                fontSize: 16                   // フォントサイズ
            },
            ticks: {                       // 目盛り
                min: 0,                        // 最小値
            //    max: 1000,                       // 最大値
            //    stepSize: 100,                   // 軸間隔
                fontColor: "black",             // 目盛りの色
                fontSize: 14                   // フォントサイズ
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
                    value: 1.2, // 基準となる数値
                    borderWidth: 3, // 基準線の太さ
                    borderColor: 'red'  // 基準線の色
                },
                {
                    type: 'line', // 線を描画
                    id: 'hLine2',
                    mode: 'vertical', // 線を水平に引く
                    scaleID: 'x-axis-0',
                    value: 2, // 基準となる数値
                    borderWidth: 3, // 基準線の太さ
                    borderColor: 'blue'  // 基準線の色
                }
            ]
        },
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

}




