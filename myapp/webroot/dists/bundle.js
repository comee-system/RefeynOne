/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./webroot/js/dropimage.js":
/*!*********************************!*\
  !*** ./webroot/js/dropimage.js ***!
  \*********************************/
/***/ (() => {

eval("// ドラッグ&ドロップエリアの取得\nvar fileArea = document.getElementById('dropArea');\n// input[type=file]の取得\nvar fileInput = document.getElementById('uploadFile');\ntry{\n    // ドラッグオーバー時の処理\n    fileArea.addEventListener('dragover', function(e){\n        e.preventDefault();\n        fileArea.classList.add('dragover');\n    });\n\n    // ドラッグアウト時の処理\n    fileArea.addEventListener('dragleave', function(e){\n        e.preventDefault();\n        fileArea.classList.remove('dragover');\n    });\n\n    // ドロップ時の処理\n    fileArea.addEventListener('drop', function(e){\n        e.preventDefault();\n        fileArea.classList.remove('dragover');\n\n        // ドロップしたファイルの取得\n        var files = e.dataTransfer.files;\n\n        // 取得したファイルをinput[type=file]へ\n        fileInput.files = files;\n\n        if(typeof files[0] !== 'undefined' && files[0].name.indexOf('.csv') !== -1 ) {\n            //ファイルが正常に受け取れた際の処理\n            $(\"#filename\").text(files[0]['name']+\"を選択しました。\");\n            $(this).fileupload();\n\n        } else {\n            //ファイルが受け取れなかった際の処理\n            $(\"#filename\").text(\"ファイルの選択に失敗しました。\");\n\n        }\n    });\n\n    // input[type=file]に変更があれば実行\n    // もちろんドロップ以外でも発火します\n    fileInput.addEventListener('change', function(e){\n\n        var file = e.target.files[0];\n        if(!file){\n            $(\"#filename\").text(\"ファイルの選択に失敗しました。\");\n        }else\n        if(typeof e.target.files[0] !== 'undefined'  && file.name.indexOf('.csv') !== -1  ) {\n            // ファイルが正常に受け取れた際の処理\n            $(\"#filename\").text(file['name']+\"を選択しました。\");\n\n            $(this).fileupload();\n\n        } else {\n            // ファイルが受け取れなかった際の処理\n            $(\"#filename\").text(\"ファイルの選択に失敗しました。\");\n\n        }\n    }, false);\n}catch(e){}\n\n\n$.fn.fileupload = function(){\n    var _label = window.prompt(\"Label名を入力してください\", \"\");\n    if(_label.match(/[^0-9a-zA-Z]+/i)){\n        alert(\"半角英数字のみ入力してください\");\n        return false;\n    }else\n    if(!_label){\n        alert(\"Label名が入力されていません。\");\n        return false;\n    }else{\n        $(\"#screen\").show();\n        let _upfile = $('input[name=\"uploadFile\"]');\n        let fd = new FormData();\n        fd.append(\"upfile\", _upfile.prop('files')[0]);\n\n        var _id = $(\"#id\").val();\n        $.ajax({\n            url:\"/graphs/upload/\"+_id+\"/RefeynOne/\"+_label,\n            type:\"post\",\n            data:fd,\n            processData:false,\n            contentType:false,\n            cache:false,\n        }).done(function(data){\n            if(data >= 1 ){\n                alert(\"ファイルのアップロードに失敗しました\");\n            }else{\n                $(\"#screen\").hide();\n                alert(\"ファイルのアップロードを行いました。\");\n                $(this).getGraphData();\n            }\n            console.log(data);\n\n        }).fail(function(){\n\n        });\n    }\n};\n\n\n\n//////////////////////////\n\n// ドラッグ&ドロップエリアの取得\nvar fileArea2 = document.getElementById('dropArea2');\n// input[type=file]の取得\nvar fileInput2 = document.getElementById('uploadFile2');\ntry{\n    // ドラッグオーバー時の処理\n    fileArea2.addEventListener('dragover', function(e){\n        e.preventDefault();\n        fileArea2.classList.add('dragover');\n    });\n\n    // ドラッグアウト時の処理\n    fileArea2.addEventListener('dragleave', function(e){\n        e.preventDefault();\n        fileArea2.classList.remove('dragover');\n    });\n\n    // ドロップ時の処理\n    fileArea2.addEventListener('drop', function(e){\n        e.preventDefault();\n        fileArea2.classList.remove('dragover');\n\n        // ドロップしたファイルの取得\n        var files = e.dataTransfer.files;\n\n        // 取得したファイルをinput[type=file]へ\n        fileInput2.files = files;\n\n        if(typeof files[0] !== 'undefined') {\n            //ファイルが正常に受け取れた際の処理\n            $(\"#filename2\").text(files[0]['name']+\"を選択しました。\");\n            $(this).fileupload2();\n        } else {\n            //ファイルが受け取れなかった際の処理\n            $(\"#filename2\").text(\"ファイルの選択に失敗しました。\");\n\n        }\n    });\n\n    // input[type=file]に変更があれば実行\n    // もちろんドロップ以外でも発火します\n    fileInput2.addEventListener('change', function(e){\n        var file = e.target.files[0];\n\n        if(typeof e.target.files[0] !== 'undefined') {\n            // ファイルが正常に受け取れた際の処理\n            $(\"#filename2\").text(file['name']+\"を選択しました。\");\n            $(this).fileupload2();\n        } else {\n            // ファイルが受け取れなかった際の処理\n            $(\"#filename2\").text(\"ファイルの選択に失敗しました。\");\n\n        }\n    }, false);\n}catch(e){}\n\n$.fn.fileupload2 = function(){\n    $(\"#screen\").show();\n    let _upfile = $('input[name=\"uploadFile2\"]');\n    let fd = new FormData();\n    fd.append(\"upfile\", _upfile.prop('files')[0]);\n    var _id = $(\"#id\").val();\n    $.ajax({\n        url:\"/graphs/upload/\"+_id+\"/mesurement\",\n        type:\"post\",\n        data:fd,\n        processData:false,\n        contentType:false,\n        cache:false,\n    }).done(function(data){\n        console.log(data);\n        if(data >= 1 ){\n            alert(\"ファイルのアップロードに失敗しました\");\n        }else{\n            $(\"#screen\").hide();\n            alert(\"ファイルのアップロードを行いました。\");\n            $(this).getGraphData();\n        }\n\n    }).fail(function(){\n\n    });\n};\n\n\n\n\n/////////////////////////////////////\n\n\n\n// ドラッグ&ドロップエリアの取得\nvar fileArea3 = document.getElementById('dropArea3');\n// input[type=file]の取得\nvar fileInput3 = document.getElementById('uploadFile3');\ntry{\n    // ドラッグオーバー時の処理\n    fileArea3.addEventListener('dragover', function(e){\n        e.preventDefault();\n        fileArea3.classList.add('dragover');\n    });\n\n    // ドラッグアウト時の処理\n    fileArea3.addEventListener('dragleave', function(e){\n        e.preventDefault();\n        fileArea3.classList.remove('dragover');\n    });\n\n    // ドロップ時の処理\n    fileArea3.addEventListener('drop', function(e){\n        e.preventDefault();\n        fileArea3.classList.remove('dragover');\n\n        // ドロップしたファイルの取得\n        var files = e.dataTransfer.files;\n\n        // 取得したファイルをinput[type=file]へ\n        fileInput3.files = files;\n        if(typeof files[0] !== 'undefined' && files[0].name.indexOf('.csv') !== -1 ) {\n            //ファイルが正常に受け取れた際の処理\n            $(\"#filename3\").text(files[0]['name']+\"を選択しました。\");\n            $(this).fileupload3();\n\n        } else {\n            //ファイルが受け取れなかった際の処理\n            $(\"#filename3\").text(\"ファイルの選択に失敗しました。\");\n\n        }\n    });\n\n    // input[type=file]に変更があれば実行\n    // もちろんドロップ以外でも発火します\n    fileInput3.addEventListener('change', function(e){\n\n        var file = e.target.files[0];\n        if(typeof e.target.files[0] !== 'undefined'  && file.name.indexOf('.csv') !== -1  ) {\n            // ファイルが正常に受け取れた際の処理\n            $(\"#filename3\").text(file['name']+\"を選択しました。\");\n\n            $(this).fileupload3();\n\n        } else {\n            // ファイルが受け取れなかった際の処理\n            $(\"#filename3\").text(\"ファイルの選択に失敗しました。\");\n\n        }\n    }, false);\n}catch(e){}\n\n\n$.fn.fileupload3 = function(){\n    $(\"#screen\").show();\n    let _upfile = $('input[name=\"uploadFile3\"]');\n\n    let fd = new FormData();\n    fd.append(\"upfile\", _upfile.prop('files')[0]);\n    var _id = $(\"#id\").val();\n    $.ajax({\n        url:\"/graphs/upload/\"+_id+\"/sop\",\n        type:\"post\",\n        data:fd,\n        processData:false,\n        contentType:false,\n        cache:false,\n    }).done(function(data){\n\n        if(data >= 1 ){\n            alert(\"ファイルのアップロードに失敗しました\");\n        }else{\n            $(\"#screen\").hide();\n            alert(\"ファイルのアップロードを行いました。\");\n        }\n        var _url = location.href;\n        location.href = _url;\n\n    }).fail(function(){\n\n    });\n};\n\n\n\n//////////////////////////\n\n\n\n\n//# sourceURL=webpack://myapp/./webroot/js/dropimage.js?");

/***/ }),

