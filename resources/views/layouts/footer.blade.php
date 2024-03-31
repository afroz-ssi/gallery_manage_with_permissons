</body>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="{{ asset('assets/js/custome.js') }}"></script>
<script src="{{ asset('assets/js/multiselect-dropdown.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/img-preview/dist/image-uploader.min.js') }} "></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
    // ================== DELETE GALLERY IMAGE =============

    $.fancybox.defaults.btnTpl.delete =
        '<button class="fancybox-button fancybox-delete-button">Delete</button>'
    $.fancybox.defaults.buttons = ['delete', 'close', 'download']

    $('body').on('click', 'button.fancybox-delete-button', function(e) {
        let url = window.location.href;
        var last_url = url.substring(url.lastIndexOf('/') + 1);
        var img_index_id = last_url.substring(last_url.lastIndexOf('-') + 1);
        let img_table_id = last_url.split("#")[0];


        // add attribut
        $(document).ready(function() {
            $(".swal-button--confirm").attr('id', 'confirm_delete');
        });
        $('body').on('click', '#confirm_delete', function(e) {
            e.preventDefault();
            let index = img_index_id - 1;
            var formData = {
                id: img_table_id,
                img_index: index
            };
            console.log(formData);

            $.ajax({
                type: "DELETE",
                url: '/customer/dashboard/galleries/delete',
                data: formData,
                success: function(response, textStatus, statusCode) {
                    console.log(response);
                    var status_code = statusCode.status;
                    if (status_code == 200 && response.status == 200) {
                        let currentUrl = window.location.href;
                        let urlBeforeHash = currentUrl.split('#')[0];
                        window.open(urlBeforeHash, "_self");
                        alert(response.message);
                    } else if (response.status == 204) {
                        alert(response.message);
                        window.open('http://127.0.0.1:8000/customer/dashboard/galleries',
                            "_self");
                    }

                },
                error: function(xhr) {
                    alert(xhr.responseJSON.error);
                    console.log("error", xhr);
                },
            });
        });

        swal("Are you sure you want to delete this?", {
            buttons: ["Cancel", "Delete!"],
        });
    });


    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });


    function togglePassword(passwordField) {
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>

</html>
