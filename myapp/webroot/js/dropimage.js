// ドラッグ&ドロップエリアの取得
var fileArea = document.getElementById('dropArea');
// input[type=file]の取得
var fileInput = document.getElementById('uploadFile');
try{
    // ドラッグオーバー時の処理
    fileArea.addEventListener('dragover', function(e){
        e.preventDefault();
        fileArea.classList.add('dragover');
    });

    // ドラッグアウト時の処理
    fileArea.addEventListener('dragleave', function(e){
        e.preventDefault();
        fileArea.classList.remove('dragover');
    });

    // ドロップ時の処理
    fileArea.addEventListener('drop', function(e){
        e.preventDefault();
        fileArea.classList.remove('dragover');

        // ドロップしたファイルの取得
        var files = e.dataTransfer.files;

        // 取得したファイルをinput[type=file]へ
        fileInput.files = files;

        if(typeof files[0] !== 'undefined' && files[0].name.indexOf('.csv') !== -1 ) {
            //ファイルが正常に受け取れた際の処理
            $("#filename").text(files[0]['name']+"を選択しました。");
            $(this).fileupload();

        } else {
            //ファイルが受け取れなかった際の処理
            $("#filename").text("ファイルの選択に失敗しました。");

        }
    });

    // input[type=file]に変更があれば実行
    // もちろんドロップ以外でも発火します
    fileInput.addEventListener('change', function(e){

        var file = e.target.files[0];
        if(!file){
            $("#filename").text("ファイルの選択に失敗しました。");
        }else
        if(typeof e.target.files[0] !== 'undefined'  && file.name.indexOf('.csv') !== -1  ) {
            // ファイルが正常に受け取れた際の処理
            $("#filename").text(file['name']+"を選択しました。");

            $(this).fileupload();

        } else {
            // ファイルが受け取れなかった際の処理
            $("#filename").text("ファイルの選択に失敗しました。");

        }
    }, false);
}catch(e){}


$.fn.fileupload = function(){
    var _label = window.prompt("ユーザー名を入力してください", "");
    if(!_label){
        alert("ユーザ名が入力されていません。");
        return false;
    }else{
        $("#screen").show();
        let _upfile = $('input[name="uploadFile"]');
        let fd = new FormData();
        fd.append("upfile", _upfile.prop('files')[0]);

        var _id = $("#id").val();
        $.ajax({
            url:"/graphs/upload/"+_id+"/RefeynOne/"+_label,
            type:"post",
            data:fd,
            processData:false,
            contentType:false,
            cache:false,
        }).done(function(data){
            if(data >= 1 ){
                alert("ファイルのアップロードに失敗しました");
            }else{
                $("#screen").hide();
                alert("ファイルのアップロードを行いました。");
                $(this).getGraphData();
            }
            console.log(data);

        }).fail(function(){

        });
    }
};



//////////////////////////

// ドラッグ&ドロップエリアの取得
var fileArea2 = document.getElementById('dropArea2');
// input[type=file]の取得
var fileInput2 = document.getElementById('uploadFile2');
try{
    // ドラッグオーバー時の処理
    fileArea2.addEventListener('dragover', function(e){
        e.preventDefault();
        fileArea2.classList.add('dragover');
    });

    // ドラッグアウト時の処理
    fileArea2.addEventListener('dragleave', function(e){
        e.preventDefault();
        fileArea2.classList.remove('dragover');
    });

    // ドロップ時の処理
    fileArea2.addEventListener('drop', function(e){
        e.preventDefault();
        fileArea2.classList.remove('dragover');

        // ドロップしたファイルの取得
        var files = e.dataTransfer.files;

        // 取得したファイルをinput[type=file]へ
        fileInput2.files = files;

        if(typeof files[0] !== 'undefined') {
            //ファイルが正常に受け取れた際の処理
            $("#filename2").text(files[0]['name']+"を選択しました。");
            $(this).fileupload2();
        } else {
            //ファイルが受け取れなかった際の処理
            $("#filename2").text("ファイルの選択に失敗しました。");

        }
    });

    // input[type=file]に変更があれば実行
    // もちろんドロップ以外でも発火します
    fileInput2.addEventListener('change', function(e){
        var file = e.target.files[0];

        if(typeof e.target.files[0] !== 'undefined') {
            // ファイルが正常に受け取れた際の処理
            $("#filename2").text(file['name']+"を選択しました。");
            $(this).fileupload2();
        } else {
            // ファイルが受け取れなかった際の処理
            $("#filename2").text("ファイルの選択に失敗しました。");

        }
    }, false);
}catch(e){}