/***/ "./webroot/js/graph.js":
/*!*****************************!*\
  !*** ./webroot/js/graph.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"write3\": () => (/* binding */ write3)\n/* harmony export */ });\nconst write3 = function () {\n\n};\n$(function(){\n    //リセット\n    $(\"#dataResetButton\").click(function(){\n        $(\"[name='min_x']\").val(\"\");\n        $(\"[name='max_x']\").val(\"\");\n        $(\"[name='min_y']\").val(\"\");\n        $(\"[name='max_y']\").val(\"\");\n    });\n    $(this).getGraphData();\n\n    //エリアごとのテーブル反映\n    $(\"#tableReflect\").click(function(){\n        $(this).tableReflect();\n    });\n    $(\"#tableDataExport\").click(function(){\n        $(this).tableReflect(\"export\");\n    });\n\n    //ファイル削除\n    $(document).on(\"click\",\".grapdelete\",function(){\n        if(confirm(\"取込みファイルの削除を行います。よろしいですか?\")){\n            var _graph_id = $(\"#id\").val();\n            var _graph_data_id = $(this).attr(\"id\").split(\"-\")[1];\n            location.href=\"/graphs/delete/\"+_graph_id+\"/\"+_graph_data_id;\n            return true;\n        }\n        return false;\n    });\n    //label名変更\n    $(document).on(\"blur\",\".editlabel\",function(){\n        var _id = $(this).attr(\"id\").split(\"-\")[1];\n        var _val = $(this).val();\n        $(\"#errtext-\"+_id).hide();\n        if(_val.match(/[^0-9a-zA-Z]+/i)){\n            $(\"#errtext-\"+_id).show();\n            return false;\n        }\n        var _data = {\"label\":_val};\n        $.ajax({\n            url:\"/graphs/edit/\"+_id,\n            type:\"post\",\n            data:_data,\n            datatype: \"json\",\n        }).done(function(data){\n        }).fail(function(){\n\n        });\n        return false;\n    });\n\n    $(\"#addSop\").on(\"click\",function(){\n        var _id = $(\"#id\").val();\n        $.ajax({\n            url:\"/graphs/setSop/\"+_id,\n            type:\"post\",\n        }).done(function(jsonstr){\n            $(this).getSop();\n        });\n    });\n    $(this).getSop();\n\n    //sopText\n    $(\".sopText\").on(\"blur\",function(){\n        var _val = $(this).val();\n        var _name = $(this).attr(\"name\");\n        var _id = $(\"input[name='sopdefaultid']\").val();\n        var _data = {\n            name:_name,\n            value:_val\n        };\n        $.ajax({\n            url:\"/graphs/editsop/\"+_id,\n            type:\"post\",\n            data:_data,\n            datatype: \"json\",\n        }).done(function(jsonstr){\n            console.log(jsonstr);\n        });\n    });\n\n    var sopArea = $(\".sopArea\").length;\n    var _before = [];\n    if(sopArea > 0){\n        $(\".sopArea\").each(function(i, elem) {\n            var _id = $(this).attr(\"id\");\n            _before[_id] = $(this).val();\n        });\n    }\n\n    //SOPエリアの設定\n    $(\".sopArea\").on(\"blur\",function(event){\n        var _val = $(this).val();\n        var _name = $(this).attr(\"name\").split(\"-\");\n        var _id = parseInt(_name[1]);\n        _name = _name[0];\n        var _data = {\n            name:_name,\n            value:_val\n        };\n        $.ajax({\n            url:\"/graphs/editsoparea/\"+_id,\n            type:\"post\",\n            data:_data,\n            datatype: \"json\",\n        }).done(function(jsonstr){\n        });\n\n        return false;\n    });\n    //グラフ表示ステータス変更\n    /*\n    $(\".graph_status_edit\").click(function(){\n        var _id = $(this).parent(\"li\").attr(\"id\").split(\"-\");\n        var _chk = $(this).prop(\"checked\");\n\n        var _data = {\"id\":_id[1],\"chk\":_chk};\n        $.ajax({\n            url:\"/graphs/editDispStatus/\",\n            type:\"post\",\n            data:_data,\n        }).done(function(data){\n            console.log(data);\n        }).fail(function(){\n\n        });\n\n        return true;\n    });\n    */\n});\nvar ex = \"\";\n$.fn.tableReflect = function(ex = \"\"){\n\n    if(ex != \"export\"){\n        $(\".spinner\").show();\n        $(\"#areaTables\").html(\"\");\n    }\n    var _id = $(\"#id\").val();\n    //解析基準\n    var _basic = $(\"[name='analyticsBasic']:checked\").attr(\"id\");\n    //データ表示\n    var _display = $(\"[name='dataDisplay']:checked\").attr(\"id\");\n    var _data = {\n        \"basic\":_basic,\n        \"display\":_display,\n        \"exflag\":ex\n    };\n    $.ajax({\n        url:\"/graphs/getAreaTable/\"+_id,\n        type:\"post\",\n        data:_data,\n        datatype: \"json\",\n    }).done(function(data){\n        if(ex == \"export\"){ //tableDataExportボタンを押下\n            console.log(data);\n            location.href = \"/graphs/tabledataoutput/\"+_id;\n\n        }else{\n            console.log(data);\n            $(\".spinner\").hide();\n\n            var _areas = data.areas;\n            var _tbl = \"\";\n            $.each(_areas,function(key,value){\n                var _areamins = \"#areamins-\"+value[ 'id' ];\n                var _areamaxs = \"#areamaxs-\"+value[ 'id' ];\n                $(_areamins).html(value['minpoint']);\n                $(_areamaxs).html(value['maxpoint']);\n            });\n            var _label = data.label;\n            var _lists = data.lists;\n            var _table = \"\";\n            var _num = 1;\n            $(\"#areaTables\").html(\"\");\n            $.each(_label,function(_key,_value){\n                _table = \"<tr>\";\n                _table += \"<td>\"+_num+\"</td>\";\n                _table += \"<td>\"+_value.label+\"</td>\";\n                var _detail = _lists[_key];\n                console.log(_detail);\n                $.each(_detail,function(_k,_val){\n                    _table += \"<td>\"+_val.lot+\"%</td>\";\n                    _table += \"<td>\"+_val.ave+\"</td>\";\n                    _table += \"<td>\"+_val.median+\"</td>\";\n                    _table += \"<td>\"+_val.mode+\"</td>\";\n                });\n                _table += \"</tr>\";\n                $(\"#areaTables\").append(_table);\n                _num++;\n            });\n        }\n    }).fail(function(e){\n        console.log(\"error\");\n        console.log(e);\n    });\n    return false;\n\n};\n\n$.fn.getSop = function(){\n\n    try{\n        var _id = $(\"#id\").val();\n        if(!_id) return false;\n        $.ajax({\n            url:\"/graphs/getSop/\"+_id,\n            type:\"post\",\n            datatype: \"json\",\n        }).done(function(jsonstr){\n            var _tbl = \"\";\n\n        //  var data = $.parseJSON(jsonstr);\n            var data = jsonstr;\n            var _num = 1;\n            $(\"#soptbody\").html(\"\");\n            $.each(data, function(key, value){\n                _tbl = \"<tr class='sopcount' >\";\n                _tbl += \"<td>\"+value.name+\"</td>\";\n                _tbl += \"<td class='text-right'>\";\n                if(value.edit == 1){\n                    _tbl += \"<input type='text' id='sopmin-\"+value.id+\"' value='\"+value.minpoint+\"' class='form-control-sm' />\";\n                }else{\n                    _tbl += value.minpoint;\n                    _tbl += \"<input type='hidden' id='sopmin-\"+value.id+\"' value='\"+value.minpoint+\"' />\";\n                }\n                _tbl += \"</td>\";\n                _tbl += \"<td></td>\";\n                _tbl += \"<td class='text-right'>\";\n                if(value.edit == 1){\n                    _tbl += \"<input type='text' id='sopmax-\"+value.id+\"' value='\"+value.maxpoint+\"' class='form-control-sm' />\";\n                }else{\n                    _tbl += value.maxpoint;\n                    _tbl += \"<input type='hidden' id='sopmax-\"+value.id+\"' value='\"+value.maxpoint+\"' />\";\n                }\n\n                _tbl += \"</td>\";\n                _tbl += \"<td class='text-center'><input type='radio' id='sop-\"+value.id+\"' name='sop' /></td>\";\n                _tbl += \"</tr>\";\n                $(\"#soptbody\").append(_tbl);\n                _num += 1;\n            });\n\n        }).fail(function(){\n\n        });\n    }catch(e){\n\n    }\n\n};\n\n\n$.fn.getGraphData = function(){\n\n    try{\n        var _id = $(\"#id\").val();\n        if(!_id){\n            return false;\n        }\n        $.ajax({\n            url:\"/graphs/graphdata/\"+_id,\n            type:\"post\",\n            datatype: \"json\",\n        }).done(function(jsonstr){\n            var _tbl = \"\";\n\n        //  var data = $.parseJSON(jsonstr);\n            var data = jsonstr;\n            var _num = 1;\n            $(\"#tbody\").html(\"\");\n            $.each(data, function(key, value){\n                _tbl = \"<tr>\";\n                _tbl += \"<td>\"+_num+\"</td>\";\n                _tbl += \"<td><input type='text' class='form-control editlabel' maxlength=20 id='label-\"+value.id+\"' value='\"+value.label+\"' />\";\n                _tbl += \"<div class='text-danger text-hidden' id='errtext-\"+value.id+\"'>入力不可文字が含まれています。</div>\";\n                _tbl += \"</td>\";\n                _tbl += \"<td>\"+value.filename+\"</td>\";\n                _tbl += \"<td class='text-right'>\"+value.counts+\"</td>\";\n                _tbl += \"<td class='text-center'><button class='btn-sm btn-danger grapdelete' id='delete-\"+value.id+\"'>削除</button></td>\";\n                _tbl += \"</tr>\";\n                $(\"#tbody\").append(_tbl);\n                _num += 1;\n            });\n\n        }).fail(function(){\n\n        });\n    }catch(e){\n\n    }\n\n};\n\n\n//# sourceURL=webpack://myapp/./webroot/js/graph.js?");

/***/ }),

