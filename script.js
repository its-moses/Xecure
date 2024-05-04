var usernameAvailable = false;

function checkUsernameAvailability() {
    var username = $("#username").val().trim();

    if (username !== "") {
        $.post("check_username.php", {
            username: username
        }, function(data) {
            if (data == "available") {
                $("#username_msg").text("Username is available").addClass("available").removeClass("not-available");
                usernameAvailable = true;
            } else {
                $("#username_msg").text("Username is not available").addClass("not-available").removeClass("available");
                usernameAvailable = false;
            }
        }).fail(function() {
            $("#username_msg").text("Error checking username availability").removeClass("available not-available");
            usernameAvailable = false;
        });
    } else {
        $("#username_msg").text("Please enter a username").removeClass("available not-available");
        usernameAvailable = false;
    }
}

$(document).ready(function() {
    $("#reset_btn").on("click", function() {
        $("#username").val("");
        $("#Password").val("");
        $("#username_msg").text("");
        $("#password_match_msg").text("");
        usernameAvailable = false;
    });

    $("#username").on("input", checkUsernameAvailability);
});