$.fn.fileupload2 = function(){
    $("#screen").show();
    let _upfile = $('input[name="uploadFile2"]');
    let fd = new FormData();
    fd.append("upfile", _upfile.prop('files')[0]);
    var _id = $("#id").val();
    $.ajax({
        url:"/graphs/upload/"+_id+"/mesurement",
        type:"post",
        data:fd,
        processData:false,
        contentType:false,
        cache:false,
    }).done(function(data){
        console.log(data);
        if(data >= 1 ){
            alert("ファイルのアップロードに失敗しました");
        }else{
            $("#screen").hide();
            alert("ファイルのアップロードを行いました。");
            $(this).getGraphData();
        }

    }).fail(function(){

    });
};




/////////////////////////////////////



// ドラッグ&ドロップエリアの取得
var fileArea3 = document.getElementById('dropArea3');
// input[type=file]の取得
var fileInput3 = document.getElementById('uploadFile3');
try{
    // ドラッグオーバー時の処理
    fileArea3.addEventListener('dragover', function(e){
        e.preventDefault();
        fileArea3.classList.add('dragover');
    });

    // ドラッグアウト時の処理
    fileArea3.addEventListener('dragleave', function(e){
        e.preventDefault();
        fileArea3.classList.remove('dragover');
    });

    // ドロップ時の処理
    fileArea3.addEventListener('drop', function(e){
        e.preventDefault();
        fileArea3.classList.remove('dragover');

        // ドロップしたファイルの取得
        var files = e.dataTransfer.files;

        // 取得したファイルをinput[type=file]へ
        fileInput3.files = files;
        if(typeof files[0] !== 'undefined' && files[0].name.indexOf('.csv') !== -1 ) {
            //ファイルが正常に受け取れた際の処理
            $("#filename3").text(files[0]['name']+"を選択しました。");
            $(this).fileupload3();

        } else {
            //ファイルが受け取れなかった際の処理
            $("#filename3").text("ファイルの選択に失敗しました。");

        }
    });

    // input[type=file]に変更があれば実行
    // もちろんドロップ以外でも発火します
    fileInput3.addEventListener('change', function(e){

        var file = e.target.files[0];
        if(typeof e.target.files[0] !== 'undefined'  && file.name.indexOf('.csv') !== -1  ) {
            // ファイルが正常に受け取れた際の処理
            $("#filename3").text(file['name']+"を選択しました。");

            $(this).fileupload3();

        } else {
            // ファイルが受け取れなかった際の処理
            $("#filename3").text("ファイルの選択に失敗しました。");

        }
    }, false);
}catch(e){}


$.fn.fileupload3 = function(){
    $("#screen").show();
    let _upfile = $('input[name="uploadFile3"]');

    let fd = new FormData();
    fd.append("upfile", _upfile.prop('files')[0]);
    var _id = $("#id").val();
    $.ajax({
        url:"/graphs/upload/"+_id+"/sop",
        type:"post",
        data:fd,
        processData:false,
        contentType:false,
        cache:false,
    }).done(function(data){

        if(data >= 1 ){
            alert("ファイルのアップロードに失敗しました");
        }else{
            $("#screen").hide();
            alert("ファイルのアップロードを行いました。");
        }
        var _url = location.href;
        location.href = _url;

    }).fail(function(){

    });
};



//////////////////////////


