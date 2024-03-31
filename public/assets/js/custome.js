let std_login = document.getElementById("std_login");

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
// +=========================== Admin and user login here===========
$("#multiLoginForm").on("submit", function (event) {
    event.preventDefault();
    var formData = {
        email: $("#email").val(),
        password: $("#password").val(),
    };
    $(".error-text").html("");
    $("#msg_err").html("");

    std_login.textContent = "Processing...";
    std_login.disabled = true;

    $.ajax({
        type: "POST",
        url: "/login",
        data: formData,
        success: function (response, textStatus, statusCode) {
            console.log(response, textStatus);
            var status_code = statusCode.status;
            if (status_code == 200) {
                $("#msg").text(response.message);
                $("#multiLoginForm")[0].reset();
                if (response.data.user == "admin") {
                    window.open("/admin/dashboard", "_self");
                } else {
                    window.open("/customer/dashboard", "_self");
                }
            }
            std_login.textContent = "Submit";
            std_login.disabled = false;
        },
        error: function (xhr, textStatus, errorThrown) {
            console.log(xhr.responseJSON);
            var statusCode = xhr.status;
            $("#msg_err").html("");
            if (statusCode == 422) {
                $.each(xhr.responseJSON.errors, function (prefix, val) {
                    $("small." + prefix + "_error").text(val[0]);
                });
            } else if (statusCode == 404) {
                $("#msg_err").text(xhr.responseJSON.error);
            } else if (statusCode == 500) {
                $("#msg_err").text(xhr.responseJSON.errors);
            }
            std_login.textContent = "Submit";
            std_login.disabled = false;
        },
    });
});
// +=========================== Admin and user login end ===========

// =========== Admin can active /deactive customer account
let user_status_ = document.getElementById("user_status_");
$("table").on("click", ".admin_act_deact_acc", function () {
    let accnt_status = $(this).attr("data-id");
    let std_id = $(this).val();
    let userId = $(this).attr("data-user-id");
    console.log("user_id " + userId + " accnt_status " + accnt_status);
    $("#user_status_" + userId).html("");

    if (accnt_status == 0) {
        accnt_status = 1;
        $(this).attr("data-id", accnt_status);
        $(`#user_status_${userId}`).append(
            '<span class="badge badge-success">Active</span>'
        );
        $(`#btn_status_${userId}`).text("Inactive");
    } else {
        accnt_status = 0;
        $(this).attr("data-id", accnt_status);
        $(`#user_status_${userId}`).append(
            '<span class="badge badge-danger">Inactive</span>'
        );
        $(`#btn_status_${userId}`).text("Active");
    }

    var formData = {
        accnt_status: accnt_status,
        userId: userId,
    };
    console.log(formData);
    call_url = "/admin/dashboard/admin-can-act-deact-customer";
    changeStdStatus(call_url, formData);
});

// Change status funtion
function changeStdStatus(url, formData) {
    $("#error").html();
    $.ajax({
        type: "GET",
        url: url,
        data: formData,
        success: function (response, textStatus, statusCode) {
            console.log(response);
            var status_code = statusCode.status;
            if (status_code == 200) {
                successAlert(response.message);
            }
        },
        error: function (xhr) {
            console.log(xhr.responseJSON);
            var statusCode = xhr.status;
            if (statusCode == 422) {
                // notihig to do
            }
        },
    });
}

function successAlert(msg) {
    let alert_msg = `<div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <span class="text-white">${msg}</span>
            </div>`;
    $("#error").html(alert_msg);
}

function errorAlert(msg) {
    let err = `<div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Danger!</strong> ${msg}
                </div>`;
    $("#error").html(err);
}
// ========== End here
