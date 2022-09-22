$(function() {
    // 数値入力時、値を取得して、3桁区切りでカンマをつける。
    $(document).on('change', '.vd-number', function() {
      changeNumber(this);
    });


    // 日付入力時の処理
    $(document).on('change', '.vd-date', function() {
      var val = $(this).val();
      var l = val.length;

      if (!notEnteredCheck($(this))) {
        // スラッシュが無い場合、スラッシュを入れる処理を実行
        if (val.indexOf('/') == -1) {

          // 全角文字を半角に変更
          val = val.replace(/[０-９]/g, function(s) {
            return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
          });

          var y = val.slice(0, l - 4);
          var m = val.slice(-4, l - 2);
          var d = val.slice(-2, l);

          if ($(this).hasClass('vd-ym')) {
            // ym許容の場合、4文字以下はyymm、それ以外はyymmddとして扱う
            if (l <= 4) {
              var result = m + '/' + d;
            } else {
              var result = y + '/' + m + '/' + d;
            }
          } else {
            // 通常パターン
            var result = y + '/' + m + '/' + d;

          }

          $(this).val(result);
        }
      }
    });

    // 時刻入力時の処理
    $(document).on('change', '.vd-time', function() {
      var val = $(this).val();
      var l = val.length;

      if (!notEnteredCheck($(this))) {
        // :が無い場合、:を入れる処理を実行
        if (val.indexOf(':') == -1) {

          // 全角文字を半角に変更
          val = val.replace(/[０-９]/g, function(s) {
            return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
          });

          var h = val.slice(0, 2);
          var s = val.slice(2, 2);

          var result = h + ':' + s;

          $(this).val(result);
        }
      }
    });

    // datalist
    $(document).on('change', '.datalist', function () {
      var val = $(this).val();
      var list_id = $(this).attr('list');
      var code_input = $(this).closest('.datalist-wrap').find('.datalist-code');
      var code = $('#' + list_id + ' option[value="' + val + '"]').data('hidden');
      var name_input = $(this).closest('.datalist-wrap').find('.datalist-name');
      var name = $('#' + list_id + ' option[value="' + val + '"]').data('name');

      code_input.val(code);
      name_input.val(name);
      code_input.trigger('change');
      name_input.trigger('change');
    });
  });


  // 画面読み込み時の処理
  $(window).on('load', function() {

    // numberの表示調整
    $('.vd-number').each(function(e) {
      changeNumber(this);
    });

  });

  function validationChk(parentBox, msgArr) {
    // 特殊文字チェック
    characterCheck(parentBox, msgArr);

    // 必須チェック
    requiredCheck(parentBox, msgArr);

    // radio・checkbox必須チェック
    checkboxRequiredCheck(parentBox, msgArr);

    // ひとつ以上の入力必須
    multiRequiredCheck(parentBox, msgArr);

    // いずれかの入力必須
    anyRequiredCheck(parentBox, msgArr);

    // 文字数
    countCheck(parentBox, msgArr);

    // 文字型
    characterTypeCheck(parentBox, msgArr);

    // 日付の妥当性チェック
    vdDateCheck(parentBox, msgArr);

    // 日付(最小・最大)
    dateRangeCheck(parentBox, msgArr);

    // 日付（TO）
    dateToCheck(parentBox, msgArr);

    // 日付（FROM）
    dateFromCheck(parentBox, msgArr);

    // 日付（今日以降）
    dateTodayCheck(parentBox, msgArr);

    // Aが選択されている場合、Bは必須
    connectRequiredCheck(parentBox, msgArr);

    // 数字
    numberCheck(parentBox, msgArr);

    // 数字(最大最小)
    numberRangeCheck(parentBox, msgArr);

    // 数字FTOM
    numberFromCheck(parentBox, msgArr);

    // 数字TO
    numberToCheck(parentBox, msgArr);

    // 時刻
    timeCheck(parentBox, msgArr);

    // 時刻（FROM）
    timeFromCheck(parentBox, msgArr);

    // 時刻（TO）
    timeToCheck(parentBox, msgArr);

    // datalistチェックfunction
    datalistCheck(parentBox, msgArr);

    // メールアドレス
    mailCheck(parentBox, msgArr);

  }

  // 必須チェック系を除外
  function validationChkNoRequired(parentBox, msgArr) {

    // 特殊文字チェック
    characterCheck(parentBox, msgArr);

    // 文字数
    countCheck(parentBox, msgArr);

    // 文字型
    characterTypeCheck(parentBox, msgArr);

    // 日付の妥当性チェック
    vdDateCheck(parentBox, msgArr);

    // 日付(最小・最大)
    dateRangeCheck(parentBox, msgArr);

    // 日付（TO）
    dateToCheck(parentBox, msgArr);

    // 日付（FROM）
    dateFromCheck(parentBox, msgArr);

    // 日付（今日以降）
    dateTodayCheck(parentBox, msgArr);

    // 数字
    numberCheck(parentBox, msgArr);

    // 数字(最大最小)
    numberRangeCheck(parentBox, msgArr);

    // 数字FTOM
    numberFromCheck(parentBox, msgArr);

    // 数字TO
    numberToCheck(parentBox, msgArr);

    // 時刻
    timeCheck(parentBox, msgArr);

    // 時刻（FROM）
    timeFromCheck(parentBox, msgArr);

    // 時刻（TO）
    timeToCheck(parentBox, msgArr);

    // datalistチェックfunction
    datalistCheck(parentBox, msgArr);

    // メールアドレス
    mailCheck(parentBox, msgArr);

  }



  // 特殊文字チェック
  function characterCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('input[type=text], textarea');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var searchTxt = /[①②③④⑤⑥⑦⑧⑨⑩⑪⑫⑬⑭⑮⑯⑰⑱⑲⑳ⅠⅡⅢⅣⅤⅥⅦⅧⅨⅩⅰⅱⅲⅳⅴⅵⅶⅷⅸⅹ㍉㌔㌢㍍㌘㌧㌃㌶㍑㍗㌍㌦㌣㌫㍊㌻㎜㎝㎞㎎㎏㏄㎡〝〟∵№㏍℡㊤㊥㊦㊧㊨㈱㈲㈹㍾㍽㍼㍻㋿≡∑∫]+/g;
      var searchTxt2 = /[纊褜鍈銈蓜俉炻昱棈鋹曻彅丨仡仼伀伃伹佖侒侊侚侔俍偀倢俿倞偆偰偂傔僴僘兊兤冝冾凬刕劜劦勀勛匀匇匤卲厓厲叝﨎咜咊咩哿喆坙坥垬埈埇﨏塚增墲夋奓奛奝奣妤妺孖寀甯寘寬尞岦岺峵崧嵓﨑嵂嵭嶸嶹巐弡弴彧德忞恝悅悊惞惕愠惲愑愷愰憘戓抦揵摠撝擎敎昀昕昻昉昮昞昤晥晗晙晴晳暙暠暲暿曺朎朗杦枻桒柀栁桄棏﨓楨﨔榘槢樰橫橆橳橾櫢櫤毖氿汜沆汯泚洄涇浯涖涬淏淸淲淼渹湜渧渼溿澈澵濵瀅瀇瀨炅炫焏焄煜煆煇凞燁燾犱犾猤猪獷玽珉珖珣珒琇珵琦琪琩琮瑢璉璟甁畯皂皜皞皛皦益睆劯砡硎硤硺礰礼神祥禔福禛竑竧靖竫箞精絈絜綷綠緖繒罇羡羽茁荢荿菇菶葈蒴蕓蕙蕫﨟薰蘒﨡蠇裵訒訷詹誧誾諟諸諶譓譿賰賴贒赶﨣軏﨤逸遧郞都鄕鄧釚釗釞釭釮釤釥鈆鈐鈊鈺鉀鈼鉎鉙鉑鈹鉧銧鉷鉸鋧鋗鋙鋐﨧鋕鋠鋓錥錡鋻﨨錞鋿錝錂鍰鍗鎤鏆鏞鏸鐱鑅鑈閒隆﨩隝隯霳霻靃靍靏靑靕顗顥飯飼餧館馞驎髙髜魵魲鮏鮱鮻鰀鵰鵫鶴鸙黑]+/g;
      var match1 = item.val().match(searchTxt);
      var match2 = item.val().match(searchTxt2);

      if (match1 || match2) {
        // 引っかかった文字を取得
        var matchStr = '';

        if (match1 != null) {
          match1.forEach(function(e){
            matchStr = matchStr + e;
          });
        }

        if (match2 != null) {
          match2.forEach(function(e){
            matchStr = matchStr + e;
          });
        }

        // エラーメッセージの設定
        var labelName = getLabelName(item);
        var str = labelName + 'に使用できない文字が含まれています。' + matchStr ;

        if ($.inArray(str, msgArr) == -1) {
          msgArr.push(str);
        }

        // エラーCSSをつける
        addErrorCss(item);
      }
    }

    function checkKeyword(formElement) {
      var str = formElement.val();
      var str_length = str.length;
      var code, scode;

      for (var i = 0; i < str_length; i++) {
        code = str.charCodeAt(i);
        code = code.toString(16);

        //4桁以下なら先頭に0を追加
        if (code.length < 4) {
          var figure = 4 - code.length;
          var rcode = "";
          for (var fi = 0; fi < figure; fi++) {
            rcode += "0";
            if (rcode.length > figure) {
              rcode = rcode.slice(0, figure);
              break;
            }
          }
          code = rcode + code;
        }

        //ザックリと範囲チェック＆改行コードとタブコードチェック
        if (!(0x20 <= "0x" + code && 0x7e >= "0x" + code) &&
          code != "000a" && code != "000d" && code != "0009") {
          if (code.charAt(0) == "0" || (code.charAt(0) >= "2" &&
              code.charAt(0) <= "9") || code.charAt(0) == "f") {
            scode = code.substring(1, 4);
            if (eval("u" + code.charAt(0) + "a").indexOf(":" + scode) == -1) {
              return false;
            }
          } else {
            return false;
          }
        }
      }
      return true;
    }

  }


  // 必須チェックfunction
  function requiredCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-required');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);

      if (notEnteredCheck(item)) {
        // エラーメッセージの設定
        var labelName = getLabelName(item);
        var str = labelName + 'は必須項目です。';

        if ($.inArray(str, msgArr) == -1) {
          msgArr.push(str);
        }

        // エラーCSSをつける
        addErrorCss(item);
      }
    }
  }

  // 文字数チェックfunction
  function countCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-count');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var itemCount = item.val().length;
      var maxCount = Number(item.data('validate').max);
      var minCount = Number(item.data('validate').min);
      var just = Number(item.data('validate').just);
      var flg = true;

      var labelName = getLabelName(item);
      var str = labelName + 'は';

      if (itemCount > 0) {
        // justが指定されている場合、justを優先する
        if (!isNaN(just)) {
          if (itemCount != just) {
            str = labelName + 'は' + just + '文字で入力してください。';
            flg = false;
          }
        } else {
          // 最小文字数
          if (itemCount < minCount) {
            flg = false;
          }

          // 最大文字数
          if (itemCount > maxCount) {
            flg = false;
          }

          // エラー文作成
          str = labelName + 'は、';

          if (!isNaN(minCount)) {
            str = str + minCount + '文字以上';
          }
          if (!isNaN(maxCount)) {
            str = str + maxCount + '文字以下';
          }

          str = str + 'で入力してください';
        }

        // flgがfalseの場合、エラーメッセージ追加
        if (flg == false) {
          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }

          // エラーCSSをつける
          addErrorCss(item);
        }
      }
    }
  }

  // 日付チェック
  function vdDateCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-date');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var strItemDate = adjustDate(item.val());
      var ymFlg = false;

      if (item.hasClass('vd-ym')) {
        if (strItemDate.match(/^\d{4}\/\d{1,2}$/)) {
          ymFlg = true;
        }
      }

      if (!notEnteredCheck(item)) {
        // 日付の妥当性チェック
        if (dateCheck(strItemDate, ymFlg) == false) {
          var labelName = getLabelName(item);
          var str = labelName + 'の日付が正しくありません';

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }

          // エラーCSSをつける
          addErrorCss(item);
        }
      }
    }
  }

  // 日付チェック(最小・最大)function
  function dateRangeCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-date-range');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var strItemDate = adjustDate(item.val());
      var strMaxDate = adjustDate(item.data('validate').max);
      var strMinDate = adjustDate(item.data('validate').min);
      var flg = true;
      var ymFlg = false;

      if (item.hasClass('vd-ym')) {
        if (strItemDate.match(/^\d{4}\/\d{1,2}$/)) {
          ymFlg = true;
        }
      }

      if (!notEnteredCheck(item)) {
        // 日付の妥当性チェック
        if (dateCheck(strItemDate, ymFlg) == false) {
          var labelName = getLabelName(item);
          var str = labelName + 'の日付が正しくありません';

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }
          // エラーCSSをつける
          addErrorCss(item);

          return;
        }

        // 年月許容の場合、MinMaxを1日に変更
        if (ymFlg) {
          strItemDate = changeYm(strItemDate);
          strMaxDate = changeYm(strMaxDate);
          strMinDate = changeYm(strMinDate);
        }

        var itemDate = new Date(strItemDate);
        var maxDate = new Date(strMaxDate);
        var minDate = new Date(strMinDate);

        // 日付チェック
        if (itemDate < minDate) {
          var labelName = getLabelName(item);
          var str = labelName + 'は' + strMinDate + 'より後の日付を入力してください';

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }

          // エラーCSSをつける
          addErrorCss(item);

        } else if (itemDate > maxDate) {
          var labelName = getLabelName(item);
          var str = labelName + 'は' + strMaxDate + 'より前の日付を入力してください';

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }

          // エラーCSSをつける
          addErrorCss(item);
        }
      }
    }
  }

  // 日付チェック（FROM）function
  function dateFromCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-date-from');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var strItemDate = adjustDate(item.val());
      var toItemName = item.data('validate').from;
      var toItem = $('input[name="' + toItemName + '"]');
      var strToDate = adjustDate($(toItem).val());
      var ymFlg = false;

      if (!notEnteredCheck(item)) {
        // 日付の妥当性チェック
        if (dateCheck(strItemDate, ymFlg) == false) {
          var labelName = getLabelName(item);
          var str = labelName + 'の日付が正しくありません';

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }

          // エラーCSSをつける
          addErrorCss(item);

          return;
        }

        var itemDate = new Date(strItemDate);
        var toDate = new Date(strToDate);

        // 日付チェック
        if (itemDate < toDate) {
          var labelName = getLabelName(item);
          var toLabelName = getLabelName(toItem);
          var str = labelName + 'は' + toLabelName + 'より後の日付を入力してください';

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }
          // エラーCSSをつける
          addErrorCss(item);
        }
      }
    }
  }

  // 日付チェック（TO）function
  function dateToCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-date-to');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var strItemDate = adjustDate(item.val());
      var fromItemName = item.data('validate').to;
      var fromItem = $('[name="' + fromItemName + '"]');
      var strFromDate = adjustDate($(fromItem).val());
      var ymFlg = false;

      if (!notEnteredCheck(item)) {
        // 日付の妥当性チェック
        if (dateCheck(strItemDate, ymFlg) == false) {
          // エラーCSSをつける
          addErrorCss(item);

          var labelName = getLabelName(item);
          var str = labelName + 'の日付が正しくありません';

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }

          return;
        }

        var itemDate = new Date(strItemDate);
        var fromDate = new Date(strFromDate);

        // 日付チェック
        if (itemDate > fromDate) {
          var labelName = getLabelName(item);
          var fromLabelName = getLabelName(fromItem);
          var str = labelName + 'は' + fromLabelName + 'より前の日付を入力してください';

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }

          // エラーCSSをつける
          addErrorCss(item);
        }
      }
    }
  }

  // 日付チェック（今日以降）
  function dateTodayCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-date-today');
    var itemLength = validateItems.length;
    var today = new Date();
    today = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 0, 0, 0);

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var strItemDate = adjustDate(item.val());
      var ymFlg = false;

      if (item.hasClass('vd-ym')) {
        if (strItemDate.match(/^\d{4}\/\d{1,2}$/)) {
          ymFlg = true;
        }
      }

      if (!notEnteredCheck(item)) {
        // 日付の妥当性チェック
        if (dateCheck(strItemDate, ymFlg) == false) {
          // エラーCSSをつける
          addErrorCss(item);

          var labelName = getLabelName(item);
          var str = labelName + 'の日付が正しくありません';

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }

          return;
        }

        // 年月許容の場合、MinMaxを1日に変更
        if (ymFlg) {
          strItemDate = changeYm(strItemDate);
          today = new Date(today.getFullYear(), today.getMonth(), 1, 0, 0, 0);
        }

        var itemDate = new Date(strItemDate);

        // 日付チェック
        if (itemDate < today) {
          var labelName = getLabelName(item);
          var str = labelName + 'は今日より後の日付を入力してください';

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }

          // エラーCSSをつける
          addErrorCss(item);
        }
      }
    }
  }


  // 日付の妥当性チェック
  function dateCheck(val, ymFlg = false) {
    var flg = true;

    if (!ymFlg) {
      // yyyy/mm/dd形式で入力されているか。
      if (!val.match(/^\d{4}\/\d{1,2}\/\d{1,2}$/)) {
        flg = false;
      }
      var y = val.split("/")[0];
      var m = val.split("/")[1] - 1;
      var d = val.split("/")[2];

    } else {
      // yy/mm形式で入力されているか。
      if (!val.match(/^\d{4}\/\d{1,2}$/)) {
        flg = false;
      }

      var y = val.split("/")[0];
      var m = val.split("/")[1] - 1;
      var d = '01';

    }

    var ymd = new Date(y, m, d);

    if (ymd.getFullYear() != y || ymd.getMonth() != m || ymd.getDate() != d) {
      flg = false;
    }

    return flg;
  }

  // 日付データ整える
  function adjustDate(val) {
    // -でつながっている場合、/に変更する。
    var strDate = String(val).replace(/-/g, '/');

    // yy/mm/dd形式の場合、20を先頭に付ける
    if (strDate.match(/^\d{2}\/\d{1,2}\/\d{1,2}$/) || strDate.match(/^\d{2}\/\d{1,2}$/)) {
      strDate = '20' + strDate;
    }

    return strDate;
  }

  // 日付データを年月比較に対応
  function changeYm(val) {
    var y = val.split("/")[0];
    var m = val.split("/")[1];
    var d = '01';

    ymd = y + '/' + m + '/' + '01';

    return ymd;
  }

  // Aが選択されている場合、Bは必須
  function connectRequiredCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-connect-required');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var connectItems = item.data('validate').connect;
      var connectArr = connectItems.split(',');
      var connectLength = connectArr.length;

      for (var j = 0; j < connectLength; j++) {
        var connectItem = $(parentBox).find('[name="' + connectArr[j] + '"]');

        if (!notEnteredCheck(connectItem)) {

          if (notEnteredCheck(item)) {
            var labelName = getLabelName(item);
            var connectLabelName = getLabelName(connectItem);
            var str = connectLabelName + 'が入力されている場合、' + labelName + 'の入力をしてください。';

            if ($.inArray(str, msgArr) == -1) {
              msgArr.push(str);
            }

            // エラーCSSをつける
            addErrorCss(item);

            break;
          }
        }

      }
    }
  }

  // 数字
  function numberCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-number');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var num = Number(item.val().replace(/,/g, ''));
      var labelName = getLabelName(item);
      var flg = true;

      if (!notEnteredCheck(item)) {
        if (isNaN(num)) {
          var str = labelName + 'の数値が正しくありません。';
          flg = false;

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }

        } else {
          // 小数点チェック
          var valArr = item.val().split('.');


          if (item.hasClass('vd-decimal')) {
            if (valArr[1] != undefined) {
              if (valArr[1].length > 3) {
                var str = labelName + 'の小数点第三位以下は入力できません。';
                flg = false;

                if ($.inArray(str, msgArr) == -1) {
                  msgArr.push(str);
                }
              }
            }
          } else {
            if (valArr.length == 2) {
              var str = labelName + 'は小数点以下の入力はできません。';
              flg = false;

              if ($.inArray(str, msgArr) == -1) {
                msgArr.push(str);
              }
            }
          }
        }
      }
      if (flg === false) {
        // エラーCSSをつける
        addErrorCss(item);
      }
    }
  }

  // 数字(最大最小)
  function numberRangeCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-number-range');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var num = Number(item.val().replace(/,/g, ''));
      var maxCount = Number(item.data('validate').max);
      var minCount = Number(item.data('validate').min)
      var flg = true;

      var labelName = getLabelName(item);
      var str = labelName + 'は';

      if (!notEnteredCheck(item)) {
        // 最小文字数
        if (Number(num) < minCount) {
          str = str + minCount + '以上';
          flg = false;
        }

        // 最大文字数
        if (Number(num) > maxCount) {
          str = str + maxCount + '以下';
          flg = false;
        }

        // flgがfalseの場合、エラーメッセージ追加
        if (flg == false) {
          str = str + 'で入力してください。';

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }

          // エラーCSSをつける
          addErrorCss(item);
        }
      }
    }
  }

  // 数字TO
  function numberToCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-number-to');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var num = Number(item.val().replace(/,/g, ''));
      var toItemName = item.data('validate').to;
      var toItem = $('[name="' + toItemName + '"]');

      if (!notEnteredCheck(item)) {
        if (!notEnteredCheck(toItem)) {
          var toNum = Number(toItem.val().replace(/,/g, ''));

          if (num > toNum) {
            var labelName = getLabelName(item);
            var toLabelName = getLabelName(toItem);
            var str = labelName + 'は' + toLabelName + 'より小さい数値を入力してください。';

            if ($.inArray(str, msgArr) == -1) {
              msgArr.push(str);
            }

            // エラーCSSをつける
            addErrorCss(item);
          }
        }
      }
    }
  }

  // 数字FROM
  function numberFromCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-number-from');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var num = Number(item.val().replace(/,/g, ''));
      var fromItemName = item.data('validate').from;
      var fromItem = $('[name="' + fromItemName + '"]');

      if (!notEnteredCheck(item)) {
        if (!notEnteredCheck(fromItem)) {
          var fromNum = Number(fromItem.val().replace(/,/g, ''));
          if (num < fromNum) {
            var labelName = getLabelName(item);
            var fromLabelName = getLabelName(fromItem);
            var str = labelName + 'は' + fromLabelName + 'より大きい数値を入力してください。';

            if ($.inArray(str, msgArr) == -1) {
              msgArr.push(str);
            }

            // エラーCSSをつける
            addErrorCss(item);
          }
        }
      }
    }
  }

  // チェックボックス・ラジオボタンの必須チェック
  function checkboxRequiredCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-check-required');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var itemName = item.attr('name');

      if ($('[name="' + itemName + '"]:checked').length < 1) {
        var labelName = getLabelName($('[name="' + itemName + '"]'));
        var str = labelName + 'は必須項目です。';

        if ($.inArray(str, msgArr) == -1) {
          msgArr.push(str);
        }

        // エラーCSSをつける
        addErrorCss(item);
      }
    }
  }

  // ●●個以上の入力必須
  function multiRequiredCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-multi-required');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var multiItems = item.data('validate').multi;
      var multiArr = multiItems.split(',');
      var multiLength = multiArr.length;
      var multiCount = Number(item.data('validate').multiCount);
      var cnt = 0;

      // multiCountの指定が無い場合、１
      if (multiCount == undefined || isNaN(multiCount)) {
        multiCount = 1;
      }

      for (var j = 0; j < multiLength; j++) {
        var multiItem = $('[name="' + multiArr[j] + '"]');

        if (!notEnteredCheck(multiItem)) {
          cnt = cnt + 1;
        }
      }

      if (cnt < multiCount) {
        var labelName = getLabelName(item);
        var str = labelName + 'は' + multiCount + 'つ以上入力してください。';

        if ($.inArray(str, msgArr) == -1) {
          msgArr.push(str);
        }

        // エラーCSSをつける
        for (var j = 0; j < multiLength; j++) {
          addErrorCss($('[name="' + multiArr[j] + '"]'));
        }
      }
    }
  }

  // いずれかの入力必須
  function anyRequiredCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-any-required');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var anyItems = item.data('validate').any;
      var anyArr = anyItems.split(',');
      var anyLength = anyArr.length;
      var anyCount = Number(item.data('validate').anyCount);
      var cnt = 0;

      // anyCountの指定が無い場合、１
      if (anyCount == undefined || isNaN(anyCount)) {
        anyCount = 1;
      }

      for (var j = 0; j < anyLength; j++) {
        var anyItem = $('[name="' + anyArr[j] + '"]');

        if (!notEnteredCheck(anyItem)) {
          cnt = cnt + 1;
        }
      }

      if (cnt < anyCount) {
        var str = '';
        for (var j = 0; j < anyLength; j++) {

          anyItem = $('[name="' + anyArr[j] + '"]');
          var labelName = getLabelName(anyItem);

          if (j === 0) {
            str = labelName;
          } else {
            str = str + '、' + labelName;
          }

          // エラーCSSをつける
          addErrorCss(anyItem);
        }

        str = str + 'のいずれか' + anyCount + 'つ以上入力してください。';
        if ($.inArray(str, msgArr) == -1) {
          msgArr.push(str);
        }
      }
    }
  }

  // 文字型チェック
  function characterTypeCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-character-type');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var type = item.data('validate').type;
      var flg = true;
      var str;
      var labelName = getLabelName(item);

      switch (type) {
        // 半角英数のみ
        case '1':
          var reg = new RegExp(/^[0-9a-zA-Z]*$/);

          if (reg.test(item.val()) == false) {
            flg = false;
            str = labelName + 'は' + '半角英数のみ入力可能です。';
          }
          break;
          // 全角のみ
        case '2':
          var reg = new RegExp(/^[^\x20-\x7e]*$/);

          if (reg.test(item.val()) == false) {
            flg = false;
            str = labelName + 'は' + '全角文字のみ入力可能です。';
          }
          break;
          // 数値のみ
        case '3':
          var reg = new RegExp(/^[0-9]*$/);

          if (reg.test(item.val()) == false) {
            flg = false;
            str = labelName + 'は' + '数値のみ入力可能です。';
          }
          break;
      }

      if (flg == false) {
        if ($.inArray(str, msgArr) == -1) {
          msgArr.push(str);
        }

        // エラーCSSをつける
        addErrorCss(item);
      }
    }
  }

  // 時間チェック
  function timeCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-time');
    var itemLength = validateItems.length;
    var reg = new RegExp(/^([01]?[0-9]|2[0-3]):([0-5][0-9])$/);

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var flg = true;

      var times = String(item.val());

      if (!notEnteredCheck(item)) {
        if (reg.test(item.val()) == false) {
          flg = false;
        }
        var al = times.split(":");
        if (parseInt(al[0], 10) < 0 || parseInt(al[0], 10) > 23 || parseInt(al[1], 10) < 0 || parseInt(al[1], 10) > 59) {
          flg = false;
        }
      }

      if (flg == false) {
        var labelName = getLabelName(item);
        var str = labelName + 'の' + '時刻は正しくありません。';

        if ($.inArray(str, msgArr) == -1) {
          msgArr.push(str);
        }
        // エラーCSSをつける
        addErrorCss(item);
      }
    }
  }

  // 時間チェック（FROM）
  function timeFromCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-time-from');
    var itemLength = validateItems.length;
    var today = getTodayArr();

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var strItemTime = item.val().split(':');
      var fromItemName = item.data('validate').from;
      var fromItem = $('input[name="' + fromItemName + '"]');
      var strFromTime= $(fromItem).val().split(':');

      // 時間比較用に整形
      var itemTime = new Date(today[0], today[1], today[2], strItemTime[0], strItemTime[1], 0);
      var fromTime = new Date(today[0], today[1], today[2], strFromTime[0], strFromTime[1], 0);

      // 日付チェック
      if (itemTime < fromTime) {
        var labelName = getLabelName(item);
        var toLabelName = getLabelName(fromItem);
        var str = labelName + 'は' + fromLabelName + 'より後の時刻を入力してください';

        if ($.inArray(str, msgArr) == -1) {
          msgArr.push(str);
        }
        // エラーCSSをつける
        addErrorCss(item);
      }
    }
  }

  // 時間チェック（TO）function
  function timeToCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-time-to');
    var itemLength = validateItems.length;
    var today = getTodayArr();

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var strItemTime = item.val().split(':');
      var toItemName = item.data('validate').to;
      var toItem = $('input[name="' + toItemName + '"]');
      var strToTime= $(toItem).val().split(':');

      // 時間比較用に整形
      var itemTime = new Date(today[0], today[1], today[2], strItemTime[0], strItemTime[1], 0);
      var toTime = new Date(today[0], today[1], today[2], strToTime[0], strToTime[1], 0);

      // 日付チェック
      if (itemTime > toTime) {
        var labelName = getLabelName(item);
        var toLabelName = getLabelName(toItem);
        var str = labelName + 'は' + toLabelName + 'より前の時刻を入力してください';

        if ($.inArray(str, msgArr) == -1) {
          msgArr.push(str);
        }
        // エラーCSSをつける
        addErrorCss(item);
      }
    }
  }

  // datalistチェックfunction
  function datalistCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-datalist');
    var itemLength = validateItems.length;

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var code = item.closest('.datalist-wrap').find('.datalist-code');

      if (!notEnteredCheck(item)) {
        if (notEnteredCheck(code)) {
          // エラーメッセージの設定
          var labelName = getLabelName(item);
          var str = labelName + 'は選択肢から選択してください。';

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }

          // エラーCSSをつける
          addErrorCss(item);
        }
      }
    }
  }

  // メールアドレス
  function mailCheck(parentBox, msgArr) {
    var validateItems = $(parentBox).find('.vd-mail');
    var itemLength = validateItems.length;
    var reg = new RegExp(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/);

    for (var i = 0; i < itemLength; i++) {
      var item = validateItems.eq(i);
      var flg = true;

      if (!notEnteredCheck(item)) {
        if (reg.test(item.val()) == false) {
          var labelName = getLabelName(item);
          var str = labelName + 'のメールアドレスは正しくありません。';

          if ($.inArray(str, msgArr) == -1) {
            msgArr.push(str);
          }

          // エラーCSSをつける
          addErrorCss(item);
        }
      }
    }
  }

  // エラーCSSリセット
  function removeErrorCss(parentBox) {
    $(parentBox).find('.err').removeClass('err');
  }

  // エラーCSSつける
  function addErrorCss(item) {
    if (item.hasClass('err') == false) {
      if (item.hasClass('select2')) {
        // select2対象の場合、spanにerrをつける
        // どっちかわからないので両方に
        item.parent().find('.select2-selection__rendered').addClass('err');
        item.parent().find('.select2-selection--single').addClass('err');
      } else {
        //それ以外の場合、そのものに付ける
        item.addClass('err');
      }
    }
  }

  // エラーメッセージ表示
  function showErrorMessage(msgArr) {
    // エラーメッセージをリセット
    $('.error-area').text('');

    // エラーメッセージを表示
    var msgLength = msgArr.length;

    if (msgLength == 0) {
      // 0件の場合は、error-areaを隠して、trueを返す
      $('.error-area').addClass('hidden');
      return true;

    } else {
      $('.error-area').append(
        '<div class="close-error-area"><div class="error-title">エラーがあります。</div><div class="error-close"><i class="times circle outline icon"></i></div></div>'
      );
      // 1件以上の場合は、メッセージを表示し、falseを返す
      for (i = 0; i < msgLength; i++) {
        $('.error-area').append('<span>' + '・' + msgArr[i] + '</span><br>');
      }

      // メッセージエリアを表示
      $('.error-area').removeClass('hidden');
      $('html, body').animate({ scrollTop: 0 }, 300);

      // エラーエリアの表示時間制御
      var setTime = setTimeout(function() {
        $('.error-area').addClass('hidden');
        $('.error-area').fadeOut();
      }, 5000);

      // 閉じるボタン押下時の処理
      $(document).on('click', '.error-close', function() {
        $('.error-area').addClass('hidden');
        clearTimeout(setTime);
      });


      return false;
    }
  }

  // エラーメッセージ表示（指定有）
  function showErrorMessageAreaSpecify(msgArr, areaName) {
    var area = $(areaName);

    // エラーメッセージをリセット
    area.text('');

    // エラーメッセージを表示
    var msgLength = msgArr.length;

    if (msgLength == 0) {
      // 0件の場合は、error-areaを隠して、trueを返す
      area.addClass('hidden');
      return true;

    } else {
      area.append(
        '<div class="close-error-area"><div class="error-title">エラーがあります。</div><div class="error-close"><i class="times circle outline icon"></i></div></div>'
      );
      // 1件以上の場合は、メッセージを表示し、falseを返す
      for (i = 0; i < msgLength; i++) {
        area.append('<span>' + '・' + msgArr[i] + '</span><br>');
      }

      // メッセージエリアを表示
      area.removeClass('hidden');
      $('html, body').animate({ scrollTop: 0 }, 300);

      // エラーエリアの表示時間制御
      var setTime = setTimeout(function() {
        area.addClass('hidden');
        area.fadeOut();
      }, 5000);

      // 閉じるボタン押下時の処理
      $(document).on('click', '.error-close', function() {
        area.addClass('hidden');
        clearTimeout(setTime);
      });

      return false;
    }
  }

  // エラー表示用名称取得function
  function getLabelName(validateItem) {
    var parentDiv;
    var labelName;

    if (validateItem.hasClass('vd-op-name') == true) {

      // vd-op-nameが設定されている場合、優先的に使用
      labelName = validateItem.data('validate').opName;

    } else if (validateItem.hasClass('tbl-input')) {

      // tbl-inputの場合、親tdのdata-labelを取得
      parentTd = validateItem.closest('td');
      labelName = parentTd.data('label');

    } else {

      // 上記以外の場合、親のvalidate-input内のlabelから取得
      parentDiv = validateItem.closest('.validate-input');
      labelName = parentDiv.find('label').text();

    }

    return labelName;
  }

  // 画面読み込み時などに呼出す。数値のセパレータを設定する（未使用）
  function onloadNumber(parentBox) {
    var numberLength = $(parentBox).find('.vd-number').length;

    for (var i = 0; i < numberLength; i++) {
      var item = $(parentBox).find('.vd-number').eq(i);
      if (!notEnteredCheck(item)) {
        var val = Number(item.val().replace(/,/g, ''));

        if (!isNaN(val)) {
          var str = val.toLocaleString();

          item.val(str);
        }
      }
    }
  }

  // submit時に呼び出す。数値のセパレータを外す
  function submitNumber(parentBox) {
    var numberLength = $(parentBox).find('.vd-number').length;

    for (var i = 0; i < numberLength; i++) {
      var item = $(parentBox).find('.vd-number').eq(i);
      var val = item.val().replace(/,/g, '');

      item.val(val);
    }
  }

  function changeNumber(item) {

    // 全角文字を半角に変更
    var val = $(item).val().replace(/[０-９．]/g, function(s) {
      return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    });

    var val = val.replace(/,/g, '');
    var valArr = val.split('.');

    if ($(item).hasClass('vd-decimal') === true) {
      // vd-decimalが指定されている場合、小数点以下を許容

       // 小数点以下初期値3
       var decimal = 3;

      // 小数点以下の桁数を取得
      if ($(item).data('validate')) {
        if (!isNaN(Number($(item).data('validate').decimal))) {
          var decimal = Number($(item).data('validate').decimal);
        }
      }

      if (valArr.length == 2) {
        // 小数点以下が指定桁数より多い場合、指定以下は消す。
        var dec = (valArr[1] + '000').substr(0, decimal);
        var num = Number((valArr[0]) + '.' + dec);
        var str = num.toLocaleString("ja-JP", {minimumFractionDigits: decimal});

      } else {
        var num = Number(val);
        var str = num.toLocaleString("ja-JP", {minimumFractionDigits: decimal});
      }

    } else {
      // 指定されていない場合、小数点以下は消す
      var num = Number(valArr[0]);
      var str = num.toLocaleString("ja-JP", {minimumFractionDigits: decimal});
    }

    if (isNaN(num) || $(item).val() == '') {
      if ($(item).hasClass('vd-decimal')) {
        // decimalの場合は0.000
        num = 0;
        $(item).val(num.toLocaleString("ja-JP", {minimumFractionDigits: decimal}));
      } else {
        // 数値以外が入力された場合、入力を無効にする。
        $(item).val('');
      }
    } else {
      // 数値の場合、整形した値を表示。
      $(item).val(str);
    }
  }

  function getTodayArr(){
    var today = new Date();
    var y = today.getFullYear();
    var m = today.getMonth();
    var d = today.getDate();

    var todayArr = [y, m, d];

    return todayArr;
  }

  // 未入力チェック
  // 未入力の場合、trueを返却
  // 入力されている場合、falseを返却
  function notEnteredCheck(item) {
    var result = false;

    if (item.val() == '' || item.val() == null || item.val() == undefined) {
      result = true;
    } else if (item.hasClass('vd-decimal') && Number(item.val()) == 0) {
      // vd-decimalの場合、0.000は未入力として扱う
      result = true;
    }

    return result;
  }
