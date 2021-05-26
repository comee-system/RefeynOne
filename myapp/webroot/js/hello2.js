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
var areaChartData = {

    labels  : [
        '0', '100', '200', '300', '400', '500', '600','700','800','900',
        '1000', '1100', '1200', '1300', '1400', '1500', '1600','1700','1800','1900',
        '2000', '2100', '2200', '2300', '2400', '2500', '2600','2700','2800','2900',
    ],

    datasets: [
    {

      label               : 'Digital Goods',
      backgroundColor     : 'rgba(60,141,188,0.9)',
      borderColor         : 'rgba(60,141,188,0.8)',
      pointRadius          : false,
      pointColor          : '#3b8bba',
      pointStrokeColor    : 'rgba(60,141,188,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      lineTension: 0,
      data                : [
          28, 48, 40, 19, 86, 27, 90,
          28, 48, 40, 19, 86, 27, 90,
          28, 48, 40, 19, 86, 27, 90,
          28, 48, 40, 19, 86, 27, 90,
        ]
    },
    {
      label               : 'Digital Goods2',
      backgroundColor     : 'rgba(160,141,188,0.9)',
      borderColor         : 'rgba(160,141,188,0.8)',
      pointRadius          : false,
      pointColor          : '#3b8bba',
      pointStrokeColor    : 'rgba(60,141,188,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      lineTension: 0,

      data                : [
          128, 148, 140, 119, 186, 127, 190,
          128, 148, 140, 119, 186, 127, 190,
          128, 148, 140, 119, 186, 127, 190,
          128, 148, 140, 119, 186, 127, 190,
        ]
    },
    {
      label               : 'Electronics',
      backgroundColor     : 'rgba(210, 214, 222, 1)',
      borderColor         : 'rgba(210, 214, 222, 1)',
      pointRadius         : false,
      pointColor          : 'rgba(210, 214, 222, 1)',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      lineTension: 0,

      data                : [
          65, 59, 80, 81, 56, 55, 40,
          65, 59, 80, 81, 56, 55, 40,
          65, 59, 80, 81, 56, 55, 40,
          65, 59, 80, 81, 56, 55, 40,
        ]
    },
    {
      label               : 'Electronics',
      backgroundColor     : 'rgba(210, 214, 222, 1)',
      borderColor         : 'rgba(10, 14, 22, 1)',
      pointRadius         : false,
      pointColor          : 'rgba(210, 214, 222, 1)',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      lineTension: 0,

      data                : [
          100, 159, 180, 81, 156, 155, 140,
          100, 159, 180, 81, 156, 155, 140,
          100, 159, 180, 81, 156, 155, 140,
          100, 159, 180, 81, 156, 155, 140,
        ]
    },
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
            max: "3000",
            maxTicksLimit: 8,
            minRotation: 0,
            maxRotation: 0,
        }
      }],
      yAxes: [{
        gridLines : {
          display : true,
        }

      }]
    }
}


try{
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartData.datasets[2].fill = false;
    lineChartData.datasets[3].fill = false;
    lineChartOptions.datasetFill = false;


    var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    });
}catch(e){

}




