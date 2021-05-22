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

        if(typeof files[0] !== 'undefined') {
            //ファイルが正常に受け取れた際の処理
            $("#filename").text(files[0]['name']+"を選択しました。");
        } else {
            //ファイルが受け取れなかった際の処理
            $("#filename").text("ファイルの選択に失敗しました。");

        }
    });

    // input[type=file]に変更があれば実行
    // もちろんドロップ以外でも発火します
    fileInput.addEventListener('change', function(e){
        var file = e.target.files[0];
        if(typeof e.target.files[0] !== 'undefined') {
            // ファイルが正常に受け取れた際の処理
            $("#filename").text(file['name']+"を選択しました。");
        } else {
            // ファイルが受け取れなかった際の処理
            $("#filename").text("ファイルの選択に失敗しました。");

        }
    }, false);
}catch(e){}

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
        } else {
            // ファイルが受け取れなかった際の処理
            $("#filename2").text("ファイルの選択に失敗しました。");

        }
    }, false);
}catch(e){}

