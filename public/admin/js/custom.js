$(document).ready(function () {
    // CREATE LINK
    function createLink(exceptParams) {
        //http://localhost/index.php?module=backend&controller=group&action=index&fiter_groupacp=1
        let pathname = window.location.pathname; //  index.php
        let searchParams = new URLSearchParams(window.location.search); //module=backend&controller=group&action=index&fiter_groupacp=1
        let searchParamsEntries = searchParams.entries(); // la 1 mảng  // module => backend
        // controller => group
        // action => index
        // fiter_groupacp => 1
        // filter_search => 'ad'
        let link = pathname + "?"; // index.php?

        // exceptParams: ['filter_page', 'sort_field', 'sort_order', 'filter_search']
        for (let pair of searchParamsEntries) {
            if (exceptParams.indexOf(pair[0]) == -1) {
                link += `${pair[0]}=${pair[1]}&`;
                // index.php?module=backend&controller=group&action=index&fiter_groupacp=1&
            }
        }
        return link;
    }

    let $btnSearch = $("button#btn-search");
    let $btnClearSearch = $("button#btn-clear-search");

    let $inputSearchField = $("input[name  = search_field]");
    let $inputSearchValue = $("input[name  = search_value]");

    // let $selectFilter     = $("select[name = select_filter]");
    let $selectChangeAttr = $("select[name =  select_change_attr]");
    // let $selectChangeAttrAjax = $("select[name =  select_change_attr_ajax]");

    $("a.select-field").click(function (e) {
        e.preventDefault();

        let field = $(this).data("field"); //lay ten cua cot
        let fieldName = $(this).html(); // lay ma html
        $("button.btn-active-field").html(
            fieldName + ' <span class="caret"></span>'
        );
        $inputSearchField.val(field);
    });

    $btnSearch.click(function () {
        var pathname = window.location.pathname; // lay duong dan hien tai
        let params = [
            "page",
            "filter_status",
            "select_field",
            "select_value",
            "filter_group_acp",
        ]; //lay cac gia tri nam trong mang
        let searchParams = new URLSearchParams(window.location.search); //lay phan search tren url ?filter_status=active

        let link = "";
        $.each(params, function (key, param) {
            if (searchParams.has(param)) {
                link += param + "=" + searchParams.get(param) + "&"; // lay url cu
            }
        });

        let search_field = $inputSearchField.val();
        let search_value = $inputSearchValue.val();

        if (search_value.replace(/\s+/g, "") == "") {
            // alert("Nhập vào giá trị cần tìm");
            showToast("warning", "import_content_search");
        } else {
            window.location.href =
                pathname +
                "?" +
                link +
                "search_field=" +
                search_field +
                "&search_value=" +
                search_value /* .replace(/\s+/g, '+').toLowerCase() */;
        }
    });

    $btnClearSearch.click(function () {
        var pathname = window.location.pathname;
        let searchParams = new URLSearchParams(window.location.search);

        params = ["page", "filter_status", "select_filter"];

        let link = "";
        $.each(params, function (key, param) {
            if (searchParams.has(param)) {
                link += param + "=" + searchParams.get(param) + "&";
            }
        });

        window.location.href = pathname + "?" + link.slice(0, -1);
    });

    // //Event onchange select filter
    // $selectFilter.on('change', function () {
    // 	var pathname	= window.location.pathname;
    // 	let searchParams= new URLSearchParams(window.location.search);

    // 	params 			= ['page', 'filter_status', 'search_field', 'search_value'];

    // 	let link		= "";
    // 	$.each( params, function( key, value ) {
    // 		if (searchParams.has(value) ) {
    // 			link += value + "=" + searchParams.get(value) + "&"
    // 		}
    // 	});

    // 	let select_field = $(this).data('field');
    // 	let select_value = $(this).val();
    // 	window.location.href = pathname + "?" + link.slice(0,-1) + 'select_field='+ select_field + '&select_value=' + select_value;
    // });

    // // Change attributes with selectbox
    // // $selectChangeAttr.on('change', function() {
    // // 	let item_id = $(this).data('id');
    // // 	let url = $(this).data('url');
    // // 	let csrf_token = $("input[name=csrf-token]").val();
    // // 	let select_field = $(this).data('field');
    // // 	let select_value = $(this).val();
    // //
    // // 	$.ajax({
    // // 		url : url,
    // // 		type : "post",
    // // 		dataType: "html",
    // // 		headers: {'X-CSRF-TOKEN': csrf_token},
    // // 		data : {
    // // 			id : item_id,
    // // 			field: select_field,
    // // 			value: select_value
    // // 		},
    // // 		success : function (result){
    // // 			if(result == 1)
    // // 				alert('Bạn đã cập nhật giá trị thành công!');
    // // 			else
    // // 				console.log(result)
    // //
    // // 		}
    // // 	});
    // // });

    $selectChangeAttr.on("change", function () {
        let select_value = $(this).val();
        let $url = $(this).data("url");
        window.location.href = $url.replace("value_new", select_value);
    });

    // $selectChangeAttrAjax.on('change', function() {
    // 	let select_value = $(this).val();
    // 	let $url = $(this).data('url');
    // 	let csrf_token = $("input[name=csrf-token]").val();

    // 	$.ajax({
    // 		url : $url.replace('value_new', select_value),
    // 		type : "GET",
    // 		dataType: "json",
    // 		headers: {'X-CSRF-TOKEN': csrf_token},
    // 		success : function (result){
    // 			if(result) {
    // 				$.notify({
    // 					message: "Cập nhật giá trị thành công!"
    // 				}, {
    // 					delay: 500,
    // 					allow_dismiss: false
    // 				});
    // 			}else {
    // 				console.log(result)
    // 			}
    // 		}
    // 	});

    // });

    // //Init datepicker
    // $('.datepicker').datepicker({
    // 	format: 'dd-mm-yyyy',
    // });

    //========================================================TOAST========================================================
    // TOAST VI TRI
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timerProgressBar: true,
        timer: 5000,
        padding: "1rem",
    });

    // SHOW TOAST
    function showToast(type, action) {
        let message = "";
        switch (action) {
            case "update":
                message = "Cập nhật thành công !";
                break;
            case "updateError":
                message = "Cập nhật thất bại !";
                break;
            case "deleteSuccess":
                message = "Xoá dữ liệu thành công !";
                break;
            case "deleteError":
                message = "Xoá dữ liệu thất bại !";
                break;
            case "reset_pas_success":
                message = "Reset password thành công !";
                break;
            case "reset_pas_error":
                message = "Reset password thất bại !";
                break;
            case "addDataSuccess":
                message = "Thêm dữ liệu thành công !";
                break;
            case "addDataError":
                message = "Thêm dữ liệu thất bại !";
                break;
            case "editDataSuccess":
                message = "Chỉnh sửa dữ liệu thành công !";
                break;
            case "editDataError":
                message = "Chỉnh sửa dữ liệu thất bại !";
                break;
            case "bulk-action-not-selected-action":
                message = "Vui lòng chọn action cần thực hiện !";
                break;
            case "bulk-action-not-selected-row":
                message = "Vui lòng chọn ít nhất 1 dòng dữ liệu !";
                break;
            case "import_content_search":
                message = "Nhập nội dung cần tìm kiếm !";
                break;
        }
        Toast.fire({
            icon: type,
            title: " " + message,
        });
    }

    // SELECT GROUP ACP
    $("select[name=filter_groupacp]").change(function (e) {
        e.preventDefault();
        value = $("select[name=filter_groupacp]").val(); // default || 1 || 0

        if (value != "") {
            let exceptParams = [
                "filter_page",
                "sort_field",
                "sort_order",
                "filter_group_acp",
            ];
            let link = createLink(exceptParams);
            link += `filter_group_acp=${value}`;

            window.location.href = link;
        }
    });
    //============================= TẮt thông báo===========================

    $("#tat")
        .fadeTo(2000, 5000)
        .slideUp(500, function () {
            $("#tat").slideUp(500);
        });
    $(document).ready(function () {
        $(".my-btn-state").click(function showAlert() {
            $("#tat")
                .fadeTo(2000, 500)
                .slideUp(500, function () {
                    $("#tat").slideUp(500);
                });
        });
    });
    //============================= END TẮt thông báo===========================

    //======================Confirm button delete item====================
    $(".btn-delete").on("click", function () {
        if (!confirm("Bạn có chắc muốn xóa phần tử?")) return false;
    });
    //=============================Confirm button delete item======================
});
