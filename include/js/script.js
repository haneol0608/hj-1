/***************************************** URL 파라미터 값 안보이게 설정 *****************************************/
// 2022-11-30. 김한얼 -> 부사장님 지시(안보이게 설정)
// $( document ).ready(function() {
// 	history.replaceState({}, null, location.pathname);
// });
/**********************************************************************************************************/

/***************************************** 스마트 1번가 로그 데이터 등록 *****************************************/
// 2022-12-02. 김한얼. 스마트 1번가 로그 데이터 기록
// 스크립트문 추가
function logData(e, stat, date, id, name, url, ho, por, seq, qt_no) {
    var stat = stat;
    var date = date;
    var id = id;

    var param = {
        'crtfcKey': "$5$API$LwGz9vsP4T2SGTksbY3IZlOEAmHv0rWYYT1SpPGJ/g4",
        'logDt': date,
        'useSe': stat,
        'sysUser': id,
        'conectIp': "https://jdhi.co.kr/hj",
        'dataUsgqty': 100
    }

    $.ajax({
        type: "POST",
        url: "https://log.smart-factory.kr/apisvc/sendLogData.json",
        cache: false,
        timeout: 36000,
        data: param,
        dataType: "json",

        //************* 2023-03-13. 김한얼 팀장. 스마트 1번가 로그 데이터 기록 변경사항(V1.42) 적용 *************//
        // contentType: "application/x-www-form-urlencoded; charset=utf-8",
        //***************************************************************************************************//
        
        beforeSend: function() {},
        success: function(data, textStatus, jqXHR) {
            var result = data.result;
            console.log(result); // <-- 전송 결과 확인
        },
        error: function(jqXHR, textStatus, errorThrown) {},
        complete: function() {}
    });

    var log_insert = "로그기록";
    var ho = ho;
    var por = por;
    var seq = seq;
    var qt_no = qt_no;
    var url = url;
    var id = id;
    var name = name;
    var func = stat;

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'log_insert': log_insert,
            'ho': ho,
            'por': por,
            'seq': seq,
            'qt_no': qt_no,
            'url': url,
            'id': id,
            'name': name,
            'func': func
        },
        success: function(data) {

        },
        error: function(request, status, error) {
            
        }
    });

}
/******************************************************************************************************************/

/***************************************** form - submit 값 초기화 *****************************************/
function all_reset() {
    document.form.reset();
}
/**********************************************************************************************************/

/***************************************** 체크박스 - 전체선택 or 해제*****************************************/
function on_chk() {

    if ($("#all_check").is(":checked")) {
        $(".sub_check").prop('checked', true);
    } else {
        $(".sub_check").prop('checked', false);
    }

}
/*****************************************************************************************************************/

/***************************************** 공정 리스트 조회 - 엑셀 다운로드 *****************************************/
/* 엑셀 다운로드 */
function sub_excel(lot_date, list_lot) {
    var lot_date = lot_date;
    var list_lot = list_lot;
    var sub_excel = "/hj/sub01/sub0103_excel.php?lot_date=" + lot_date + "&list_lot=" + list_lot;
    location.href = sub_excel;
}
/*****************************************************************************************************************/

/*********************************************************** 계정관리 input display 설정 ***********************************************************/
function user_click(thisLink) {
    if (thisLink) {
        var input = thisLink.querySelector('input');
        var p = thisLink.querySelector('p');

        // alert(a.style.display);
        if (p.style.display == '' || p.style.display == 'inline') {
            input.style.display = 'inline';
            input.style.textalign = 'center';

            p.style.display = 'none';
        } else if (p.style.display == 'none') {
            // a.style.display = 'inline';
            p.style.display = 'none';
            p.style.textalign = 'center';

            // input.style.display = 'none';
        }
    }
}
/*******************************************************************************************************************************/
/*********************************************************** 계정관리 input display 설정 ***********************************************************/
function user_click2(thisLink) {
    if (thisLink) {
        var textarea = thisLink.querySelector("textarea");
        var p = thisLink.querySelector('p');

        // alert(a.style.display);
        if (p.style.display == '' || p.style.display == 'inline') {
            textarea.style.display = "inline";
            textarea.style.textalign = "center";
            p.style.display = 'none';

        } else if (p.style.display == 'none') {
            // a.style.display = 'inline';
            p.style.display = 'none';
            p.style.textalign = 'center';

            // input.style.display = 'none';
        }
    }
}
/*******************************************************************************************************************************/

/***************************************** 수주관리 - 도면 등록*****************************************/
// function draw_upload(e) {
//   var draw_upload = "도면 등록";
//   var draw_upload_porNo = $(e).closest('div').find('[name=POR_NO]').val();
//
//   $.ajax({
//     url: "/hj/include/query.php",
//     type: "POST",
//     data: {
//       'draw_upload': draw_upload,
//       'draw_upload_porNo': draw_upload_porNo
//     },
//     success: function(data){
//         alert('도면 등록!!');
//         location.reload(true);
//         // var url = "/hj/include/query.php?draw_upload="+draw_upload+'&por_no2='+por_no2;
//         // var name = "생산투입";
//         // var option = "width = 1000, height = 1000";
//         // window.open(url, name, option);
//     },
//     error: functother_update2ion (request, status, error){
//         alert('등록 안됨');
//     }
//   });
// }
/**********************************************************************************************************/

/***************************************** 컷팅지 등록 - 도면 삭제*****************************************/
function draw_delete(e) {
    var draw_delete = "도면 삭제";
    var draw_delPorNo = $(e).closest('tr').find('[name=por_no]').val();

    if (!confirm("도면 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'draw_delete': draw_delete,
                'draw_delPorNo': draw_delPorNo
            },
            success: function (data) {
                alert('도면 삭제!!');
                location.reload(true);

                // var url = "/hj/include/query.php?draw_delete="+draw_delete+'&draw_delPorNo='+draw_delPorNo;
                // var name = "생산투입";
                // var option = "width = 1000, height = 1000";
                // window.open(url, name, option);
            },
            error: function (request, status, error) {
                alert('등록 안됨');
            }
        });
    }
}
/**********************************************************************************************************/

