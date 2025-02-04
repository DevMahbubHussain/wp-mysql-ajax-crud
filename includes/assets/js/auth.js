jQuery(document).ready(function ($) {
  $("#profile-form").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: FAjax.ajax_url,
      type: "POST",
      data: {
        action: "user_profile_update",
        nonce: FAjax.nonce,
        display_name: $("#display_name").val(),
        user_email: $("#user_email").val(),
      },
      success: function (response) {
        console.log(response.data);
      },
      complete: function () {
        console.log("Profile Update Request Completed");
      },
    });
  });

  // Ensure document is fully loaded before binding event
  $(document).on("submit", "#login-form", function (e) {
    e.preventDefault();
    console.log("Login button clicked"); // Debugging log

    let user_login = $("#user_login").val();
    let user_pass = $("#user_pass").val();

    // Debugging: Check if values are being retrieved
    console.log({ user_login, user_pass });

    // if (!user_login || !user_pass) {
    //   alert("Username and Password are required!");
    //   return;
    // }

    $.ajax({
      url: FAjax.ajax_url,
      type: "POST",
      data: {
        action: "user_login",
        nonce: FAjax.nonce,
        user_login: user_login,
        user_pass: user_pass,
      },
      success: function (response) {
        console.log(response);

        if (response.success) {
          alert("Login Successful!");
          window.location.href = response.data.redirect_url || "/";
        } else {
          alert("Login Failed: " + response.data.message);
        }
      },
      error: function () {
        alert("AJAX request failed.");
      },
      complete: function () {
        console.log("Login Request Completed");
      },
    });
  });
});
