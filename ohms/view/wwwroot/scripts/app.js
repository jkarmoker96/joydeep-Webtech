$(document).ready(function () {

    const js_error = $("#js-error");
    const searchDoctor = $("#searchDoctor");
    const read_more = $(".show-read-more");
    const maxLength = 50;
    const email_regex = /(?:((?:[\w-]+(?:\.[\w-]+)*)@(?:(?:[\w-]+\.)*\w[\w-]{0,66})\.(?:[a-z]{2,6}(?:\.[a-z]{2})?));*)/g;

    $.validator.addMethod(
        "regex",
        function (value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please check your input."
    );

    read_more.each(function () {
        var myStr = $(this).text();
        if ($.trim(myStr).length > maxLength) {
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
            $(this).append('<span class="more-text">' + removedStr + '</span>');
        }
    });
    $(".read-more").click(function () {
        $(this).siblings(".more-text").contents().unwrap();
        $(this).remove();
    });

    searchDoctor.keyup(function () {
        var search__doctor = searchDoctor.val();
        $.ajax({
            url: "../controller/AjaxController.php",
            method: "get",
            datatype: "json",
            data: {
                search__doctor: search__doctor,
            },
            success: function (data) {
                $("#initial-doctor-row").html(data);
            }
        });
    });

    $("form[name='editaccount']").submit(function (e) {
        e.preventDefault();
    }).validate({
        rules: {
            name: "required",
            username: {
                required: true,
            },
            email: {
                required: true,
                regex: email_regex
            },
            dob: "required",
        },
        messages: {
            name: "Please enter your name",
            username: {
                required: "Please enter your username",
            },
            email: "Please enter a valid email address",
            dob: "Please choose your date of your birth"
        },
        submitHandler: function (form) {
            form.submit();
            var name = $("input[name='name']").val();
            var username = $("input[name='username']").val();
            var email = $("input[name='email']").val();
            var dob = $("input[name='dob']").val();
            $.ajax({
                url: "../controller/AjaxController.php",
                method: "post",
                datatype: "json",
                data: {
                    edit__account: "edit__account",
                    name: name,
                    username: username,
                    email: email,
                    dob: dob
                },
                success: function () {
                },
            });
        }
    });
    $("form[name='login']").validate({
        rules: {
            password: {
                required: true,
            },
            email: {
                required: true,
                regex: email_regex
            },
        },
        messages: {
            email: "Please enter a valid email address",
            password: {
                required: "Please provide a password",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("form[name='resetpassword']").validate({
        rules: {
            password: {
                required: true,
                minlength: 8
            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long"
            },
            confirm_password: {
                required: "Please provide a password",
                equalTo: "Confirm password not matched with password"
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("form[name='registration']").validate({
        rules: {
            name: "required",
            username: {
                required: true,
            },
            email: {
                required: true,
                regex: email_regex
            },
            password: {
                required: true,
                minlength: 8
            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            },
            gender: "required",
            dob: "required",
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(element.parents('.form-group'));
            }
            else {
                error.insertAfter(element);
            }
        },
        messages: {
            name: "Please enter your name",
            username: {
                required: "Please enter your username",
            },
            email: "Please enter a valid email address",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long"
            },
            confirm_password: {
                required: "Please provide a password",
                equalTo: "Confirm password not matched with password"
            },
            gender: "Please choose your gender",
            dob: "Please choose your date of your birth"
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

});