/***************************************** 수주관리 - 생산지시*****************************************/
function pro_start(e) {
    var pro_start = "생산지시";
    var por_no = $(e).closest('tr').find('[name=por_no]').val();
    var draw_no = $(e).closest('tr').find('[name=draw_no]').val();

    // alert(por_no);
    // alert(draw_no);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'pro_start': pro_start,
            'draw_no': draw_no,
            'por_no': por_no
        },
        success: function(data) {
            alert('생산 등록!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************/

/***************************************** 수주관리(컷팅지 등록) - 도면 조회*****************************************/
function show_draw(ho, por, draw_file) {
    var draw_file = draw_file;
    var url = "/hj/sub01/sub0101_draw.php?draw_file=" + draw_file;
    var name = "도면조회";
    var option = "width = 1000, height = 1000";
    window.open(url, name, option);
}
/*****************************************************************************************************************/

/***************************************** 수주관리(컷팅지 등록) - 개정도 등록*****************************************/
function revision_update(e, page, search_ho, search_por) {
    var revision_update = "개정도 등록";
    var draw_revision = $(e).closest('td').find('[name=draw_revision]').val();
    var revision_ho = $(e).closest('tr').find('[name=draw_ho]').val();
    var revision_por = $(e).closest('tr').find('[name=draw_por]').val();

    var page = page;
    var search_ho = search_ho;
    var search_por = search_por;

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'revision_update': revision_update,
            'draw_revision': draw_revision,
            'revision_ho': revision_ho,
            'revision_por': revision_por,
            'page': page,
            'search_ho': search_ho,
            'search_por': search_por
        },
        success: function(data) {
            alert('개정도 수정!!');
            location.reload(true);

            // var url = "/hj/include/query.php?revision_update=" + revision_update + '&draw_revision=' + draw_revision + '&revision_ho=' + revision_ho + '&revision_por=' + revision_por;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('수정 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 수주상세 페이지 - 컷팅지 업로드*****************************************/
function cutting_upload(e) {
    var cutting_file = $(e).closest('div').find('[name=cutting_file]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'cutting_file': cutting_file
        },
        success: function(data) {
            // alert('컷팅지 등록!!');
            // location.reload(true);
            var url = "/hj/include/query.php?cutting_file=" + cutting_file;
            var name = "생산투입";
            var option = "width = 1000, height = 1000";
            window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/
/***************************************** 수주상세 페이지 - 중량 추가*****************************************/
// function add_weight() {
//   var add_weight = "중량추가";
//   // 1. 배열 화된 값 가져오기
//   var weight_in = document.getElementsByName("weight_in[]");// 체크박스 변수 선언
//   var no_in = document.getElementsByName("no_in[]");
//
//   // 2. 배열 선언
//   var weight_in_arr = new Array;
//   var no_in_arr = new Array;
//
//   // 3. 길이(length) 마다 값 가져오기
//   for(var i = 0; i < weight_in.length; i++) {
//     weight_in_arr.push(weight_in[i].value); // 값 배열에 추가하기(추가 - push)
//     no_in_arr.push(no_in[i].value);
//   }
//
//   var weight_in = JSON.stringify(weight_in_arr);
//   var no_in = JSON.stringify(no_in_arr);
//
//   $.ajax({
//     url: "/hj/include/query.php",
//     type: "POST",
//     data: {
//       'add_weight': add_weight,
//       'weight_in': weight_in,
//       'no_in': no_in
//     },
//     success: function(data){
//         // var url = "/hj/include/query.php?add_weight="+add_weight+"&weight_in="+weight_in+"&no_in="+no_in;
//         // var name = "물량산출";
//         // var option = "width = 1000, height = 1000";
//         // window.open(url, name, option);
//
//         alert('중량 등록!!');
//         location.reload(true);
//     },
//     error: function (request, status, error){
//         alert('등록 안됨');
//     }
//   });
// }
/*****************************************************************************************************************/
/***************************************** 수주상세 페이지 - 물량 산출 시작*****************************************/
function quantity_start(ho, por) {
    // var quantity_ho = $("input[name=quantity_ho]").val();
    // var quantity_por = $("input[name=quantity_por]").val();
    var quantity_ho = ho;
    var quantity_por = por;

    // Validation 추가
    var checked_length = $("input[name='quantity_seq[]']:checked").length;
    if (checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    // 체크박스에 선택된 값 가져오기
    var quantity_seq = document.getElementsByName("quantity_seq[]"); // 체크박스 변수 선언
    var weight_in = document.getElementsByName("weight_in[]");
    var quantity_count = document.getElementsByName("quantity_count[]");

    var quantity_arr = new Array;
    var weightIn_arr = new Array;
    var count_arr = new Array;

    for (var i = 0; i < quantity_seq.length; i++) { // 체크박스 길이 만큼 i 증가
        if (quantity_seq[i].checked) { // 체크된 체크박스 만큼 선택

            if (weight_in[i].value == '') {
                alert('중량이 비어있습니다!!');
                return false;
            }

            quantity_arr.push(quantity_seq[i].value); // 선택된 값 가져오기(추가 - push)
            weightIn_arr.push(weight_in[i].value); // 선택된 값 가져오기(추가 - push)
            count_arr.push(quantity_count[i].value); // 선택된 값 가져오기(추가 - push)
        }
    }
    var quantity_seq_arr = JSON.stringify(quantity_arr);
    var weight_in_arr = JSON.stringify(weightIn_arr);
    var quantity_count = JSON.stringify(count_arr);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'quantity_ho': quantity_ho,
            'quantity_por': quantity_por,
            'quantity_count': quantity_count,
            'weight_in': weight_in_arr,
            'quantity_seq': quantity_seq_arr
        },
        success: function(data) {
            // var url = "/hj/include/query.php?quantity_seq=" + quantity_seq_arr + "&quantity_ho=" + quantity_ho + "&quantity_por=" + quantity_por + "&quantity_count=" + quantity_count + "&weight_in=" + weight_in_arr;
            // var name = "물량산출";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
            alert('컷팅지 등록!!');
            location.reload();
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });

}
/*****************************************************************************************************************/

/***************************************** 물량 산출 - 입력 값 콤마 부여*****************************************/
function inputNumberFormat(e) {
    e.value = comma(uncomma(e.value));
}

function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}
/*****************************************************************************************************************/

/***************************************** 물량 산출 - 선택한 물량 산출 취소****************************************/
function quantity_delete() {
    var quantity_delete = "물량 취소";

    // Validation 추가
    var checked_length = $("input[name='quantity_no[]']:checked").length;
    if (checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    var quantity_no = document.getElementsByName("quantity_no[]"); // 체크박스 변수 선언
    var quantityNo_arr = new Array;

    for (var i = 0; i < quantity_no.length; i++) { // 체크박스 길이 만큼 i 증가
        if (quantity_no[i].checked) { // 체크된 체크박스 만큼 선택
            quantityNo_arr.push(quantity_no[i].value); // 선택된 값 가져오기(추가 - push)
        }
    }

    var quantity_no = JSON.stringify(quantityNo_arr);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'quantity_delete': quantity_delete,
            'quantity_delNo': quantity_no
        },
        success: function(data) {
            alert('물량산출 취소!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 수주상세 페이지 - 물량 긴급 추가****************************************/
function quantity_emg(ho, por) {
    var quantity_ho = ho;
    var quantity_por = por;

    // Validation 추가
    var checked_length = $("input[name='quantity_seq[]']:checked").length;
    if (checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    // 체크박스에 선택된 값 가져오기
    var quantity_seq = document.getElementsByName("quantity_seq[]"); // 체크박스 변수 선언
    var weight_in = document.getElementsByName("weight_in[]");
    var quantity_count = document.getElementsByName("quantity_count[]");

    var quantity_arr = new Array;
    var weightIn_arr = new Array;
    var count_arr = new Array;

    for (var i = 0; i < quantity_seq.length; i++) { // 체크박스 길이 만큼 i 증가
        if (quantity_seq[i].checked) { // 체크된 체크박스 만큼 선택
            quantity_arr.push(quantity_seq[i].value); // 선택된 값 가져오기(추가 - push)
            weightIn_arr.push(weight_in[i].value); // 선택된 값 가져오기(추가 - push)
            count_arr.push(quantity_count[i].value); // 선택된 값 가져오기(추가 - push)
        }
    }
    var quantity_seq_arr = JSON.stringify(quantity_arr);
    var weight_in_arr = JSON.stringify(weightIn_arr);
    var quantity_count = JSON.stringify(count_arr);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'emg_quantity_ho': quantity_ho,
            'emg_quantity_por': quantity_por,
            'emg_quantity_count': quantity_count,
            'emg_quantity_seq': quantity_seq_arr,
            'emg_weight_in': weight_in_arr
        },
        success: function(data) {
            // var url = "/hj/include/query.php?emg_quantity_seq=" + quantity_seq_arr + "&emg_quantity_ho=" + quantity_ho + "&emg_quantity_por=" + quantity_por + "&emg_quantity_count=" + quantity_count + "&emg_weight_in=" + weight_in_arr;
            // var name = "물량산출";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);

            alert('긴급 물량 등록!!');
            location.reload();
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });

}
/*****************************************************************************************************************/


/***************************************** 물량 산출 - 물량 정보 전체 수정*****************************************/
function other_update() {
    var other_update = "전체 저장";
    var no = document.getElementsByName('no[]');
    var money = document.getElementsByName('money[]');
    var other = document.getElementsByName('other[]');
    var pro_date = document.getElementsByName('pro_date[]');
    var mp_date = document.getElementsByName('mp_date[]');

    var no_arr = new Array();
    var money_arr = new Array();
    var other_arr = new Array();
    var proDate_arr = new Array();
    var mpDate_arr = new Array();

    for (var i = 0; i < no.length; i++) {
        no_arr.push(no[i].value);

        var no_comma = money[i].value.replace(/,/g, ''); // 콤마(,) 제거
        money_arr.push(no_comma);

        other_arr.push(other[i].value);
        proDate_arr.push(pro_date[i].value);
        mpDate_arr.push(mp_date[i].value);
    }

    var no = JSON.stringify(no_arr);
    var money = JSON.stringify(money_arr);
    var other = JSON.stringify(other_arr);
    var pro_date = JSON.stringify(proDate_arr);
    var mp_date = JSON.stringify(mpDate_arr);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'other_update': other_update,
            'no': no,
            'money': money,
            'other': other,
            'pro_date': pro_date,
            'mp_date': mp_date
        },
        success: function(data) {
            alert('물량정보 전체 저장!!');
            location.reload(true);
            // var url = "/hj/include/query.php?no="+no+"&money="+money+"&other_update="+other_update;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 물량 산출 - 공정 리스트 등록*****************************************/
function input_prolist() {
    var input_prolist = "공정리스트 등록";

    // Validation 추가
    var checked_length = $("input[name='quantity_no[]']:checked").length;
    if (checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    var quantity_no = document.getElementsByName("quantity_no[]"); // 체크박스 변수 선언
    var input_ho = document.getElementsByName("input_ho[]");
    var input_por = document.getElementsByName("input_por[]");
    var input_seq = document.getElementsByName("input_seq[]");
    var input_qt_no = document.getElementsByName("input_qt_no[]");

    var inputHo_arr = new Array;
    var inputPor_arr = new Array;
    var inputSeq_arr = new Array;
    var inputQtNo_arr = new Array;

    for (var i = 0; i < quantity_no.length; i++) {
        if (quantity_no[i].checked) {
            inputHo_arr.push(input_ho[i].value);
            inputPor_arr.push(input_por[i].value);
            inputSeq_arr.push(input_seq[i].value);
            inputQtNo_arr.push(input_qt_no[i].value);
        }
    }

    var input_ho = JSON.stringify(inputHo_arr);
    var input_por = JSON.stringify(inputPor_arr);
    var input_seq = JSON.stringify(inputSeq_arr);
    var input_qt_no = JSON.stringify(inputQtNo_arr);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'input_prolist': input_prolist,
            'input_ho': input_ho,
            'input_por': input_por,
            'input_seq': input_seq,
            'input_qt_no': input_qt_no
        },
        success: function(data) {
            alert('공정리스트 등록!!');
            location.reload(true);

            // var url = "/hj/include/query.php?input_prolist="+input_prolist+"&input_ho="+input_ho+"&input_por="+input_por+"&input_seq="+input_seq+"&input_qt_no="+input_qt_no;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/
function emg_prolist() {
    var emg_prolist = "긴급 공정리스트 추가";

    // Validation 추가
    var checked_length = $("input[name='quantity_no[]']:checked").length;
    if (checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    var quantity_no = document.getElementsByName("quantity_no[]"); // 체크박스 변수 선언
    var input_ho = document.getElementsByName("input_ho[]");
    var input_por = document.getElementsByName("input_por[]");
    var input_seq = document.getElementsByName("input_seq[]");
    var input_qt_no = document.getElementsByName("input_qt_no[]");
    var emg_list_title = $('[name=emg_list_title]').val();

    var inputHo_arr = new Array;
    var inputPor_arr = new Array;
    var inputSeq_arr = new Array;
    var inputQtNo_arr = new Array;

    for (var i = 0; i < quantity_no.length; i++) {
        if (quantity_no[i].checked) {
            if (input_qt_no[i].value != "긴급") {
                alert("긴급 물량만 등록 가능합니다!!");
                return false;
            }

            inputHo_arr.push(input_ho[i].value);
            inputPor_arr.push(input_por[i].value);
            inputSeq_arr.push(input_seq[i].value);
            inputQtNo_arr.push(input_qt_no[i].value);
        }
    }

    var input_ho = JSON.stringify(inputHo_arr);
    var input_por = JSON.stringify(inputPor_arr);
    var input_seq = JSON.stringify(inputSeq_arr);
    var input_qt_no = JSON.stringify(inputQtNo_arr);

    // var url = "/hj/sub01/sub0102_proList.php?emg_prolist=" + emg_prolist + "&emg_input_ho=" + input_ho + "&emg_input_por=" + input_por + "&emg_input_seq=" + input_seq + "&emg_input_qt_no=" + input_qt_no;
    // var name = "긴급 공정리스트 투입";
    // var option = "width = 1000, height = 500";
    // window.open(url, name, option);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'emg_prolist': emg_prolist,
            'emg_input_ho': input_ho,
            'emg_input_por': input_por,
            'emg_input_seq': input_seq,
            'emg_input_qt_no': input_qt_no,
            'emg_list_title': emg_list_title
        },
        success: function(data) {
            alert('긴급 공정리스트 추가!!');
            location.reload(true);

            // var url = "/hj/include/query.php?emg_prolist=" + emg_prolist + "&emg_input_ho=" + input_ho + "&emg_input_por=" + input_por + "&emg_input_seq=" + input_seq + "&emg_input_qt_no=" + input_qt_no + "&emg_list_title=" + emg_list_title;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/


/***************************************** 물량 산출 - 컷팅지 데이터 초기화*****************************************/
function quantity_del(ho, por) {
    var quantity_del = "컷팅지 데이터 초기화";
    var del_ho = ho;
    var del_por = por;

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'quantity_del': quantity_del,
            'del_ho': del_ho,
            'del_por': del_por
        },
        success: function(data) {
            alert('컷팅지 데이터 초기화!!');
            location.reload(true);

            // var url = "/hj/include/query.php?input_prolist="+input_prolist+"&input_ho="+input_ho+"&input_por="+input_por+"&input_seq="+input_seq+"&input_qt_no="+input_qt_no;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('삭제 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 공정 리스트 - 리스트 제목 수정*****************************************/
// 2022-12-15. 김한얼. 수정보완사항 적용
function prolist_titUp(e, lot_date, list_lot) {
    var prolist_titUp = "리스트 제목 수정";
    var list_title = $(e).closest('tr').find('[name=list_title]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'prolist_titUp': prolist_titUp,
            'list_title': list_title,
            'lot_date': lot_date,
            'list_lot': list_lot
        },
        success: function(data) {
            alert('리스트 제목 수정!!');
            location.reload(true);

            // var url = "/hj/include/query.php?input_prolist="+input_prolist+"&input_ho="+input_ho+"&input_por="+input_por+"&input_seq="+input_seq+"&input_qt_no="+input_qt_no;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('삭제 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 공정 리스트 - 공정 정보 전체 수정*****************************************/
function other_update2() {
    var other_update2 = "전체 저장";
    var prolist_ho = document.getElementsByName('prolist_ho[]');
    var prolist_por = document.getElementsByName('prolist_por[]');
    var series = document.getElementsByName('input_series[]');
    var pro_date = document.getElementsByName('input_pro_date[]');
    var mp_date = document.getElementsByName('input_mp_date[]');
    var sp = document.getElementsByName('input_sp[]');
    var qt_no = document.getElementsByName('prolist_no[]');
    // var revision = document.getElementsByName('input_revision[]');

    var prolistHo_arr = new Array();
    var prolistPor_arr = new Array();
    var series_arr = new Array();
    var pro_date_arr = new Array();
    var mp_date_arr = new Array();
    var sp_arr = new Array();
    var qtNo_arr = new Array();
    // var revision_arr = new Array();

    for (var i = 0; i < prolist_ho.length; i++) {
        prolistHo_arr.push(prolist_ho[i].value);
        prolistPor_arr.push(prolist_por[i].value);
        series_arr.push(series[i].value);
        pro_date_arr.push(pro_date[i].value);
        mp_date_arr.push(mp_date[i].value);
        sp_arr.push(sp[i].value);
        qtNo_arr.push(qt_no[i].value);
        // revision_arr.push(revision[i].value);
    }

    var prolist_ho = JSON.stringify(prolistHo_arr);
    var prolist_por = JSON.stringify(prolistPor_arr);
    var series = JSON.stringify(series_arr);
    var pro_date = JSON.stringify(pro_date_arr);
    var mp_date = JSON.stringify(mp_date_arr);
    var sp = JSON.stringify(sp_arr);
    var qt_no = JSON.stringify(qtNo_arr);
    // var revision = JSON.stringify(revision_arr);
    alert(mp_date);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'other_update2': other_update2,
            'prolist_ho': prolist_ho,
            'prolist_por': prolist_por,
            'series': series,
            'pro_date': pro_date,
            'mp_date': mp_date,
            'upQt_no': qt_no,
            'sp': sp
                // 'revision': revision
        },
        success: function(data) {
            // alert('공정정보 전체 저장!!');
            // location.reload(true);

            // var url = "/hj/include/query.php?other_update2="+other_update2+"&prolist_ho="+prolist_ho+"&prolist_por="+prolist_por+"&series="+series+"&sp="+sp+"&pro_date="+pro_date+"&mp_date="+mp_date;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 공정 리스트 - 제작 납기 자동 변경*****************************************/
function proDate_up(e, ho, por, qt_no) {
    var proDate_up ="제작 납기 자동 변경";
    var pro_date = $(e).closest('tr').find("[name='input_pro_date[]']").val();
    var ho = ho;
    var por = por;
    var qt_no = qt_no;

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'proDate_up': proDate_up,
            'pro_date': pro_date,
            'ho': ho,
            'por': por,
            'qt_no' : qt_no
        },
        success: function(data) {
        //    var url = "/hj/include/query.php?proDate_up="+proDate_up+"&pro_date="+pro_date+"&ho="+ho+"&por="+por+"&qt_no="+qt_no;
        //     var name = "생산투입";
        //     var option = "width = 1000, height = 1000";
        //     window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 공정 리스트 - 제작 납기 자동 변경*****************************************/
function mpDate_up(e, ho, por, qt_no) {
    var mpDate_up ="MP 납기 자동 변경";
    var mp_date = $(e).closest('tr').find("[name='input_mp_date[]']").val();
    var ho = ho;
    var por = por;
    var qt_no = qt_no;

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'mpDate_up': mpDate_up,
            'mp_date': mp_date,
            'ho': ho,
            'por': por,
            'qt_no' : qt_no
        },
        success: function(data) {
        //    var url = "/hj/include/query.php?mpDate_up="+mpDate_up+"&mp_date="+mp_date+"&ho="+ho+"&por="+por+"&qt_no="+qt_no;
        //     var name = "생산투입";
        //     var option = "width = 1000, height = 1000";
        //     window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 공정리스트 조회 - 선택한 공정 취소****************************************/
function prolist_delete() {
    var prolist_delete = "공정 취소";

    // Validation 추가
    var checked_length = $("input[name='prolist_no[]']:checked").length;
    if (checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    var prolist_no = document.getElementsByName("prolist_no[]"); // 체크박스 변수 선언
    var prolist_ho = document.getElementsByName("prolist_ho[]");
    var prolist_por = document.getElementsByName("prolist_por[]");
    // var prolist_seq = document.getElementsByName("prolist_seq[]");

    var prolistNo_arr = new Array;
    var prolistHo_arr = new Array;
    var prolistPor_arr = new Array;
    // var prolistSeq_arr = new Array;

    for (var i = 0; i < prolist_no.length; i++) { // 체크박스 길이 만큼 i 증가
        if (prolist_no[i].checked) { // 체크된 체크박스 만큼 선택
            prolistNo_arr.push(prolist_no[i].value); // 선택된 값 가져오기(추가 - push)
            prolistHo_arr.push(prolist_ho[i].value);
            prolistPor_arr.push(prolist_por[i].value);
            // prolistSeq_arr.push(prolist_seq[i].value);
        }
    }

    var prolist_qtNo = JSON.stringify(prolistNo_arr);
    var prolist_ho = JSON.stringify(prolistHo_arr);
    var prolist_por = JSON.stringify(prolistPor_arr);
    // var prolist_seq = JSON.stringify(prolistSeq_arr);
    // alert(prolist_seq);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'prolist_delete': prolist_delete,
            'prolist_qtNo': prolist_qtNo,
            'prolist_ho': prolist_ho,
            'prolist_por': prolist_por
            // 'prolist_seq': prolist_seq
        },
        success: function(data) {
            alert('공정 취소!!');
            location.reload(true);

            // var url = "/hj/include/query.php?prolist_delete="+prolist_delete+"&prolist_ho="+prolist_ho+"&prolist_por="+prolist_por+"&prolist_qtNo="+prolist_qtNo;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 공정리스트 조회 - 추가(복사본 생성)****************************************/
function add_prolist(e) {
    var add_prolist = "NO 변경 추가";
    var prolist_ho = $(e).closest('tr').find("[name='prolist_ho[]']").val();
    var prolist_por = $(e).closest('tr').find("[name='prolist_por[]']").val();
    var update_qtNo = $(e).closest('tr').find("[name='update_qtNo']").val();
    var prolist_seq = $(e).closest('tr').find("[name='prolist_seq[]']");

    var prolist_seq_arr = new Array;
    for (var i = 0; i < prolist_seq.length; i++) {
        prolist_seq_arr.push(prolist_seq[i].value);
    }

    var prolist_seq = JSON.stringify(prolist_seq_arr);

    // 유효성 검사
    var all_qtNo = $("[name='prolist_no[]']");
    for (var j = 0; j < all_qtNo.length; j++) {
        if (update_qtNo == all_qtNo[j].value) {
            alert("번호가 중복됩니다!!");
            return false;
        }
    }

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_prolist': add_prolist,
            'prolist_ho': prolist_ho,
            'prolist_por': prolist_por,
            'prolist_seq': prolist_seq,
            'update_qtNo': update_qtNo,
        },
        success: function(data) {
            alert('NO 변경 완료!!');
            // location.reload(true);
            $(".sub0103_table").load(location.href + " .sub0103_table");

            // var url = "/hj/include/query.php?add_prolist=" + add_prolist + "&prolist_ho=" + prolist_ho + "&prolist_por=" + prolist_por + "&prolist_seq=" + prolist_seq + "&update_qtNo=" + update_qtNo;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/***********************************************************************************************************************/

/***************************************** 공정리스트 조회 - 공정리스트 LOT 번호 부여****************************************/
function insert_proList() {
    var insert_proList = "공정리스트 LOT번호 부여";

    var in_prolist_no = document.getElementsByName("prolist_no[]"); // 체크박스 변수 선언
    var in_prolist_ho = document.getElementsByName("prolist_ho[]");
    var in_prolist_por = document.getElementsByName("prolist_por[]");

    var in_prolistNo_arr = new Array;
    var in_prolistHo_arr = new Array;
    var in_prolistPor_arr = new Array;

    for (var i = 0; i < in_prolist_no.length; i++) { // 체크박스 길이 만큼 i 증가
        if (in_prolist_no[i].checked) { // 체크된 체크박스 만큼 선택
            in_prolistNo_arr.push(in_prolist_no[i].value); // 선택된 값 가져오기(추가 - push)
            in_prolistHo_arr.push(in_prolist_ho[i].value);
            in_prolistPor_arr.push(in_prolist_por[i].value);
        }
    }

    var in_prolist_no = JSON.stringify(in_prolistNo_arr);
    var in_prolist_ho = JSON.stringify(in_prolistHo_arr);
    var in_prolist_por = JSON.stringify(in_prolistPor_arr);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'insert_proList': insert_proList,
            'in_prolist_no': in_prolist_no,
            'in_prolist_ho': in_prolist_ho,
            'in_prolist_por': in_prolist_por
        },
        success: function(data) {
            alert('공정리스트 LOT 생성 완료');
            location.reload(true);

            // var url = "/hj/include/query.php?insert_proList=" + insert_proList + "&in_prolist_no=" + in_prolist_no + "&in_prolist_ho=" + in_prolist_ho + "&in_prolist_por=" + in_prolist_por;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });

}
/*****************************************************************************************************************/

/***************************************** 공정리스트 상세조회 - 공정리스트 LOT 번호 조회****************************************/
function select_prolist(lot_date, list_lot) {
    var select_prolist = "공정리스트 상세조회";
    var lot_date = lot_date;
    var list_lot = list_lot;

    location.href = "/hj/sub01/sub0103.php?lot_date=" + lot_date + "&list_lot=" + list_lot;
}

function select_prolist_test(lot_date, list_lot) {
    var select_prolist2 = "공정리스트 상세조회";
    var lot_date = lot_date;
    var list_lot = list_lot;

    location.href = "/hj/sub01/sub0103_test.php?lot_date=" + lot_date + "&list_lot=" + list_lot;
}
/*****************************************************************************************************************/

/***************************************** 공정리스트 상세조회 - 공정리스트 LOT 번호 조회****************************************/
function prolist_print(lot_date, list_lot) {
    var lot_date = lot_date;
    var list_lot = list_lot;

    location.href = "/hj/sub01/sub0103_print.php?lot_date=" + lot_date + "&list_lot=" + list_lot;
}
/*****************************************************************************************************************/

/***************************************** 컷팅지 인쇄 - 컷팅지 프레임/다릿발 인쇄 페이지****************************************/
function cut_print(lot_date, list_lot) {
    var lot_date = lot_date;
    var list_lot = list_lot;

    location.href = "/hj/sub01/sub0104.php?lot_date=" + lot_date + "&list_lot=" + list_lot;
}
/*****************************************************************************************************************/

/***************************************** 컷팅지 인쇄 - 라벨 마킹대기  등록****************************************/
// 2022-12-20. 김한얼 대리. 마킹기계 등록 전 데이터 흐름
function label_wait() {
    var label_wait = "마킹대기 등록";
    var label_ho = document.getElementsByName('label_ho[]');
    var label_por = document.getElementsByName('label_por[]');
    var label_seq = document.getElementsByName('label_seq[]');
    var label_paint = document.getElementsByName('label_paint[]');

    var labelHo_arr = new Array;
    var labelPor_arr = new Array;
    var labelSeq_arr = new Array;
    var labelPaint_arr = new Array;

    for (var i = 0; i < label_seq.length; i++) { // 체크박스 길이 만큼 i 증가
        if (label_seq[i].checked) { // 체크된 체크박스 만큼 선택
            labelHo_arr.push(label_ho[i].value); // 선택된 값 가져오기(추가 - push)
            labelPor_arr.push(label_por[i].value);
            labelSeq_arr.push(label_seq[i].value);
            labelPaint_arr.push(label_paint[i].value);
        }
    }

    var labelWait_ho = JSON.stringify(labelHo_arr);
    var labelWait_por = JSON.stringify(labelPor_arr);
    var labelWait_seq = JSON.stringify(labelSeq_arr);
    var labelWait_paint = JSON.stringify(labelPaint_arr);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'label_wait': label_wait,
            'labelWait_ho': labelWait_ho,
            'labelWait_por': labelWait_por,
            'labelWait_seq': labelWait_seq,
            'labelWait_paint': labelWait_paint
        },
        success: function(data) {
            alert('라벨 마킹대기 등록!!');
            location.reload(true);

            // var url = "/hj/include/query.php?label_wait=" + label_wait + "&labelWait_ho=" + labelWait_ho + "&labelWait_por=" + labelWait_por + "&labelWait_seq=" + labelWait_seq;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 라벨 마킹대기 - 라벨 정보 등록****************************************/
// 2022-12-20. 김한얼 대리. 마킹기계 연동 데이터 생성
function label_start(e, labelWait_no) {
    var label_start = "라벨 정보 등록";
    var labelStart_no = labelWait_no;
    var labelStart_laNo = $(e).closest('tr').find('[name=la_no]').val();
    var labelStart_other = $(e).closest('tr').find('[name=other]').val();
    var labelStart_count = $(e).closest('tr').find('[name=count]').val();

    if (!labelStart_count) {
        alert("라벨 수량을 입력해주세요!!");
        return false;
    }

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'label_start': label_start,
            'labelStart_laNo': labelStart_laNo,
            'labelStart_no': labelStart_no,
            'labelStart_other': labelStart_other,
            'labelStart_count': labelStart_count
        },
        success: function(data) {
            alert('라벨 정보 등록!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/************************************************************************************************************/

/***************************************** 라벨 마킹대기 - 라벨 대기 삭제****************************************/
// 2022-12-20. 김한얼 대리. 마킹기계 연동 데이터 삭제
function labelWait_del(e, labelWait_no) {
    var labelWait_del = "라벨대기 삭제";
    var labelWait_delNo = labelWait_no;

    if (!confirm("가공공정 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'labelWait_del': labelWait_del,
                'labelWait_delNo': labelWait_delNo
            },
            success: function(data) {
                alert('라벨 대기 삭제!!');
                location.reload(true);
            },
            error: function(request, status, error) {
                alert('등록 안됨');
            }
        });
    }
    
}
/************************************************************************************************************/

/***************************************** 라벨 마킹 리스트 - 엑셀 다운로드 *****************************************/
// 2023-01-16. 김한얼 대리. 마킹기계 수동 연동 -> 라벨 마킹대기 에서 출력
function labelWait_excel() {
    var sub_excel = "/hj/sub01/sub0105_excel.php";
    location.href = sub_excel;
}
/*****************************************************************************************************************/


/***************************************** 라벨 마킹 리스트 - 엑셀 다운로드 *****************************************/
// 2022-12-20. 김한얼 대리. 마킹기계 수동 연동 데이터
function label_excel() {
    var sub_excel = "/hj/sub01/sub0106_excel.php";
    location.href = sub_excel;
}
/*****************************************************************************************************************/

/***************************************** 라벨 마킹 리스트 - 라벨 정보 취소 *****************************************/
// 2022-12-20. 김한얼 대리. 마킹기계 수동 연동 데이터 취소(-> 마킹 대기)
function label_cancle(labelCancle_no) {
    var label_cancle = "라벨 정보 취소";
    var labelCancle_no = labelCancle_no;

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'label_cancle': label_cancle,
            'labelCancle_no': labelCancle_no
        },
        success: function(data) {
            alert('라벨 정보 취소!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/


/************************************** 생산관리 - 생산이전(수주관리)지시*****************************************/
function pre_input(e) {
    var pre_input = $(e).closest('tr').find('[name=pro_no]').val();
    var por_no = $(e).closest('tr').find('[name=por_no]').val();
    var ho = $(e).closest('tr').find('[name=ho]').val();
    var por = $(e).closest('tr').find('[name=por]').val();

    // alert(pre_input);
    // alert(por_no);
    // alert(ho);
    // alert(por);


    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'pre_input': pre_input,
            'por_no': por_no,
            'ho': ho,
            'por': por
        },
        success: function(data) {
            alert('공정취소 등록!!');
            location.reload(true);
            // var url = "/hj/include/query.php?cutting_file=";
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************/
/***************************************** 생산관리 - 벤딩(다음)지시*****************************************/
function next_pro_1(e) {
    var next_pro_1 = $(e).closest('tr').find('[name=pro_no]').val();

    // alert(pro_no);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'next_pro_1': next_pro_1
        },
        success: function(data) {
            alert('벤딩공정 등록!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************/
/***************************************** 생산관리 - 절단(이전)지시*****************************************/
function pre_pro_1(e) {
    var pre_pro_1 = $(e).closest('tr').find('[name=pro_no]').val();

    // alert(pre_pro_1);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'pre_pro_1': pre_pro_1
        },
        success: function(data) {
            alert('절단공정 등록!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************/
/***************************************** 생산관리 - 취부(다음)지시*****************************************/
function next_pro_2(e) {
    var next_pro_2 = $(e).closest('tr').find('[name=pro_no]').val();

    // alert(pro_no);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'next_pro_2': next_pro_2
        },
        success: function(data) {
            alert('취부공정 등록!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************/
/***************************************** 생산관리 - 벤딩(이전)지시*****************************************/
function pre_pro_2(e) {
    var pre_pro_2 = $(e).closest('tr').find('[name=pro_no]').val();

    // alert(pre_pro_1);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'pre_pro_2': pre_pro_2
        },
        success: function(data) {
            alert('벤딩공정 등록!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************/
/***************************************** 생산관리 - 용접(다음)지시*****************************************/
function next_pro_3(e) {
    var next_pro_3 = $(e).closest('tr').find('[name=pro_no]').val();

    // alert(pro_no);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'next_pro_3': next_pro_3
        },
        success: function(data) {
            alert('용접공정 등록!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************/
/***************************************** 생산관리 - 취부(이전)지시*****************************************/
function pre_pro_3(e) {
    var pre_pro_3 = $(e).closest('tr').find('[name=pro_no]').val();

    // alert(pre_pro_1);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'pre_pro_3': pre_pro_3
        },
        success: function(data) {
            alert('취부공정 등록!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************/
/***************************************** 생산관리 - 사상(다음)지시*****************************************/
function next_pro_4(e) {
    var next_pro_4 = $(e).closest('tr').find('[name=pro_no]').val();

    // alert(pro_no);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'next_pro_4': next_pro_4
        },
        success: function(data) {
            alert('사상공정 등록!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************/
/***************************************** 생산관리 - 용접(이전)지시*****************************************/
function pre_pro_4(e) {
    var pre_pro_4 = $(e).closest('tr').find('[name=pro_no]').val();

    // alert(pre_pro_1);

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'pre_pro_4': pre_pro_4
        },
        success: function(data) {
            alert('용접공정 등록!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************/
/***************************************** 계정관리 - 계정 추가*****************************************/
function add_user(e) {
    var user_add = "계정 등록";
    var user_department = $("input[name=user_department]").val();
    var user_name = $("input[name=user_name]").val();
    var user_rank = $("input[name=user_rank]").val();
    var user_id = $("input[name=user_id]").val();
    var user_pw = $("input[name=user_pw]").val();
    var user_contact = $("input[name=user_contact]").val();
    var user_power = $("input[name=user_power]:checked").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'user_add': user_add,
            'user_department': user_department,
            'user_name': user_name,
            'user_rank': user_rank,
            'user_id': user_id,
            'user_pw': user_pw,
            'user_contact': user_contact,
            'user_power': user_power
        },
        success: function(data) {

            // var url = "/hj/include/query.php?user_department="+user_department+"&user_name="+user_name+"&user_rank="+user_rank+"&user_id="+user_id+"&user_pw="+user_pw+"&user_contact="+user_contact+"&user_power="+user_power+"&user_add="+user_add;
            // var name = "계정추가";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);

            alert('계정 등록!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************/
/***************************************** 계정관리 - 계정 수정*****************************************/
function user_update(e) {
    var update_user = '계정정보 수정';
    var up_no = $(e).closest('tr').find('[name=up_no]').val();
    var up_user_department = $(e).closest('tr').find('[name=up_user_department]').val();
    var up_user_name = $(e).closest('tr').find('[name=up_user_name]').val();
    var up_user_rank = $(e).closest('tr').find('[name=up_user_rank]').val();
    var up_user_id = $(e).closest('tr').find('[name=up_user_id]').val();
    var current_password = $(e).closest('tr').find('[name=current_password]').val();
    var new_password = $(e).closest('tr').find('[name=new_password]').val();
    var up_user_contact = $(e).closest('tr').find('[name=up_user_contact]').val();
    var up_user_power = $(e).closest('tr').find('[name=up_user_power]:checked').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'update_user': update_user,
            'up_no': up_no,
            'up_user_department': up_user_department,
            'up_user_name': up_user_name,
            'up_user_rank': up_user_rank,
            'up_user_id': up_user_id,
            'current_password': current_password,
            'new_password': new_password,
            'up_user_contact': up_user_contact,
            'up_user_power': up_user_power
        },
        success: function(data) {
            // var url = "/hj/include/query.php?update_user="+update_user+"&up_user_name="+up_user_name+"&up_user_rank="+up_user_rank+"&up_user_id="+up_user_id+"&current_password="+current_password+"&new_password="+new_password+"&up_user_contact="+up_user_contact+"&up_user_power="+up_user_power+"&update_user="+update_user+"&up_no="+up_no;
            // var name = "계정추가";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);

            alert('계정정보 수정완료!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************/
/***************************************** 계정관리 - 계정 삭제*****************************************/
function user_delete(e) {
    var delete_user = '계정정보 삭제';
    var up_no = $(e).closest('tr').find('[name=up_no]').val();

    // alert(pro_no);

    if (!confirm("계정 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_user': delete_user,
                'up_no': up_no
            },
            success: function(data) {
                alert('계정정보 삭제완료!!');
                location.reload(true);
            },
            error: function(request, status, error) {
                alert('등록 안됨');
            }
        });
    }
}
/**********************************************************************************************************/






















/***************************************** 평가용 기능(2022-12-28, 김한얼 대리)*****************************************/
/******************************************* 사업장 정보 관리 - 사업장 정보 등록*******************************************/
function insert_company() {
    var insert_company = "사업장 정보 등록";
    var name = $("input[name='company_name']").val();
    var man = $("input[name='man']").val();
    var addr = $("input[name='addr']").val();
    var business = $("input[name='business']").val();
    var phone = $("input[name='phone']").val();
    var email = $("input[name='email']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'insert_company': insert_company,
            'name': name,
            'man': man,
            'addr': addr,
            'business': business,
            'phone': phone,
            'email': email
        },
        success: function(data) {
            alert('사업장 정보 등록완료!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*************************************************************************************************************************/

/******************************************* 사업장 정보 관리 - 사업장 정보 수정*******************************************/
function update_company(no) {
    var upCompany_no = no;
    var name = $("input[name='company_name']").val();
    var man = $("input[name='man']").val();
    var addr = $("input[name='addr']").val();
    var business = $("input[name='business']").val();
    var phone = $("input[name='phone']").val();
    var email = $("input[name='email']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'upCompany_no': upCompany_no,
            'name': name,
            'man': man,
            'addr': addr,
            'business': business,
            'phone': phone,
            'email': email
        },
        success: function(data) {
            alert('사업장 정보 수정완료!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************************/

/******************************************* 사용자 정보 관리 - 사용자 권한 수정*******************************************/
function power_update(e, user_id) {
    var power_update = '사용자 권한 수정';
    var power_user_id = user_id;
    var user_power = $(e).closest('tr').find('[name=up_user_power]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'power_update': power_update,
            'power_user_id': power_user_id,
            'user_power': user_power
        },
        success: function(data) {
            alert('사용자 권한 수정완료!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************************/

/***************************************** 평가용 기능(2022-12-29, 박중건 사원)*****************************************/
/***************************************** 거래처 정보 관리 - 거래처 정보 등록*******************************************/
function add_account(e) {
    var add_account = "거래처 정보 등록";
    var name = $("input[name='name']").val();
    var in_charge = $("input[name='in_charge']").val();
    var address = $("input[name='address']").val();
    var business = $("input[name='business']").val();
    var contact = $("input[name='contact']").val();
    var email = $("input[name='email']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_account': add_account,
            'name': name,
            'in_charge': in_charge,
            'address': address,
            'business': business,
            'email': email,
            'contact': contact
        },
        success: function(data) {
            alert('거래처 정보 등록완료!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*********************************************************************************************************************/
/***************************************** 거래처 정보 관리 - 거래처 정보 수정*******************************************/
function edit_account(e) {
    var edit_account = "거래처 정보 수정";
    var no = $(e).closest("tr").find("[name=order_no2]").val();
    var name = $(e).closest("tr").find("[name=name2]").val();
    var in_charge = $(e).closest("tr").find("[name=in_charge2]").val();
    var address = $(e).closest("tr").find("[name=adress2]").val();
    var business = $(e).closest("tr").find("[name=business2]").val();
    var contact = $(e).closest("tr").find("[name=contact2]").val();
    var email = $(e).closest("tr").find("[name=email2]").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'edit_account': edit_account,
            'no': no,
            'name': name,
            'in_charge': in_charge,
            'address': address,
            'business': business,
            'email': email,
            'contact': contact
        },
        success: function(data) {
            alert("거래처 정보 수정완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}

function edit_account2(e) {
    var edit_account = "거래처 정보 수정";
    var no = $(e).closest("table").find("[name=order_no2]").val();
    var name = $(e).closest("table").find("[name=name2]").val();
    var in_charge = $(e).closest("table").find("[name=in_charge2]").val();
    var address = $(e).closest("table").find("[name=address2]").val();
    var contact = $(e).closest("table").find("[name=contact2]").val();
    var business = $(e).closest("table").find("[name=business2]").val();
    var email = $(e).closest("table").find("[name=email2]").val();
    
    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'edit_account': edit_account,
            'no': no,
            'name': name,
            'in_charge': in_charge,
            'address': address,
            'contact': contact,
            'business': business,
            'email': email
        },
        success: function(data) {

            alert("거래처 정보 수정완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/*********************************************************************************************************************/
/***************************************** 거래처 정보 관리 - 거래처 정보 삭제*******************************************/
function delete_account(e) {
    var delete_account = "거래처 정보 삭제";
    var no = $(e).closest("tr").find("[name=order_no2]").val();

    if (!confirm("거래처 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_account': delete_account,
                'no': no
            },
            success: function (data) {
                alert("거래처 정보 삭제완료!!");
                location.reload(true);
            },
            error: function (request, status, error) {
                alert("수정 안됨");
            },
        });  
    }
}
/*********************************************************************************************************************/
/***************************************** 공통코드 정보 관리 - 공통코드 정보 등록*******************************************/
function add_code(e) {
    var add_code = "공통 코드 등록";
    var type = $("select[name='type']").val();
    var name = $("input[name='name']").val();
    var code = $("input[name='code']").val();
    var possible = $("select[name='possible']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_code': add_code,
            'type': type,
            'name': name,
            'code': code,
            'possible': possible
        },
        success: function(data) {
            alert('공통코드 정보 등록완료!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*********************************************************************************************************************/
/***************************************** 공통코드 정보 관리 - 공통코드 정보 삭제 *******************************************/
function delete_code(e) {
    var delete_code = "공통코드 정보 삭제";
    var no = $(e).closest("tr").find("[name=no]").val();

    if (!confirm("공통코드 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_code': delete_code,
                'no': no
            },
            success: function (data) {
                alert("공통코드 정보 삭제완료!!");
                location.reload(true);
            },
            error: function (request, status, error) {
                alert("수정 안됨");
            },
        });
    }
}
/*********************************************************************************************************************/
/***************************************** 제품마스터 관리 - 완제품 정보 등록*******************************************/
function add_product(e) {
    var add_product = "완제품 정보 등록";
    var type = $("select[name='type']").val();
    var name = $("input[name='name']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_product': add_product,
            'type': type,
            'name': name
        },
        success: function(data) {
            alert("완제품 정보 등록완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("등록 안됨");
        },
    });
}
/*********************************************************************************************************************/
/***************************************** 제품마스터 관리 - 완제품 정보 수정*******************************************/
function edit_product(e) {
    var edit_product = "완제품 정보 수정";
    var no = $(e).closest("tr").find("[name=no]").val();
    var type = $(e).closest("tr").find("[name=type2]").val();
    var name = $(e).closest("tr").find("[name=name2]").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'edit_product': edit_product,
            'no': no,
            'type': type,
            'name': name
        },
        success: function(data) {
            alert("완제품 정보 수정완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/*********************************************************************************************************************/
/***************************************** 제품마스터 관리 - 완제품 정보 삭제  *******************************************/
function delete_product(e) {
    var delete_product = "완제품 정보 삭제";
    var no = $(e).closest("tr").find("[name=no]").val();

    if (!confirm("완제품 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_product': delete_product,
                'no': no
            },
            success: function (data) {
                alert("완제품 정보 삭제완료!!");
                location.reload(true);
            },
            error: function (request, status, error) {
                alert("수정 안됨");
            },
        });
    }

    
}
/*********************************************************************************************************************/
/***************************************** 원자재 마스터 관리 - 원자재 정보 등록*******************************************/
function add_material(e) {
    var add_material = "원자재 정보 등록";
    var name = $("input[name='name']").val();
    var standard = $("input[name='standard']").val();
    var count = $("input[name='count']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_material': add_material,
            'name': name,
            'standard': standard,
            'count': count
        },
        success: function(data) {
            alert("원자재 정보 등록완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("등록 안됨");
        },
    });
}
/*********************************************************************************************************************/
/***************************************** 원자재 마스터 관리 - 원자재 정보 수정 *******************************************/
function edit_material(e) {
    var edit_material = "원자재 정보 수정";
    var no = $(e).closest("tr").find("[name=no]").val();
    var name = $(e).closest("tr").find("[name=name2]").val();
    var standard = $(e).closest("tr").find("[name=standard2]").val();
    var count = $(e).closest("tr").find("[name=count2]").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'edit_material': edit_material,
            'no': no,
            'name': name,
            'standard': standard,
            'count': count
        },
        success: function(data) {
            alert("원자재 정보 수정완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/*********************************************************************************************************************/
/***************************************** 원자재 마스터 관리 - 원자재 정보 삭제  *******************************************/
function delete_material(e) {
    var delete_material = "원자재 정보 삭제";
    var no = $(e).closest("tr").find("[name=no]").val();

    if (!confirm("원자재 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_material': delete_material,
                'no': no
            },
            success: function (data) {
                alert("원자재 정보 삭제완료!!");
                location.reload(true);
            },
            error: function (request, status, error) {
                alert("삭제 안됨");
            },
        });
    }
    
}
/*********************************************************************************************************************/
/***************************************** 공정별 불량유형 관리 - 불량유형 정보 등록*******************************************/
function add_flaw(e) {
    var add_flaw = "불량유형 정보 등록";
    var process = $("select[name='process']").val();
    var flaw = $("input[name='flaw']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_flaw': add_flaw,
            'process': process,
            'flaw': flaw
        },
        success: function(data) {
            alert("불량유형 정보 등록완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("등록 안됨");
        },
    });
}
/*********************************************************************************************************************/
/***************************************** 공정별 불량유형 관리 - 불량유형 정보  수정 *******************************************/
function edit_flaw(e) {
    var edit_flaw = "불량유형 정보 수정";
    var no = $(e).closest("tr").find("[name=no]").val();
    var flaw = $(e).closest("tr").find("[name=flaw2]").val();
    var process = $(e).closest("tr").find("[name=process2]").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'edit_flaw': edit_flaw,
            'no': no,
            'flaw': flaw,
            'process': process
        },
        success: function(data) {
            alert("불량유형 정보 수정완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/*********************************************************************************************************************/
/***************************************** 공정별 불량유형 관리 - 불량유형 정보 삭제  *******************************************/
function delete_flaw(e) {
    var delete_flaw = "불량유형 정보 삭제";
    var no = $(e).closest("tr").find("[name=no]").val();

    if (!confirm("불량유형 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_flaw': delete_flaw,
                'no': no
            },
            success: function (data) {
                alert("불량유형 정보 삭제완료!!");
                location.reload(true);
            },
            error: function (request, status, error) {
                alert("수정 안됨");
            },
        });
    }
}
/*********************************************************************************************************************/
/***************************************** 공정별 작업자  - 작업자 정보 등록*******************************************/
function add_worker(e) {
    var add_worker = "작업자 정보 등록";
    var process = $("select[name='process']").val();
    var power = $("select[name='power']").val();
    var name = $("input[name='name']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_worker': add_worker,
            'process': process,
            'power': power,
            'name': name
        },
        success: function(data) {
            alert("작업자 정보 등록완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("등록 안됨");
        },
    });
}
/*********************************************************************************************************************/
/***************************************** 공정별 작업자  - 작업자 정보 수정 *******************************************/
function edit_worker(e) {
    var edit_worker = "작업자 정보 수정";
    var no = $(e).closest("tr").find("[name=no]").val();
    var power = $(e).closest("tr").find("[name=power2]").val();
    var name = $(e).closest("tr").find("[name=name2]").val();
    var process = $(e).closest("tr").find("[name=process2]").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'edit_worker': edit_worker,
            'no': no,
            'power': power,
            'name': name,
            'process': process
        },
        success: function(data) {
            alert("작업자 정보 수정완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/*********************************************************************************************************************/
/***************************************** 공정별 작업자  - 작업자 정보 삭제  *******************************************/
function delete_worker(e) {
    var delete_worker = "작업자 정보 삭제";
    var no = $(e).closest("tr").find("[name=no]").val();

    if (!confirm("작업자 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_worker': delete_worker,
                'no': no
            },
            success: function (data) {
                alert("작업자 정보 삭제완료!!");
                location.reload(true);
            },
            error: function (request, status, error) {
                alert("수정 안됨");
            },
        });
    }

}
/*********************************************************************************************************************/
/***************************************** 작업표준서관리  - 표준서 정보 등록 *******************************************/
function add_sop(e) {
    var add_sop = "표준서 정보 등록";
    var process = $("select[name='process']").val();
    var sequence = $("textarea[name='sequence']").val();
    var corrective = $("textarea[name='corrective']").val();
    var precaution = $("textarea[name='precaution']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_sop': add_sop,
            'process': process,
            'sequence': sequence,
            'corrective': corrective,
            'precaution': precaution,
        },
        success: function(data) {
            alert("표준서 정보 등록완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("등록 안됨");
        },
    });
}
/*********************************************************************************************************************/
/***************************************** 작업표준서관리  - 표준서 정보 수정 *******************************************/
function edit_sop(e) {
    var edit_sop = "표준서 정보 수정";
    var no = $(e).closest("tr").find("[name=no]").val();
    var sequence = $(e).closest("tr").find("[name=sequence2]").val();
    var corrective = $(e).closest("tr").find("[name=corrective2]").val();
    var precaution = $(e).closest("tr").find("[name=precaution2]").val();
    var process = $(e).closest("tr").find("[name=process2]").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'edit_sop': edit_sop,
            'no': no,
            'sequence': sequence,
            'corrective': corrective,
            'precaution': precaution,
            'process': process
        },
        success: function(data) {
            alert("표준서 정보 수정완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/*********************************************************************************************************************/
/***************************************** 작업표준서관리  - 표준서 정보 삭제  *******************************************/
function delete_sop(e) {
    var delete_sop = "표준서 정보 삭제";
    var no = $(e).closest("tr").find("[name=no]").val();

    if (!confirm("표준서 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_sop': delete_sop,
                'no': no
            },
            success: function (data) {
                alert("표준서 정보 삭제완료!!");
                location.reload(true);
            },
            error: function (request, status, error) {
                alert("수정 안됨");
            },
        });
    }
}
/*********************************************************************************************************************/

/***************************************** 평가용 기능(2022-12-30, 박중건 사원)*****************************************/
/***************************************** 수송지시 관리  - 수송지시 정보 등록 *******************************************/
function add_trans(e) {
    var add_trans = "수송지시 정보 등록";
    var code = $("input[name='code']").val();
    var text = $("input[name='text']").val();
    var account = $("select[name='account']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_trans': add_trans,
            'code': code,
            'text': text,
            'account': account
        },
        success: function (data) {

            alert("출하지시 정보 등록완료!!");
            location.reload(true);
        },
        error: function (request, status, error) {
            alert("등록 안됨");
        },
    });
}
/*********************************************************************************************************************/
/***************************************** 수송지시 관리  - 수송지시 정보 수정 *******************************************/
function edit_trans(e) {
    var edit_trans = "수송지시 정보 수정";
    var no = $(e).closest("tr").find("[name=no]").val();
    var code = $(e).closest("tr").find("[name=code2]").val();
    var text = $(e).closest("tr").find("[name=text2]").val();
    var account = $(e).closest("tr").find("[name=account2]").val();
  
  $.ajax({
    url: "/hj/include/query.php",
    type: "POST",
    data: {
      'edit_trans': edit_trans,
      'no': no,
      'code': code,
      'text': text,
      'account': account
    },
    success: function (data) {
        alert("수송지시 정보 수정완료!!");
      location.reload(true);
    },
    error: function (request, status, error) {
      alert("등록 안됨");
    },
  });
}
/*********************************************************************************************************************/
/***************************************** 수송지시 관리  - 수송지시 정보 삭제 *******************************************/
function delete_trans(e) {
    var delete_trans = "수송지시 정보 삭제";
    var no = $(e).closest("tr").find("[name=no]").val();
    

    if (!confirm("수송지시 정보를 삭제 하시겠습니까?")) {
            alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
            'delete_trans': delete_trans,
            'no': no
            },
            success: function (data) {
            alert("수송지시 정보 삭제완료!!");
            location.reload(true);
            },
            error: function (request, status, error) {
            alert("등록 안됨");
            },
        });
    } 
  
}
/*********************************************************************************************************************/
/***************************************** 출하지시 관리  - 출하지시 정보 등록 *******************************************/
function add_shipment(e) {
    var add_shipment = "출하지시 정보 등록";
    var account = $("select[name='account']").val();
    var name = $("input[name='name']").val();
    var date = $("input[name='date']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_shipment': add_shipment,
            'account': account,
            'name': name,
            'date': date
        },
        success: function (data) {

            // var url = "/hj/include/query.php?add_shipment=" + add_shipment + "&account=" + account + "&named=" + named + "&date=" + date ;
            // var name = "계정추가";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);

            alert("출하지시 정보 등록완료!!");
            location.reload(true);
        },
        error: function (request, status, error) {
            alert("등록 안됨");
        },
    });
}
/*********************************************************************************************************************/
/***************************************** 출하지시 관리  - 출하지시 등록 *******************************************/
function edit_stat(e) {
    var edit_stat = "출하지시 등록";
    var no = $(e).closest("tr").find("[name=no]").val();
  

  $.ajax({
    url: "/hj/include/query.php",
    type: "POST",
    data: {
        'edit_stat': edit_stat,
        'no': no
    },
    success: function (data) {

      alert("출하지시 등록완료!!");
      location.reload(true);
    },
    error: function (request, status, error) {
      alert("등록 안됨");
    },
  });
}
/*********************************************************************************************************************/
/***************************************** 출하지시 관리  - 출하지시 정보 수정 *******************************************/
function edit_shipment(e) {
    var edit_shipment = "출하지시 정보 수정";
    var no = $(e).closest("tr").find("[name=no]").val();
    var name = $(e).closest("tr").find("[name=name2]").val();

    $.ajax({
      url: "/hj/include/query.php",
      type: "POST",
      data: {
        'edit_shipment': edit_shipment,
        'no': no,
        'name': name
      },
      success: function (data) {
          alert("출하지시 정보 수정완료!!");
          location.reload(true);
      },
      error: function (request, status, error) {
        alert("등록 안됨");
      },
    });
}
/*********************************************************************************************************************/
/***************************************** 출하지시 관리  - 출하지시 정보 삭제*******************************************/
function delete_shipment(e) {
    var delete_shipment = "출하지시 정보 삭제";
    var no = $(e).closest("tr").find("[name=no]").val();

    if (!confirm("출하지시 정보를 삭제 하시겠습니까?")) {
            alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_shipment': delete_shipment,
                'no': no
            },
            success: function (data) {
                alert("출하지시 정보 삭제완료!!");
                location.reload(true);
            },
            error: function (request, status, error) {
                alert("등록 안됨");
            },
        });
    }

}
/*********************************************************************************************************************/
/************************************** 송장발행 - 송장출력, 출력일 등록****************************************************/
function shipment_print(no) {
    var shipment_print = no;
    var no = no;

    location.href = "/hj/sub14/sub1404_print.php?no=" + no;
}
/**********************************************************************************************************/
/****************************** 시스템관리 - 설정관리 ******************************/
function tb_style_1(e) {
    var style1 = $(e).closest('div').find('[name=tb_style1_click]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'style1': style1
        },
        success: function (data) {
            alert(style1 + '으로 변경 완료!!');
            location.reload(true);
        },
        error: function (request, status, error) {
            alert('삭제 안됨');
        }
    });
}
/*****************************************************************************************************/
/********************************* 시스템관리 - 공지사항 등록 *********************************/
function notice_add(e) {
    var notice_add = "공지사항 등록";
    var title = $("input[name=title]").val();
    var writer = $("input[name=writer]").val();
    var text = $("input[name=text]").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'notice_add': notice_add,
            'title': title,
            'writer': writer,
            'text': text
        },
        success: function (data) {
            alert('공지사항 등록 완료!!');
            location.href = '/hj/sub17/sub1706.php';
        },
        error: function (request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************//*********************************************************** 생산공정 - 생산완료 ***********************************************************/
/********************************* 시스템관리 - 공지사항 수정 *********************************/
function notice_update(e) {
    var notice_update = "공지사항 수정";
    var no = $(e).closest('div').prev('table').find('[name=no]').val();
    var title = $(e).closest('div').prev('table').find('[name=title]').val();
    var writer = $(e).closest('div').prev('table').find('[name=writer]').val();
    var text = $(e).closest('div').prev('table').find('[name=text]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'notice_update': notice_update,
            'no': no,
            'title': title,
            'writer': writer,
            'text': text
        },
        success: function (data) {
            alert('공지사항 수정 완료!!');
            location.href = '/hj/sub17/sub1706.php';
        },
        error: function (request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************//*********************************************************** 생산공정 - 생산완료 ***********************************************************/
/********************************* 시스템관리 - 공지사항 삭제 *********************************/
function notice_delete(e) {
    var notice_delete = "공지사항 삭제";
    var no = $(e).closest('div').next('div').children('table').find('[name=no]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'notice_delete': notice_delete,
            'no': no
        },
        success: function (data) {
            alert('공지사항 삭제 완료!!');
            location.href = '/hj/sub17/sub1706.php';
        },
        error: function (request, status, error) {
            alert('등록 안됨');
        }
    });
}
/**********************************************************************************************************//*********************************************************** 생산공정 - 생산완료 ***********************************************************/

//*********************************************2023-03-07. 김한얼 팀장. 평가용 기능 추가**************************************//
/***************************************** 사용이력 관리  - 사용이력 등록 *******************************************/
function add_use_record(e) {
    var add_use_record = "사용이력 등록";
    var screen = $(e).closest('div').find('[name=screen]').val();
    var content = $(e).closest('div').find('[name=content]').val();
    var user = $(e).closest('div').find('[name=user]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_use_record': add_use_record,
            'screen': screen,
            'content': content,
            'user': user
        },
        success: function (data) {
            alert('사용이력 등록 완료!!');
            location.reload(true);
        },
        error: function (request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*********************************************************************************************************************/

/***************************************** 사용이력 관리  - 사용이력 수정 *******************************************/
function edit_use_record(e) {
    var edit_use_record = "사용이력 수정";
    var no = $(e).closest('tr').find('[name=no]').val();
    var screen = $(e).closest('tr').find('[name=screen]').val();
    var content = $(e).closest('tr').find('[name=content]').val();
    var user = $(e).closest('tr').find('[name=user]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'edit_use_record': edit_use_record,
            'no': no,
            'screen': screen,
            'content': content,
            'user': user
        },
        success: function (data) {
            alert('사용이력 수정 완료!!');
            location.reload(true);
        },
        error: function (request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*********************************************************************************************************************/

/***************************************** 사용이력 관리  - 사용이력 삭제 *******************************************/
function delete_use_record(e) {
    var delete_use_record = "사용이력 삭제";
    var no = $(e).closest('tr').find('[name=no]').val();

    if (!confirm("사용이력 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_use_record': delete_use_record,
                'no': no
            },
            success: function (data) {
                alert('사용이력 삭제 완료!!');
                location.reload(true);
            },
            error: function (request, status, error) {
                alert('등록 안됨');
            }
        });
    }
    
}
/*********************************************************************************************************************/
//**************************************************************************************************************************//

/***************************************** 설비장비 관리  - 점검일지 등록 *******************************************/
function add_check(e) {
    var add_check = "점검일지 정보 등록";
    var equipment = $("input[name='equipment']").val();
    var text = $("textarea[name='text']").val();

  $.ajax({
    url: "/hj/include/query.php",
    type: "POST",
    data: {
      'add_check': add_check,
      'equipment': equipment,
      'text': text
    },
    success: function (data) {
        alert("점검일지 정보 등록완료!!");
        location.reload(true);
    },
    error: function (request, status, error) {
      alert("등록 안됨");
    },
  });
}
/*********************************************************************************************************************/
/***************************************** 설비장비 관리  - 점검일지 삭제 *******************************************/
function delete_check(e) {
    var delete_check = "점검일지 정보 삭제";
    var no = $(e).closest("tr").find("[name=no]").val();

    if (!confirm("점검일지 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
            'delete_check': delete_check,
            'no': no
            },
            success: function (data) {
                alert("점검일지 정보 삭제완료!!");
                location.reload(true);
            },
            error: function (request, status, error) {
            alert("수정 안됨");
            },
        });
    }
}
/*********************************************************************************************************************/
/***************************************** 설비이력 관리  - 설비이력 등록 *******************************************/
function add_record(e) {
    var add_record = "설비이력 정보 등록";
    var equipment = $("input[name='equipment']").val();
    var status = $("select[name='status']").val();
    var plc = $("select[name='plc']").val();
    var cloud = $("select[name='cloud']").val();
    var date = $("input[name='date']").val();

    $.ajax({
      url: "/hj/include/query.php",
      type: "POST",
      data: {
        'add_record': add_record,
        'equipment': equipment,
        'status': status,
        'plc': plc,
        'cloud': cloud,
        'date': date
      },
      success: function (data) {
          alert("설비이력 정보 등록완료!!");
        location.reload(true);
      },
      error: function (request, status, error) {
        alert("등록 안됨");
      },
    });
}
/*********************************************************************************************************************/
/***************************************** 설비이력 관리  - 설비이력 삭제 *******************************************/
function delete_record(e) {
    var delete_record = "설비이력 정보 삭제";
    var no = $(e).closest("tr").find("[name=no]").val();


    if (!confirm("설비이력 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_record': delete_record,
                'no': no
            },
            success: function (data) {
                alert("설비이력 정보 삭제완료!!");
                location.reload(true);
            },
            error: function (request, status, error) {
                alert("등록 안됨");
            },
        });
    }
}
/*********************************************************************************************************************/
/*********************************************************************************************************************/









/***************************************** 평가용 기능(2022-12-29, 김한얼 대리)*****************************************/
/***************************************** 수주완료 관리 - 수주완료 정보 삭제*******************************************/
function quan_del(ho, por, seq) {
    var quan_del = "수주완료 정보 삭제";
    var quandel_ho = ho;
    var quandel_por = por;
    var quandel_seq = seq;

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'quan_del': quan_del,
            'quandel_ho': quandel_ho,
            'quandel_por': quandel_por,
            'quandel_seq': quandel_seq
        },
        success: function(data) {
            alert("수주완료 정보 삭제!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/*****************************************************************************************************************************/

/***************************************** 완제품 관리 - 완제품 정보 등록*******************************************/
function add_cutok(e) {
    var add_cutok = "완제품 정보 등록";
    var cut_name = $("input[name='cut_name']").val();
    var cut_order = $("input[name='cut_order']").val();
    var cut_addr = $("input[name='cut_addr']").val();
    var cut_phone = $("input[name='cut_phone']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_cutok': add_cutok,
            'cut_name': cut_name,
            'cut_order': cut_order,
            'cut_addr': cut_addr,
            'cut_phone': cut_phone
        },
        success: function(data) {
            alert("완제품 정보 등록!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/*****************************************************************************************************************************/

/***************************************** 완제품 관리 - 완제품 정보 삭제*******************************************/
function cutok_del(cutok_no) {
    var cutok_del = "완제품 정보 삭제";
    var cutok_no = cutok_no;

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'cutok_del': cutok_del,
            'cutok_no': cutok_no
        },
        success: function(data) {
            alert("완제품 정보 삭제!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/*****************************************************************************************************************************/

/***************************************** 생산실적 관리 - 생산실적 상세조회****************************************/
function select_prolist_an(lot_date, list_lot) {
    var select_prolist = "생산실적 상세조회";
    var lot_date = lot_date;
    var list_lot = list_lot;
    // alert("/hj/sub13/sub1305.php?lot_date=" + lot_date + "&list_lot=" + list_lot);

    location.href = "/hj/sub13/sub1305.php?lot_date=" + lot_date + "&list_lot=" + list_lot;
}
/*****************************************************************************************************************************/

/***************************************** 생산실적 관리 - 공정별 작업현황 관리****************************************/
function cut_print2(lot_date, list_lot) {
    var lot_date = lot_date;
    var list_lot = list_lot;

    location.href = "/hj/sub13/sub1306.php?lot_date=" + lot_date + "&list_lot=" + list_lot;
}
/*****************************************************************************************************************/

/***************************************** 작업일보 관리 - 작업일보 정보 등록*******************************************/
function add_daywork(e) {
    var add_daywork = "작업일보 정보 등록";
    var work = $("input[name='work']").val();
    var work_man = $("input[name='work_man']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_daywork': add_daywork,
            'work': work,
            'work_man': work_man
        },
        success: function(data) {
            alert('작업일보 정보 등록완료!!');
            location.reload(true);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*********************************************************************************************************************/

/***************************************** 작업일보 관리 - 작업일보 정보 수정*******************************************/
function edit_daywork(e) {
    var edit_daywork = "작업일보 정보 수정";
    var work_no = $(e).closest("tr").find("[name=work_no]").val();
    var edit_work = $(e).closest("tr").find("[name=edit_work]").val();
    var edit_work_man = $(e).closest("tr").find("[name=edit_work_man]").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'edit_daywork': edit_daywork,
            'edit_work_no': work_no,
            'edit_work': edit_work,
            'edit_work_man': edit_work_man
        },
        success: function(data) {
            alert("작업일보 정보 수정완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/*********************************************************************************************************************/

/***************************************** 작업일보 관리 - 작업일보 정보 삭제*******************************************/
function delete_daywork(e) {
    var delete_daywork = "작업일보 정보 삭제";
    var del_work_no = $(e).closest("tr").find("[name=work_no]").val();

    if (!confirm("작업일보 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_daywork': delete_daywork,
                'del_work_no': del_work_no
            },
            success: function(data) {
                alert("작업일보 정보 삭제완료!!");
                location.reload(true);
            },
            error: function(request, status, error) {
                alert("수정 안됨");
            },
        });
    }
    
}
/*********************************************************************************************************************/

/***************************************** 평가용 기능(2022-12-30, 김한얼 대리)*****************************************/
/***************************************** 재고 관리 - 재고 정보 등록*******************************************/
function add_inven(e) {
    var add_inven = "재고 정보 등록";
    var inven_kinds = $("input[name='inven_kinds']").val();
    var inven_name = $("input[name='inven_name']").val();
    var inven_count = $("input[name='inven_count']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_inven': add_inven,
            'inven_kinds': inven_kinds,
            'inven_name': inven_name,
            'inven_count': inven_count
        },
        success: function(data) {
            alert("재고 정보 등록완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/**************************************************************************************************************/

/***************************************** 재고 관리 - 재고 정보 수정*******************************************/
function edit_inven(e) {
    var edit_inven = "재고 정보 수정";
    var inven_no = $(e).closest('tr').find('[name=inven_no]').val();
    var inven_kinds = $(e).closest('tr').find('[name=inven_kinds]').val();
    var inven_name = $(e).closest('tr').find('[name=inven_name]').val();
    var inven_count = $(e).closest('tr').find('[name=inven_count]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'edit_inven': edit_inven,
            'inven_no': inven_no,
            'inven_kinds': inven_kinds,
            'inven_name': inven_name,
            'inven_count': inven_count
        },
        success: function(data) {
            alert("재고 정보 수정완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/**************************************************************************************************************/

/***************************************** 재고 관리 - 재고 정보 삭제*******************************************/
function delete_inven(e) {
    var delete_inven = "재고 정보 삭제";
    var inven_no  = $(e).closest('tr').find('[name=inven_no]').val();

    if (!confirm("재고 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_inven': delete_inven,
                'inven_no': inven_no
            },
            success: function(data) {
                alert("재고 정보 삭제완료!!");
                location.reload(true);
            },
            error: function(request, status, error) {
                alert("수정 안됨");
            },
        });
    }
    
}
/**************************************************************************************************************/

/***************************************** 가공공정 관리 - 가공공정 등록*******************************************/
function add_pro2(e) {
    var add_pro2 = "가공공정 등록";
    var pro2_por = $(e).closest('div').find('[name=pro2_por]').val();
    var pro2_name = $(e).closest('div').find('[name=pro2_name]').val();
    var pro2_count = $(e).closest('div').find('[name=pro2_count]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_pro2': add_pro2,
            'pro2_por': pro2_por,
            'pro2_name': pro2_name,
            'pro2_count': pro2_count
        },
        success: function(data) {
            alert("가공공정 정보 등록완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/**************************************************************************************************************/

/***************************************** 가공공정 관리 - 가공공정 수정*******************************************/
function edit_pro2(e) {
    var edit_pro2 = "가공공정 수정";
    var pro2_no = $(e).closest('tr').find('[name=pro2_no]').val();
    var pro2_por = $(e).closest('tr').find('[name=pro2_por]').val();
    var pro2_name = $(e).closest('tr').find('[name=pro2_name]').val();
    var pro2_count = $(e).closest('tr').find('[name=pro2_count]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'edit_pro2': edit_pro2,
            'pro2_no': pro2_no,
            'pro2_por': pro2_por,
            'pro2_name': pro2_name,
            'pro2_count': pro2_count
        },
        success: function(data) {
            alert("가공공정 수정 등록완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/**************************************************************************************************************/

/***************************************** 가공공정 관리 - 가공공정 삭제*******************************************/
function delete_pro2(e) {
    var delete_pro2 = "가공공정 삭제";
    var pro2_no = $(e).closest('tr').find('[name=pro2_no]').val();

    if (!confirm("가공공정 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_pro2': delete_pro2,
                'pro2_no': pro2_no
            },
            success: function(data) {
                alert("가공공정 삭제 완료!!");
                location.reload(true);
            },
            error: function(request, status, error) {
                alert("수정 안됨");
            },
        });
    }
    
}
/**************************************************************************************************************/

/***************************************** 제품불량 관리 - 제품불량 정보 등록*******************************************/
function add_error(e) {
    var add_error = "제품불량 정보 등록";
    var error_por = $("input[name='error_por']").val();
    var error_info = $("input[name='error_info']").val();
    var error_count = $("input[name='error_count']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_error': add_error,
            'error_por': error_por,
            'error_info': error_info,
            'error_count': error_count
        },
        success: function(data) {
            alert("제품불량 정보 등록완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/********************************************************************************************************************/

/***************************************** 제품불량 관리 - 제품불량 정보 삭제*******************************************/
function delete_error(e) {
    var delete_error = "제품불량 정보 삭제";
    var error_no = $(e).closest('tr').find('[name=error_no]').val();

    if (!confirm("제품불량 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_error': delete_error,
                'error_no': error_no
            },
            success: function(data) {
                alert("제품불량 정보 삭제완료!!");
                location.reload(true);
            },
            error: function(request, status, error) {
                alert("수정 안됨");
            },
        });
    }
    
}
/********************************************************************************************************************/

/***************************************** 제품검사 관리 - 제품검사 정보 등록*******************************************/
function add_test(e) {
    var add_test = "제품검사 정보 등록";
    var test_por = $("input[name='test_por']").val();
    var test_seq = $("input[name='test_seq']").val();
    var test_result = $("input[name='test_result']").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_test': add_test,
            'test_por': test_por,
            'test_seq': test_seq,
            'test_result': test_result
        },
        success: function(data) {
            alert("제품검사 정보 등록완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/********************************************************************************************************************/

/***************************************** 제품검사 관리 - 제품검사 정보 삭제*******************************************/
function delete_test(e) {
    var delete_test = "제품검사 정보 삭제";
    var test_no = $(e).closest('tr').find('[name=test_no]').val();

    if (!confirm("제품검사 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'delete_test': delete_test,
                'test_no': test_no
            },
            success: function(data) {
                alert("제품검사 정보 삭제완료!!");
                location.reload(true);
            },
            error: function(request, status, error) {
                alert("수정 안됨");
            },
        });
    }
    
}
/********************************************************************************************************************/

/***************************************** 사용자 그룹 관리 - 사용자 그룹 정보 등록*******************************************/
function add_group() {
    var add_group = "사용자 그룹 등록";
    var group_department = $("input[name=group_department]").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_group': add_group,
            'group_department': group_department
        },
        success: function(data) {
            alert("사용자 그룹정보 등록완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });

}
/********************************************************************************************************************/

/***************************************** 사용자 그룹 관리 - 사용자 그룹 정보 수정*******************************************/
function group_update(e) {
    var group_update = "사용자 그룹정보 수정";
    var up_group_no = $(e).closest('tr').find('[name=up_group_no]').val();
    var up_group_department = $(e).closest('tr').find('[name=up_group_department]').val();
    var up_group_power = $(e).closest('tr').find('[name=up_group_power]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'group_update': group_update,
            'up_group_no': up_group_no,
            'up_group_department': up_group_department,
            'up_group_power': up_group_power
        },
        success: function(data) {
            alert("사용자 그룹정보 수정완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/********************************************************************************************************************/

/***************************************** 사용자 그룹 관리 - 사용자 그룹 정보 삭제*******************************************/
function group_delete(e) {
    var group_delete = "사용자 그룹정보 삭제";
    var del_group_no = $(e).closest('tr').find('[name=up_group_no]').val();

    if (!confirm("사용자 그룹 정보를 삭제 하시겠습니까?")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query.php",
            type: "POST",
            data: {
                'group_delete': group_delete,
                'del_group_no': del_group_no
            },
            success: function(data) {
                alert("사용자 그룹정보 삭제완료!!");
                location.reload(true);
            },
            error: function(request, status, error) {
                alert("수정 안됨");
            },
        });
    }
    
}
/********************************************************************************************************************/

/***************************************** 그룹 권한 설정 - 그룹 권한 등록*******************************************/
function add_group2() {
    var add_group2 = "그룹권한 등록";
    var group_name = $("select[name=group_name]").val();
    var group_power = $("input[name=group_power]").val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'add_group2': add_group2,
            'group_name': group_name,
            'group_power': group_power
        },
        success: function(data) {
            alert("그룹권한 등록 완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/********************************************************************************************************************/

/***************************************** 암호 변경 - 암호 수정*******************************************/
function pw_update(e) {
    var pw_update = "암호 수정";
    var new_pw = $(e).closest('tr').find('[name=new_pw]').val();
    var pw_no = $(e).closest('tr').find('[name=pw_no]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'pw_update': pw_update,
            'new_pw': new_pw,
            'pw_no': pw_no
        },
        success: function(data) {
            alert("암호 수정 완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/********************************************************************************************************************/


/***************************************** 가공/생산 지시서 관리 - 가공/생산 지시서 버전 수정*******************************************/
function version_update(e) {
    var version_update = "가공/생산 지시서 버전 수정";
    var draw_no = $(e).closest('tr').find('[name=draw_no]').val();
    var draw_revision = $(e).closest('tr').find('[name=draw_revision]').val();

    $.ajax({
        url: "/hj/include/query.php",
        type: "POST",
        data: {
            'version_update': version_update,
            'draw_no': draw_no,
            'draw_revision': draw_revision
        },
        success: function(data) {
            alert("버전 수정 완료!!");
            location.reload(true);
        },
        error: function(request, status, error) {
            alert("수정 안됨");
        },
    });
}
/********************************************************************************************************************/





//************************************************** 2023-03-31. 김한얼 팀장. 라다 공정 속도 개선 **************************************************//

/***************************************** 수주상세 페이지 - 물량 산출 시작*****************************************/
function quantity_start2(ho, por) {
    // var quantity_ho = $("input[name=quantity_ho]").val();
    // var quantity_por = $("input[name=quantity_por]").val();
    var quantity_ho = ho;
    var quantity_por = por;

    // Validation 추가
    var checked_length = $("input[name='quantity_seq[]']:checked").length;
    if (checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    // 체크박스에 선택된 값 가져오기
    var quantity_seq = document.getElementsByName("quantity_seq[]"); // 체크박스 변수 선언
    var weight_in = document.getElementsByName("weight_in[]");
    var quantity_count = document.getElementsByName("quantity_count[]");

    var quantity_arr = new Array;
    var weightIn_arr = new Array;
    var count_arr = new Array;

    for (var i = 0; i < quantity_seq.length; i++) { // 체크박스 길이 만큼 i 증가
        if (quantity_seq[i].checked) { // 체크된 체크박스 만큼 선택

            if (weight_in[i].value == '') {
                alert('중량이 비어있습니다!!');
                return false;
            }

            quantity_arr.push(quantity_seq[i].value); // 선택된 값 가져오기(추가 - push)
            weightIn_arr.push(weight_in[i].value); // 선택된 값 가져오기(추가 - push)
            count_arr.push(quantity_count[i].value); // 선택된 값 가져오기(추가 - push)
        }
    }
    var quantity_seq_arr = JSON.stringify(quantity_arr);
    var weight_in_arr = JSON.stringify(weightIn_arr);
    var quantity_count = JSON.stringify(count_arr);

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'quantity_ho': quantity_ho,
            'quantity_por': quantity_por,
            'quantity_count': quantity_count,
            'weight_in': weight_in_arr,
            'quantity_seq': quantity_seq_arr
        },
        success: function(data) {
            // var url = "/hj/include/query.php?quantity_seq=" + quantity_seq_arr + "&quantity_ho=" + quantity_ho + "&quantity_por=" + quantity_por + "&quantity_count=" + quantity_count + "&weight_in=" + weight_in_arr;
            // var name = "물량산출";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
            
            location.reload();
            // alert(data);
        },
        beforeSend: function () {
            alert('컷팅지 등록!!');
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });

}
/*****************************************************************************************************************/

/***************************************** 물량 산출 - 컷팅지 데이터 초기화*****************************************/
function quantity_del2(ho, por) {
    var quantity_del = "컷팅지 데이터 초기화";
    var del_ho = ho;
    var del_por = por;

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'quantity_del': quantity_del,
            'del_ho': del_ho,
            'del_por': del_por
        },
        success: function(data) {
            location.reload(true);

            // var url = "/hj/include/query.php?input_prolist="+input_prolist+"&input_ho="+input_ho+"&input_por="+input_por+"&input_seq="+input_seq+"&input_qt_no="+input_qt_no;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        beforeSend: function () {
            alert('컷팅지 데이터 초기화!!');
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            alert('삭제 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 컷팅지 등록 - 도면 삭제*****************************************/
function draw_delete2(e) {
    var draw_delete2 = "도면 삭제";
    var draw_delPorNo = $(e).closest('tr').find('[name=por_no]').val();

    if (!confirm("도면 정보를 삭제 하시겠습니까?\n해당 리스트에 등록된 공정리스트 정보가 삭제됩니다.")) {
        alert("취소하였습니다.");
    } else {
        $.ajax({
            url: "/hj/include/query2.php",
            type: "POST",
            data: {
                'draw_delete2': draw_delete2,
                'draw_delPorNo': draw_delPorNo
            },
            success: function (data) {
                alert('도면 삭제!!');
                location.reload(true);

                // var url = "/hj/include/query.php?draw_delete="+draw_delete+'&draw_delPorNo='+draw_delPorNo;
                // var name = "생산투입";
                // var option = "width = 1000, height = 1000";
                // window.open(url, name, option);
            },
            error: function (request, status, error) {
                alert('등록 안됨');
            }
        });
    }
}
/**********************************************************************************************************/

/***************************************** 수주상세 페이지 - 물량 긴급 추가****************************************/
function quantity_emg2(ho, por) {
    var quantity_ho = ho;
    var quantity_por = por;

    // Validation 추가
    var checked_length = $("input[name='quantity_seq[]']:checked").length;
    if (checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    // 체크박스에 선택된 값 가져오기
    var quantity_seq = document.getElementsByName("quantity_seq[]"); // 체크박스 변수 선언
    var weight_in = document.getElementsByName("weight_in[]");
    var quantity_count = document.getElementsByName("quantity_count[]");

    var quantity_arr = new Array;
    var weightIn_arr = new Array;
    var count_arr = new Array;

    for (var i = 0; i < quantity_seq.length; i++) { // 체크박스 길이 만큼 i 증가
        if (quantity_seq[i].checked) { // 체크된 체크박스 만큼 선택
            quantity_arr.push(quantity_seq[i].value); // 선택된 값 가져오기(추가 - push)
            weightIn_arr.push(weight_in[i].value); // 선택된 값 가져오기(추가 - push)
            count_arr.push(quantity_count[i].value); // 선택된 값 가져오기(추가 - push)
        }
    }
    var quantity_seq_arr = JSON.stringify(quantity_arr);
    var weight_in_arr = JSON.stringify(weightIn_arr);
    var quantity_count = JSON.stringify(count_arr);

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'emg_quantity_ho2': quantity_ho,
            'emg_quantity_por2': quantity_por,
            'emg_quantity_count2': quantity_count,
            'emg_quantity_seq2': quantity_seq_arr,
            'emg_weight_in2': weight_in_arr
        },
        success: function(data) {
            // var url = "/hj/include/query.php?emg_quantity_seq=" + quantity_seq_arr + "&emg_quantity_ho=" + quantity_ho + "&emg_quantity_por=" + quantity_por + "&emg_quantity_count=" + quantity_count + "&emg_weight_in=" + weight_in_arr;
            // var name = "물량산출";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);

            location.reload();
        },
        beforeSend: function () {
            alert('긴급 물량 등록!!');
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });

}
/*****************************************************************************************************************/

/***************************************** 물량 산출 - 선택한 물량 산출 취소****************************************/
function quantity_delete2() {
    var quantity_delete = "물량 취소";

    // Validation 추가
    var checked_length = $("input[name='quantity_no[]']:checked").length;
    if (checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    var quantity_no = document.getElementsByName("quantity_no[]"); // 체크박스 변수 선언
    var quantity_ho = document.getElementsByName("input_ho[]"); // 체크박스 변수 선언
    var quantity_por = document.getElementsByName("input_por[]");
    var quantity_seq = document.getElementsByName("input_seq[]");

    var quantityHo_arr = new Array;
    var quantityPor_arr = new Array;
    var quantitySeq_arr = new Array;
    var quantityNo_arr = new Array;

    for (var i = 0; i < quantity_no.length; i++) { // 체크박스 길이 만큼 i 증가
        if (quantity_no[i].checked) { // 체크된 체크박스 만큼 선택
            quantityNo_arr.push(quantity_no[i].value); // 선택된 값 가져오기(추가 - push)
            quantityHo_arr.push(quantity_ho[i].value); // 선택된 값 가져오기(추가 - push)
            quantityPor_arr.push(quantity_por[i].value); // 선택된 값 가져오기(추가 - push)
            quantitySeq_arr.push(quantity_seq[i].value); // 선택된 값 가져오기(추가 - push)
        }
    }

    var quantity_ho = JSON.stringify(quantityHo_arr);
    var quantity_por = JSON.stringify(quantityPor_arr);
    var quantity_seq = JSON.stringify(quantitySeq_arr);

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'quantity_delete2': quantity_delete,
            'del_quantity_ho': quantity_ho,
            'del_quantity_por': quantity_por,
            'del_quantity_seq': quantity_seq
        },
        success: function(data) {
            location.reload(true);
        },
        beforeSend: function () {
            alert('물량산출 취소!!');
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 물량 산출 - 물량 정보 전체 수정*****************************************/
function other_update3() {
    var other_update3 = "전체 저장";
    var no = document.getElementsByName('no[]');
    var money = document.getElementsByName('money[]');
    var other = document.getElementsByName('other[]');
    var pro_date = document.getElementsByName('pro_date[]');
    var mp_date = document.getElementsByName('mp_date[]');
    var ho = document.getElementsByName("input_ho[]"); // 체크박스 변수 선언
    var por = document.getElementsByName("input_por[]");
    var seq = document.getElementsByName("input_seq[]");

    var no_arr = new Array();
    var money_arr = new Array();
    var other_arr = new Array();
    var proDate_arr = new Array();
    var mpDate_arr = new Array();
    var ho_arr = new Array();
    var por_arr = new Array();
    var seq_arr = new Array();

    for (var i = 0; i < no.length; i++) {
        no_arr.push(no[i].value);

        var no_comma = money[i].value.replace(/,/g, ''); // 콤마(,) 제거
        money_arr.push(no_comma);

        other_arr.push(other[i].value);
        proDate_arr.push(pro_date[i].value);
        mpDate_arr.push(mp_date[i].value);

        ho_arr.push(ho[i].value);
        por_arr.push(por[i].value);
        seq_arr.push(seq[i].value);
    }

    var no = JSON.stringify(no_arr);
    var money = JSON.stringify(money_arr);
    var other = JSON.stringify(other_arr);
    var pro_date = JSON.stringify(proDate_arr);
    var mp_date = JSON.stringify(mpDate_arr);
    var ho = JSON.stringify(ho_arr);
    var por = JSON.stringify(por_arr);
    var seq = JSON.stringify(seq_arr);

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'other_update3': other_update3,
            'no': no,
            'money': money,
            'other': other,
            'pro_date': pro_date,
            'mp_date': mp_date,
            'ho': ho,
            'por': por,
            'seq': seq
        },
        success: function(data) {
            location.reload(true);
        },
        beforeSend: function () {
            alert('물량정보 전체 저장!!');
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 물량 산출 - 공정 리스트 등록*****************************************/
function input_prolist2() {
    var input_prolist2 = "공정리스트 등록";

    // Validation 추가
    var checked_length = $("input[name='quantity_no[]']:checked").length;
    if (checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    var quantity_no = document.getElementsByName("quantity_no[]"); // 체크박스 변수 선언
    var input_ho = document.getElementsByName("input_ho[]");
    var input_por = document.getElementsByName("input_por[]");
    var input_seq = document.getElementsByName("input_seq[]");
    var input_qt_no = document.getElementsByName("input_qt_no[]");

    var inputHo_arr = new Array;
    var inputPor_arr = new Array;
    var inputSeq_arr = new Array;
    var inputQtNo_arr = new Array;

    for (var i = 0; i < quantity_no.length; i++) {
        if (quantity_no[i].checked) {
            inputHo_arr.push(input_ho[i].value);
            inputPor_arr.push(input_por[i].value);
            inputSeq_arr.push(input_seq[i].value);
            inputQtNo_arr.push(input_qt_no[i].value);
        }
    }

    var input_ho = JSON.stringify(inputHo_arr);
    var input_por = JSON.stringify(inputPor_arr);
    var input_seq = JSON.stringify(inputSeq_arr);
    var input_qt_no = JSON.stringify(inputQtNo_arr);


    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'input_prolist2': input_prolist2,
            'input_ho': input_ho,
            'input_por': input_por,
            'input_seq': input_seq,
            'input_qt_no': input_qt_no
        },
        success: function(data) {
            location.reload(true);

            // var url = "/hj/include/query.php?input_prolist="+input_prolist+"&input_ho="+input_ho+"&input_por="+input_por+"&input_seq="+input_seq+"&input_qt_no="+input_qt_no;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        beforeSend: function() {
            alert('공정리스트 등록!!');
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/*****************************************************************************************************************/

function emg_prolist2() {
    var emg_prolist2 = "긴급 공정리스트 추가";

    // Validation 추가
    var checked_length = $("input[name='quantity_no[]']:checked").length;
    if (checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    var quantity_no = document.getElementsByName("quantity_no[]"); // 체크박스 변수 선언
    var input_ho = document.getElementsByName("input_ho[]");
    var input_por = document.getElementsByName("input_por[]");
    var input_seq = document.getElementsByName("input_seq[]");
    var input_qt_no = document.getElementsByName("input_qt_no[]");
    var emg_list_title = $('[name=emg_list_title]').val();

    var inputHo_arr = new Array;
    var inputPor_arr = new Array;
    var inputSeq_arr = new Array;
    var inputQtNo_arr = new Array;

    for (var i = 0; i < quantity_no.length; i++) {
        if (quantity_no[i].checked) {
            if (input_qt_no[i].value != "긴급") {
                alert("긴급 물량만 등록 가능합니다!!");
                return false;
            }

            inputHo_arr.push(input_ho[i].value);
            inputPor_arr.push(input_por[i].value);
            inputSeq_arr.push(input_seq[i].value);
            inputQtNo_arr.push(input_qt_no[i].value);
        }
    }

    var input_ho = JSON.stringify(inputHo_arr);
    var input_por = JSON.stringify(inputPor_arr);
    var input_seq = JSON.stringify(inputSeq_arr);
    var input_qt_no = JSON.stringify(inputQtNo_arr);

    // var url = "/hj/sub01/sub0102_proList.php?emg_prolist=" + emg_prolist + "&emg_input_ho=" + input_ho + "&emg_input_por=" + input_por + "&emg_input_seq=" + input_seq + "&emg_input_qt_no=" + input_qt_no;
    // var name = "긴급 공정리스트 투입";
    // var option = "width = 1000, height = 500";
    // window.open(url, name, option);

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'emg_prolist2': emg_prolist2,
            'emg_input_ho': input_ho,
            'emg_input_por': input_por,
            'emg_input_seq': input_seq,
            'emg_input_qt_no': input_qt_no,
            'emg_list_title': emg_list_title
        },
        success: function(data) {
            location.reload(true);

            // var url = "/hj/include/query.php?emg_prolist=" + emg_prolist + "&emg_input_ho=" + input_ho + "&emg_input_por=" + input_por + "&emg_input_seq=" + input_seq + "&emg_input_qt_no=" + input_qt_no + "&emg_list_title=" + emg_list_title;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        beforeSend: function () {
            alert('긴급 공정리스트 추가!!');
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/


/***************************************** 공정 리스트 - 제작 납기 자동 변경*****************************************/
function proDate_up2(e, ho, por, qt_no) {
    var proDate_up2 ="제작 납기 자동 변경";
    var pro_date = $(e).closest('tr').find("[name='input_pro_date[]']").val();
    var ho = ho;
    var por = por;
    var qt_no = qt_no;

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'proDate_up2': proDate_up2,
            'pro_date': pro_date,
            'ho': ho,
            'por': por,
            'qt_no' : qt_no
        },
        success: function(data) {
        //    var url = "/hj/include/query.php?proDate_up="+proDate_up+"&pro_date="+pro_date+"&ho="+ho+"&por="+por+"&qt_no="+qt_no;
        //     var name = "생산투입";
        //     var option = "width = 1000, height = 1000";
        //     window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 공정 리스트 - 제작 납기 자동 변경*****************************************/
function mpDate_up2(e, ho, por, qt_no) {
    var mpDate_up2 ="MP 납기 자동 변경";
    var mp_date = $(e).closest('tr').find("[name='input_mp_date[]']").val();
    var ho = ho;
    var por = por;
    var qt_no = qt_no;

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'mpDate_up2': mpDate_up2,
            'mp_date': mp_date,
            'ho': ho,
            'por': por,
            'qt_no' : qt_no
        },
        success: function(data) {
        //    var url = "/hj/include/query.php?mpDate_up="+mpDate_up+"&mp_date="+mp_date+"&ho="+ho+"&por="+por+"&qt_no="+qt_no;
        //     var name = "생산투입";
        //     var option = "width = 1000, height = 1000";
        //     window.open(url, name, option);
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 공정 리스트 조회 - 엑셀 다운로드 *****************************************/
/* 엑셀 다운로드 */
function sub_excel2(lot_date, list_lot) {
    // if(confirm("엑셀 다운로드를 하시겠습니까??")) {
            // var lot_date = lot_date;
            var list_lot = list_lot;
            var sub_excel = "/hj/sub02/sub0203_excel.php?lot_date=" + lot_date + "&list_lot=" + list_lot;
            location.href = sub_excel;

            // alert("다운로드 완료!!");
    // } else {
        // alert("다운로드를 취소하였습니다.");
    // }
}
/*****************************************************************************************************************/


/***************************************** 공정 리스트 - 공정 정보 전체 수정*****************************************/
function other_update4() {
    var other_update4 = "전체 저장";
    var prolist_ho = document.getElementsByName('prolist_ho[]');
    var prolist_por = document.getElementsByName('prolist_por[]');
    var series = document.getElementsByName('input_series[]');
    var pro_date = document.getElementsByName('input_pro_date[]');
    var mp_date = document.getElementsByName('input_mp_date[]');
    var sp = document.getElementsByName('input_sp[]');
    var qt_no = document.getElementsByName('prolist_no[]');
    // var revision = document.getElementsByName('input_revision[]');

    var prolistHo_arr = new Array();
    var prolistPor_arr = new Array();
    var series_arr = new Array();
    var pro_date_arr = new Array();
    var mp_date_arr = new Array();
    var sp_arr = new Array();
    var qtNo_arr = new Array();
    // var revision_arr = new Array();

    for (var i = 0; i < prolist_ho.length; i++) {
        prolistHo_arr.push(prolist_ho[i].value);
        prolistPor_arr.push(prolist_por[i].value);
        series_arr.push(series[i].value);
        pro_date_arr.push(pro_date[i].value);
        mp_date_arr.push(mp_date[i].value);
        sp_arr.push(sp[i].value);
        qtNo_arr.push(qt_no[i].value);
        // revision_arr.push(revision[i].value);
    }

    var prolist_ho = JSON.stringify(prolistHo_arr);
    var prolist_por = JSON.stringify(prolistPor_arr);
    var series = JSON.stringify(series_arr);
    var pro_date = JSON.stringify(pro_date_arr);
    var mp_date = JSON.stringify(mp_date_arr);
    var sp = JSON.stringify(sp_arr);
    var qt_no = JSON.stringify(qtNo_arr);
    // var revision = JSON.stringify(revision_arr);

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'other_update4': other_update4,
            'prolist_ho': prolist_ho,
            'prolist_por': prolist_por,
            'series': series,
            'pro_date': pro_date,
            'mp_date': mp_date,
            'upQt_no': qt_no,
            'sp': sp
                // 'revision': revision
        },
        success: function(data) {
            location.reload(true);

            // var url = "/hj/include/query.php?other_update2="+other_update2+"&prolist_ho="+prolist_ho+"&prolist_por="+prolist_por+"&series="+series+"&sp="+sp+"&pro_date="+pro_date+"&mp_date="+mp_date;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        beforeSend: function () {
            alert('공정정보 전체 저장!!');
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 공정리스트 조회 - 선택한 공정 취소****************************************/
function prolist_delete2() {
    var prolist_delete2 = "공정 취소";

    // Validation 추가
    var checked_length = $("input[name='prolist_no[]']:checked").length;
    if (checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    var prolist_no = document.getElementsByName("prolist_no[]"); // 체크박스 변수 선언
    var prolist_ho = document.getElementsByName("prolist_ho[]");
    var prolist_por = document.getElementsByName("prolist_por[]");
    // var prolist_seq = document.getElementsByName("prolist_seq[]");

    var prolistNo_arr = new Array;
    var prolistHo_arr = new Array;
    var prolistPor_arr = new Array;
    // var prolistSeq_arr = new Array;

    for (var i = 0; i < prolist_no.length; i++) { // 체크박스 길이 만큼 i 증가
        if (prolist_no[i].checked) { // 체크된 체크박스 만큼 선택
            prolistNo_arr.push(prolist_no[i].value); // 선택된 값 가져오기(추가 - push)
            prolistHo_arr.push(prolist_ho[i].value);
            prolistPor_arr.push(prolist_por[i].value);
            // prolistSeq_arr.push(prolist_seq[i].value);
        }
    }

    var prolist_qtNo = JSON.stringify(prolistNo_arr);
    var prolist_ho = JSON.stringify(prolistHo_arr);
    var prolist_por = JSON.stringify(prolistPor_arr);
    // var prolist_seq = JSON.stringify(prolistSeq_arr);
    // alert(prolist_seq);

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'prolist_delete2': prolist_delete2,
            'prolist_qtNo': prolist_qtNo,
            'prolist_ho': prolist_ho,
            'prolist_por': prolist_por
            // 'prolist_seq': prolist_seq
        },
        success: function(data) {
            location.reload(true);

            // var url = "/hj/include/query.php?prolist_delete="+prolist_delete+"&prolist_ho="+prolist_ho+"&prolist_por="+prolist_por+"&prolist_qtNo="+prolist_qtNo;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        beforeSend: function () {
            alert('공정 취소!!');
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 공정리스트 조회 - 추가(복사본 생성)****************************************/
function add_prolist2(e) {
    var add_prolist2 = "NO 변경 추가";
    var prolist_ho = $(e).closest('tr').find("[name='prolist_ho[]']").val();
    var prolist_por = $(e).closest('tr').find("[name='prolist_por[]']").val();
    var update_qtNo = $(e).closest('tr').find("[name='update_qtNo']").val();
    var prolist_seq = $(e).closest('tr').find("[name='prolist_seq[]']");

    var prolist_seq_arr = new Array;
    for (var i = 0; i < prolist_seq.length; i++) {
        prolist_seq_arr.push(prolist_seq[i].value);
    }

    var prolist_seq = JSON.stringify(prolist_seq_arr);

    // 유효성 검사
    var all_qtNo = $("[name='prolist_no[]']");
    for (var j = 0; j < all_qtNo.length; j++) {
        if (update_qtNo == all_qtNo[j].value) {
            alert("번호가 중복됩니다!!");
            return false;
        }
    }

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'add_prolist2': add_prolist2,
            'prolist_ho': prolist_ho,
            'prolist_por': prolist_por,
            'prolist_seq': prolist_seq,
            'update_qtNo': update_qtNo,
        },
        success: function(data) {
            location.reload(true);
            $(".sub0103_table").load(location.href + " .sub0103_table");

            // var url = "/hj/include/query.php?add_prolist=" + add_prolist + "&prolist_ho=" + prolist_ho + "&prolist_por=" + prolist_por + "&prolist_seq=" + prolist_seq + "&update_qtNo=" + update_qtNo;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        beforeSend: function () {
            alert('NO 변경 완료!!');
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });
}
/***********************************************************************************************************************/

/***************************************** 공정리스트 조회 - 공정리스트 LOT 번호 부여****************************************/
function insert_proList2() {
    var insert_proList2 = "공정리스트 LOT번호 부여";

    var in_prolist_no = document.getElementsByName("prolist_no[]"); // 체크박스 변수 선언
    var in_prolist_ho = document.getElementsByName("prolist_ho[]");
    var in_prolist_por = document.getElementsByName("prolist_por[]");

    var in_prolistNo_arr = new Array;
    var in_prolistHo_arr = new Array;
    var in_prolistPor_arr = new Array;

    for (var i = 0; i < in_prolist_no.length; i++) { // 체크박스 길이 만큼 i 증가
        if (in_prolist_no[i].checked) { // 체크된 체크박스 만큼 선택
            in_prolistNo_arr.push(in_prolist_no[i].value); // 선택된 값 가져오기(추가 - push)
            in_prolistHo_arr.push(in_prolist_ho[i].value);
            in_prolistPor_arr.push(in_prolist_por[i].value);
        }
    }

    var in_prolist_no = JSON.stringify(in_prolistNo_arr);
    var in_prolist_ho = JSON.stringify(in_prolistHo_arr);
    var in_prolist_por = JSON.stringify(in_prolistPor_arr);

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'insert_proList2': insert_proList2,
            'in_prolist_no': in_prolist_no,
            'in_prolist_ho': in_prolist_ho,
            'in_prolist_por': in_prolist_por
        },
        success: function(data) {
            location.reload(true);

            // var url = "/hj/include/query.php?insert_proList=" + insert_proList + "&in_prolist_no=" + in_prolist_no + "&in_prolist_ho=" + in_prolist_ho + "&in_prolist_por=" + in_prolist_por;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        beforeSend: function () {
            alert('공정리스트 LOT 생성 완료');
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            alert('등록 안됨');
        }
    });

}
/*****************************************************************************************************************/

/***************************************** 공정 리스트 - 리스트 제목 수정*****************************************/
// 2022-12-15. 김한얼. 수정보완사항 적용
function prolist_titUp2(e, lot_date, list_lot) {
    var prolist_titUp2 = "리스트 제목 수정";
    var list_title = $(e).closest('tr').find('[name=list_title]').val();

    $.ajax({
        url: "/hj/include/query2.php",
        type: "POST",
        data: {
            'prolist_titUp2': prolist_titUp2,
            'list_title': list_title,
            'lot_date': lot_date,
            'list_lot': list_lot
        },
        success: function(data) {
            location.reload(true);

            // var url = "/hj/include/query.php?input_prolist="+input_prolist+"&input_ho="+input_ho+"&input_por="+input_por+"&input_seq="+input_seq+"&input_qt_no="+input_qt_no;
            // var name = "생산투입";
            // var option = "width = 1000, height = 1000";
            // window.open(url, name, option);
        },
        beforeSend: function () {
            alert('리스트 제목 수정!!');
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            alert('삭제 안됨');
        }
    });
}
/*****************************************************************************************************************/

/***************************************** 생산실적 관리 - 생산실적 상세조회****************************************/
function select_prolist3(lot_date, list_lot) {
    var select_prolist = "공정리스트 상세조회";
    var lot_date = lot_date;
    var list_lot = list_lot;

    location.href = "/hj/sub02/sub0203.php?lot_date=" + lot_date + "&list_lot=" + list_lot;
}
/*****************************************************************************************************************************/

/***************************************** 생산실적 관리 - 생산실적 상세조회****************************************/
function select_prolist4(list_title) {
    var select_prolist = "공정리스트 상세조회";
    var lot_date = lot_date;
    var list_lot = list_lot;

    location.href = "/hj/sub02/sub0203.php?lot_date=" + lot_date + "&list_lot=" + list_lot;
}
/*****************************************************************************************************************************/


/***************************************** 공정리스트 상세조회 - 공정리스트 LOT 번호 조회****************************************/
function prolist_print2(lot_date, list_lot) {
    var lot_date = lot_date;
    var list_lot = list_lot;

    location.href = "/hj/sub02/sub0203_print.php?lot_date=" + lot_date + "&list_lot=" + list_lot;
}
/*****************************************************************************************************************/

/***************************************** 컷팅지 인쇄 - 컷팅지 프레임/다릿발 인쇄 페이지****************************************/
function cut_print3(lot_date, list_lot) {
    var lot_date = lot_date;
    var list_lot = list_lot;

    location.href = "/hj/sub02/sub0204.php?lot_date=" + lot_date + "&list_lot=" + list_lot;
}
/*****************************************************************************************************************/


//************************************************************************************************************************************************//




/***************************************** 2023-06-28. 김한얼 팀장. 절단치수 팝업창****************************************/
function cutSize_upload() {
    var url = "/hj/sub03/sub0301_upload.php";
    var name = "절단치수 등록";
    var option = "width = 1300, height = 1000";
    
    window.open(url, name, option);
}
/*****************************************************************************************************************************/

/***************************************** 2023-06-28. 김한얼 팀장. 절단 등록****************************************/
function cut_insert() {
    var cut_insert = "절단 등록";
    var checked_length = $("input[name='no[]']:checked").length;
    if(checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    // 체크박스에서 선택된 값 가져오기
    var no = document.getElementsByName('no[]');

    // 배열 선언
    var no_arr = new Array;

    for(var i = 0; i < no.length; i++) { // 체크박스 길이 만큼 i 증가
        if(no[i].checked) { // 체크된 체크박스 만큼 선택
           no_arr.push(no[i].value); // 선택된 값 배열 push(추가)
        }
    }

    var no_arr = JSON.stringify(no_arr); // JSON 형식 변환

    $.ajax({
        url: "/hj/include/query3.php",
        type: "POST",
        data: {
            'cut_insert': cut_insert,
            'cut_no': no_arr
        },
        success: function(data) {
            alert(data);
            opener.location.reload();
            location.reload(); 
        },
        beforeSend: function() {
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            
        }
    });
}
/*****************************************************************************************************************************/

/***************************************** 2023-06-28. 김한얼 팀장. 절단대기 삭제****************************************/
function cut_delete() {
    var cut_delete = "절단대기 삭제";

    var checked_length = $("input[name='no[]']:checked").length;
    if(checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    // 체크박스에서 선택된 값 가져오기
    var no = document.getElementsByName('no[]');

    // 배열 선언
    var no_arr = new Array;

    for(var i = 0; i < no.length; i++) { // 체크박스 길이 만큼 i 증가
        if(no[i].checked) { // 체크된 체크박스 만큼 선택
           no_arr.push(no[i].value); // 선택된 값 배열 push(추가)
        }
    }

    var no_arr = JSON.stringify(no_arr); // JSON 형식 변환

    $.ajax({
        url: "/hj/include/query3.php",
        type: "POST",
        data: {
            'cut_delete': cut_delete,
            'cut_delNo': no_arr
        },
        success: function(data) {
            if(confirm('절단대기 정보를 삭제하시겠습니까??')) {
                alert('절단대기 삭제 완료!!');
                opener.location.reload();
                location.reload(); 
            } else {
                alert('취소!!');
            }
        },
        beforeSend: function() {
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            
        }
    });
}
/*****************************************************************************************************************************/

/***************************************** 2023-06-28. 김한얼 팀장. 절단 -> 물량 등록****************************************/
function quantity_ok() {
    var quantity_ok = "물량 산출";

    var checked_length = $("input[name='no[]']:checked").length;
    if(checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    // 체크박스에서 선택된 값 가져오기
    var no = document.getElementsByName('no[]');

    // 배열 선언
    var no_arr = new Array;

    for(var i = 0; i < no.length; i++) { // 체크박스 길이 만큼 i 증가
        if(no[i].checked) { // 체크된 체크박스 만큼 선택
           no_arr.push(no[i].value); // 선택된 값 배열 push(추가)
        }
    }

    var no_arr = JSON.stringify(no_arr); // JSON 형식 변환

    $.ajax({
        url: "/hj/include/query3.php",
        type: "POST",
        data: {
            'quantity_ok': quantity_ok,
            'quantity_okNo': no_arr
        },
        success: function(data) {
            if(confirm('물량을 산출하시겠습니까??')) {
                alert(data);
                location.reload();
            } else {
                alert('취소!!');
            }
        },
        beforeSend: function() {
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            
        }
    });
}
/*****************************************************************************************************************************/

/***************************************** 2023-06-28. 김한얼 팀장. 물량 -> 절단치수 이전****************************************/
function cut_back() {
    var cut_back = "절단치수 이전";

    var checked_length = $("input[name='no[]']:checked").length;
    if(checked_length < 1) {
        alert('항목을 선택해주세요!!');
        return false;
    }

    // 체크박스에서 선택된 값 가져오기
    var no = document.getElementsByName('no[]');

    // 배열 선언
    var no_arr = new Array;

    for(var i = 0; i < no.length; i++) { // 체크박스 길이 만큼 i 증가
        if(no[i].checked) { // 체크된 체크박스 만큼 선택
           no_arr.push(no[i].value); // 선택된 값 배열 push(추가)
        }
    }

    var no_arr = JSON.stringify(no_arr); // JSON 형식 변환

    $.ajax({
        url: "/hj/include/query3.php",
        type: "POST",
        data: {
            'cut_back': cut_back,
            'cutBack_no': no_arr
        },
        success: function(data) {
            if(confirm('절단으로 이전하시겠습니까??')) {
                alert(data);
                location.reload();
            } else {
                alert('취소!!');
            }
        },
        beforeSend: function() {
            $("div.loader_div").css("display", "block");
            $("div#show").css("display", "none");
        },
        error: function(request, status, error) {
            
        }
    });
}
/*****************************************************************************************************************************/

/***************************************** 2023-06-28. 김한얼 팀장. 절단 래스팅 기능(계산)****************************************/
function resting(e, length) {
    var length = length;
    var cut_count = $(e).closest('tr').find('[name=cut_count]').val();
    var cut_length = $(e).closest('tr').find('[name=cut_length]').val();

    // alert("cut_count : " + cut_count + " / " + "cut_length : " + cut_length);

    if(cut_count != "" && cut_length != "") {
        var resting = length - (cut_length * cut_count);
        resting = resting.toFixed(1); // 소수점 첫째자리 반올림
        var show_resting = "<span style='color: red; font-weight: bold;'>" + resting + "</span>";

        $(e).children('td#show_span').find('span').remove();
        $(e).children('td#show_span').append(show_resting);
    }
}
/*****************************************************************************************************************************/
