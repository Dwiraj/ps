/**
 * Created by Dwiraj on 11-Mar-16.
 */

$("#login-form").validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 5,
            maxlength: 12
        }
    },
    messages: {
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long",
            maxlength: 'Password not be graterthen 12 characters'
        },
        email: "Please enter a valid email address",
    },
    submitHandler: function(form) {
        form.submit();
    }
});

$('#adduser-form').validate ({
    rules: {
        first_name: {
            required: true,
            minlength: 3,
            maxlength: 30
        },
        last_name: {
            required: true,
            minlength: 3,
            maxlength: 30
        },
        email: {
            required: true,
            email: true
        },
        user_level: "required",
        password: {
            required:true,
            minlength: 6,
            maxlength: 24
        },
        cpassword: {
            required: true,
            equalTo: "#password"
        }
    },
    messages: {
        first_name: {
            required: "please enter first name",
            minlength: "first name must be at least 3 characters long",
            maxlength: "first name is too long"
        },
        last_name: {
            required: "please enter last name",
            minlength: "last name must be at least 3 characters long",
            maxlength: "last name is too long"
        },
        email: "Please enter a valid email address",
    },
    submitHandler: function(form1) {
        form1.submit();
    }
});