/***/ "./webroot/js/hello1.js":
/*!******************************!*\
  !*** ./webroot/js/hello1.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"write1\": () => (/* binding */ write1)\n/* harmony export */ });\nconst write1 = function () {\n    console.log(\"hello world123444\");\n};\n$(function(){\n\n\n\n\n});\n\n\n//# sourceURL=webpack://myapp/./webroot/js/hello1.js?");

/***/ }),

/***/ "./webroot/js/hello2.js":
/*!******************************!*\
  !*** ./webroot/js/hello2.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _hello1_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./hello1.js */ \"./webroot/js/hello1.js\");\n/* harmony import */ var _dropimage_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./dropimage.js */ \"./webroot/js/dropimage.js\");\n/* harmony import */ var _dropimage_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_dropimage_js__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _graph_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./graph.js */ \"./webroot/js/graph.js\");\n\n\n\n\n(0,_hello1_js__WEBPACK_IMPORTED_MODULE_0__.write1)();\n(0,_graph_js__WEBPACK_IMPORTED_MODULE_2__.write3)();\n\n//グラフを作る処理のみ\nif($(\"#createGraf\").length){\n    var _id = $(\"#id\").val();\n    var _data = {};\n    $.ajax({\n        url:\"/graphs/beforeStep3/\"+_id,\n        type:\"post\",\n        data:_data,\n        datatype: \"json\",\n    }).done(function(data){\n        location.href = \"/graphs/step3/\"+_id;\n    }).fail(function(){\n\n    });\n\n};\n\n$(\"#nextStep3\").click(function(){\n    //(グラフの終了値 - グラフの開始値)/ Binサイズが　３００までOKとする。\n    var _fin = $(\"#dispareamax\").val();\n    var _start = $(\"#defaultpoint\").val();\n    var _bin = $(\"#binsize\").val();\n    var _result = (_fin-_start)/_bin;\n\n    if(_result > 300){\n        var _message = \"(グラフの終了値 - グラフの開始値)/ Binサイズが300を超えています。\\n300以下になるように再設定してください。\\n\\n\";\n        _message += \"参考\\n・10,000 50 →メッシュ　200　12s\\n・10,000 25 →メッシュ　400    19s\";\n        alert(_message);\n        return false;\n    }\n    return true;\n\n});\n\n$(\"#finishbutton\").click(function(){\n    if(confirm(\"終了後、データを削除します。解析情報を残すには「取込データ出力」と「SOP設定出力」、「エリア毎の結果テーブル出力」をしてから終了してください。\")){\n        return true;\n    }\n    return false;\n});\n\n\n//解析ページのselectbox\n//Bootstrap Duallistbox\n$('.duallistbox').bootstrapDualListbox({\n    filterTextClear:'全件表示',\n    filterPlaceHolder:'検索',\n    moveSelectedLabel:'選択済みに移動',\n    moveAllLabel:'選択済みに全て移動',\n    removeSelectedLabel:'選択を解除',\n    removeAllLabel:'選択を全て解除',\n    moveOnSelect: true,\n    nonSelectedListLabel: '取り込まれたデータ',\n    selectedListLabel: '表示させるデータ',\n    infoText:'{0}件',\n    showFilterInputs:false,\n    infoTextEmpty:'0件',\n    infoTextFiltered:'{1}件中{0}件表示',\n    selectorMinimalHeight:400\n});\n\n$(\"#sortable\").sortable({\n    /*\n    update: function(){\n        //console.log($('#sortable').sortable(\"toArray\"));\n        var _data = {\"array\":$('#sortable').sortable(\"toArray\")};\n        var _id = $(\"#id\").val();\n        $.ajax({\n            url:\"/graphs/editSortArray/\"+_id,\n            type:\"post\",\n            data:_data,\n            datatype: \"json\",\n        }).done(function(data){\n            console.log(data);\n            console.log(\"Sort\");\n\n        }).fail(function(){\n\n        });\n\n    },\n    */\n    axis: 'y',\n});\n\n$(\"#pngExport\").on(\"click\",function(){\n    let canvas = document.getElementById('lineChart');\n    let png = canvas.toDataURL();\n    let link = document.createElement(\"a\");\n    link.href = canvas.toDataURL(\"image/png\");\n    var date = new Date() ;\n    link.download = date.getTime()+\".png\";\n    link.click();\n\n    return false;\n});\n\n\n//グラフの作成\nvar _maxTicksLimit = 10; //値の最大表示数\nvar _areamin = 0;\nvar _areamax = 0;\ncreateGraf();\n//グラフ反映ボタン\n$(\"[name='reflect_graf']\").click(function(){\n\n    //値のチェック\n    var _id = $(this).attr(\"id\").split(\"-\");\n    var _minpoint = $(\"#minpoint-\"+_id[2]).val();\n    var _maxpoint = $(\"#maxpoint-\"+_id[2]).val();\n     if(parseInt(_minpoint) >= parseInt(_maxpoint)){\n        alert(\"エリア設定の入力値に不備があります。\");\n        return false;\n    }\n\n    creatLine();\n    createGraf();\n});\n\n//解析基準\n$(document).on(\"click\",\"[name='analyticsBasic']\",function(){\n    //表示用データの切り替えを行う\n    createDispGraph();\n});\n$(document).on(\"click\",\"[name='dataDisplay']\",function(){\n    //表示用データの切り替えを行う\n    createDispGraph();\n});\n//データ範囲\n$(document).on(\"click\",\"#dataAreaButton\",function(){\n    //表示用データの切り替えを行う\n    createDispGraph();\n});\n\n//スムージングの切り替えを行う\n$(document).on(\"change\",\"select#selectSmoothId\",function(){\n    editSmooth();\n});\n//CSVExport\n$(document).on(\"click\",\"#CSVExport\",function(){\n    var _basic = $(\"[name='analyticsBasic']:checked\").attr(\"id\");\n    //データ表示\n    var _display = $(\"[name='dataDisplay']:checked\").attr(\"id\");\n    $(\"#CSVExport_analyticsBasic\").val(_basic);\n    $(\"#CSVExport_dataDisplay\").val(_display);\n\n\n    var _min_x = $(\"input[name='min_x']\").val();\n    var _max_x = $(\"input[name='max_x']\").val();\n    var _min_y = $(\"input[name='min_y']\").val();\n    var _max_y = $(\"input[name='max_y']\").val();\n    $(\"#CSVExport_min_x\").val(_min_x);\n    $(\"#CSVExport_max_x\").val(_max_x);\n    $(\"#CSVExport_min_y\").val(_min_y);\n    $(\"#CSVExport_max_y\").val(_max_y);\n\n    $(\"#CSVExportForm\").submit();\n    return false;\n});\nfunction editSmooth(){\n    var _id = $(\"#id\").val();\n    var _selectSmoothId = $(\"#selectSmoothId\").val();\n    var _data = {\n        \"smooth\":_selectSmoothId,\n    };\n    $.ajax({\n        url:\"/graphs/editDispSmooth/\"+_id,\n        type:\"post\",\n        data:_data,\n        datatype: \"json\",\n    }).done(function(data){\n        //表示用データの切り替えを行う\n        createDispGraph();\n\n    }).fail(function(){\n\n    });\n    return true;\n}\nvar _defaultlabels = $(\"#binline\").val();\n\nfunction createDispGraph(){\n\n\n    //X軸の表示範囲指定\n    var _labels = _defaultlabels.split(\",\");\n    var _min_x = $(\"input[name='min_x']\").val();\n    var _max_x = $(\"input[name='max_x']\").val();\n    var _min_y = $(\"input[name='min_y']\").val();\n    var _max_y = $(\"input[name='max_y']\").val();\n    if(parseFloat(_min_x) >= parseFloat(_max_x)){\n        alert(\"表示データ範囲に誤りがあります。\");\n        return false;\n    }\n    if(parseFloat(_min_y) >= parseFloat(_max_y)){\n        alert(\"表示データ範囲に誤りがあります。\");\n        return false;\n    }\n\n    $(\"#screen\").show();\n\n    var _bl = [];\n    var _i=0;\n    if(_min_x && _max_x ){\n        $(\"#defaultpoint\").val(_min_x);\n        $(\"#dispareamax\").val(_max_x);\n        $.each(_labels,function(key,value){\n            if(\n                parseInt(_min_x) <= parseInt(value) &&\n                parseInt(value) <= parseInt(_max_x)\n            ){\n                _bl[_i] = value;\n                _i++;\n            }\n        });\n        var _join = _bl.join();\n       // console.log(_join);\n        $(\"#binline\").val(_join);\n    }else{\n        $(\"#binline\").val(_defaultlabels);\n    }\n\n    var _id = $(\"#id\").val();\n    //解析基準\n    var _basic = $(\"[name='analyticsBasic']:checked\").attr(\"id\");\n    //データ表示\n    var _display = $(\"[name='dataDisplay']:checked\").attr(\"id\");\n    var _data = {\n        \"basic\":_basic,\n        \"display\":_display,\n        \"min_x\":_min_x,\n        \"max_x\":_max_x,\n        \"min_y\":_min_y,\n        \"max_y\":_max_y,\n    };\n    $.ajax({\n        url:\"/graphs/createDispGraph/\"+_id,\n        type:\"post\",\n        data:_data,\n       // datatype: \"json\",\n    }).done(function(data){\n        console.log(data);\n        $(\".graphe_point\").remove();\n        $(\".graphe_data\").remove();\n        var _num = 1;\n        var _cnt = \"\";\n        var _label = \"\";\n\n        $.each(data['list'],function(key,value){\n            var _hidden = \"\";\n            _cnt = value.cnt;\n            _label = value.label;\n            _hidden += \"<input type='hidden' class='graphe_point' id='line\"+_num+\"' value='\"+_cnt+\"' />\";\n            _hidden += \"<input type='hidden' class='graphe_data' id='label\"+_num+\"' value='\"+_label+\"' />\";\n            _num = _num+1;\n            $(\"#cardbody\").append(_hidden);\n        });\n\n        $(\"#screen\").hide();\n        console.log(\"OK\");\n        creatLine();\n\n        $(\"#maxcountlimit\").val(data['max']);\n        createGraf();\n\n    }).fail(function(){\n\n    });\n\n}\n//エリア設定で縦ラインを引く値\nfunction creatLine(){\n    var _dispareamax = $(\"#dispareamax\").val();\n    var _memori = _dispareamax/_maxTicksLimit; //グラフの区切り値\n    var _separate = _dispareamax/_memori;\n    var _chk = $(\"[name='reflect_graf']:checked\").attr(\"id\");\n    if(!_chk) return false;\n    var _id = _chk.split(\"-\")[2];\n    var _maxpoint = $(\"#maxpoint-\"+_id).val();\n    var _bin = $(\"#binsize\").val()/_maxTicksLimit;\n\n\n    var _min_x = $(\"input[name='min_x']\").val();\n    var _max_x = $(\"input[name='max_x']\").val();\n\n    _areamax = ((_maxpoint-_min_x)/_separate)/_bin;\n    var _minpoint = $(\"#minpoint-\"+_id).val();\n    _areamin = ((_minpoint-_min_x)/_separate)/_bin;\n\n}\n\n\nfunction createGraf(){\n\n    var _basic = $(\"[name='analyticsBasic']:checked\").next().text();\n    var _display = $(\"[name='dataDisplay']:checked\").attr(\"id\");\n    if(_display == \"dataDisplay1\") _display = \"counts\";\n    if(_display == \"dataDisplay2\") _display = \"signal ratio\";\n\n    //-------------\n    //- LINE CHART -\n    //--------------\n    //色指定\n    var _r = [];\n    var _g = [];\n    var _b = [];\n    _r[1] = \"0\";\n    _g[1] = \"176\";\n    _b[1] = \"240\";\n\n    _r[2] = \"0\";\n    _g[2] = \"176\";\n    _b[2] = \"240\";\n\n    _r[3] = \"175\";\n    _g[3] = \"171\";\n    _b[3] = \"171\";\n\n    _r[4] = \"175\";\n    _g[4] = \"171\";\n    _b[4] = \"171\";\n\n    _r[5] = \"0\";\n    _g[5] = \"176\";\n    _b[5] = \"80\";\n\n    _r[6] = \"0\";\n    _g[6] = \"176\";\n    _b[6] = \"80\";\n\n\n    _r[7] = \"255\";\n    _g[7] = \"192\";\n    _b[7] = \"0\";\n\n    _r[8] = \"255\";\n    _g[8] = \"192\";\n    _b[8] = \"0\";\n\n    _r[9] = \"0\";\n    _g[9] = \"112\";\n    _b[9] = \"192\";\n\n    _r[0] = \"0\";\n    _g[0] = \"112\";\n    _b[0] = \"192\";\n\n    var _pt = 0;\n    var _line = [];\n    var _count = $(\".graphe_point\").length;\n    for(var _i=1;_i<=_count;_i++){\n        _line[_i] = $(\"#line\"+_i).val().split(\",\");\n    }\n    var _data = [];\n    var _label = \"\";\n    var _bd = 0;\n    for(var _i=1;_i<=_count;_i++){\n        _label = $(\"#label\"+_i).val();\n        _bd = 0;\n        if(_i%2 == 0)_bd = 5;\n        _data[_i] =\n        {\n            label               : _label,\n            backgroundColor     : 'rgba(60,141,188,0.9)',\n            borderColor         : 'rgba('+_r[_i%10]+','+_g[_i%10]+','+_b[_i%10]+',0.8)',\n            pointRadius          : false,\n            pointColor          : '#3b8bba',\n            pointStrokeColor    : 'rgba(60,141,188,1)',\n            pointHighlightFill  : '#fff',\n            pointHighlightStroke: 'rgba(60,141,188,1)',\n            lineTension: 0,\n            borderDash:[_bd,_bd],\n            data                : _line[_i]\n        };\n    }\n    try{\n        var _min_y = $(\"[name='min_y']\").val();\n        var _max_y = $(\"[name='max_y']\").val();\n\n        var _labels = $(\"#binline\").val().split(\",\");\n        var areaChartData = {\n\n            labels  : _labels,\n\n            datasets: [\n                _data[1],\n                _data[2],\n                _data[3],\n                _data[4],\n                _data[5],\n                _data[6],\n                _data[7],\n                _data[8],\n                _data[9],\n                _data[10],\n                _data[12],\n                _data[13],\n                _data[14],\n                _data[15],\n                _data[16],\n                _data[17],\n                _data[18],\n                _data[19],\n                _data[20],\n                _data[21],\n                _data[22],\n                _data[23],\n                _data[24],\n                _data[25],\n                _data[26],\n                _data[27],\n                _data[28],\n                _data[29],\n                _data[30], //グラフを最大30個まで準備　より必要であれば増やす\n            ]\n        }\n        var areaChartOptions = {\n            maintainAspectRatio : false,\n            responsive : true,\n            legend: {\n            display: true,\n            align:\"end\"\n            },\n            scales: {\n            xAxes: [{\n                gridLines : {\n                display : true,\n                },\n                ticks: {                       // 目盛り\n                    min: 0,                        // 最小値\n                    autoSkip: true,\n                    maxTicksLimit: _maxTicksLimit, //値の最大表示数\n                    fontColor: \"black\",             // 目盛りの色\n                    fontSize: 11,                   // フォントサイズ\n                    maxRotation: 0,\n                    minRotation: 0,\n                },\n                scaleLabel: {                  // 軸ラベル\n                    display: true,                 // 表示の有無\n                    labelString: 'Mw('+_basic+')',     // ラベル\n                    fontFamily: \"sans-serif\",\n                    fontColor: \"black\",             // 文字の色\n                    fontFamily: \"sans-serif\",\n                    fontSize: 11                   // フォントサイズ\n                },\n            }],\n            yAxes: [{\n                gridLines : {\n                display : true,\n                color: \"rgba(0, 0, 255, 0.2)\", // 補助線の色\n                zeroLineColor: \"black\",         // y=0（Ｘ軸の色）\n                },\n                scaleLabel: {                  // 軸ラベル\n                    display: true,                 // 表示の有無\n                    labelString: _display,     // ラベル\n                    fontFamily: \"sans-serif\",\n                    fontColor: \"black\",             // 文字の色\n                    fontFamily: \"sans-serif\",\n                    fontSize: 11,                   // フォントサイズ\n                },\n\n                ticks: {                       // 目盛り\n                 //   min: 0,                        // 最小値\n                 //   max : _mpoint,                       // 最大値\n                 //   stepSize: 100,                   // 軸間隔\n                    fontColor: \"black\",             // 目盛りの色\n                    fontSize: 11                   // フォントサイズ\n                }\n            }]\n\n            },\n\n            annotation: {\n                annotations: [\n                    {\n                        type: 'line', // 線を描画\n                        id: 'hLine',\n                        mode: 'vertical', // 線を水平に引く\n                        scaleID: 'x-axis-0',\n                        value: _areamin, // 基準となる数値\n                        borderWidth: 3, // 基準線の太さ\n                        borderColor: 'red'  // 基準線の色\n                    },\n                    {\n                        type: 'line', // 線を描画\n                        id: 'hLine2',\n                        mode: 'vertical', // 線を水平に引く\n                        scaleID: 'x-axis-0',\n                        value: _areamax, // 基準となる数値\n                        borderWidth: 3, // 基準線の太さ\n                        borderColor: 'red'  // 基準線の色\n                    }\n                ]\n            },\n        }\n\n        if(_min_y){\n            areaChartOptions['scales']['yAxes']['0']['ticks']['min'] = parseInt(_min_y);\n        }\n        if(_max_y){\n            areaChartOptions['scales']['yAxes']['0']['ticks']['max'] = parseInt(_max_y);\n        }\n        var canvas = $('#lineChart').get(0);\n        var lineChartCanvas = canvas.getContext('2d');\n\n        var lineChartOptions = $.extend(true, {}, areaChartOptions);\n        var lineChartData = $.extend(true, {}, areaChartData);\n        for(var _i=0;_i<_count;_i++){\n            lineChartData.datasets[_i].fill = false;\n        }\n        lineChartOptions.datasetFill = false;\n\n\n        var lineChart = new Chart(lineChartCanvas, {\n            type: 'line',\n            data: lineChartData,\n            options: lineChartOptions\n        });\n\n    }catch(e){\n        console.log(\"error\");\n        console.log(e);\n    }\n}\n\n\n\n\n\n//# sourceURL=webpack://myapp/./webroot/js/hello2.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./webroot/js/hello2.js");
/******/ 	
/******/ })()
;