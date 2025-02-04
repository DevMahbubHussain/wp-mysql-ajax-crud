jQuery(document).ready(function ($) {
  function showToast(icon, title) {
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
    });

    Toast.fire({
      icon: icon,
      title: title,
    });
  }

  // Show Loader
  function showLoader() {
    $("#loader").show();
  }

  // Hide Loader
  function hideLoader() {
    $("#loader").hide();
  }

  // Add Record
  $("#crud-form").on("submit", function (e) {
    e.preventDefault();
    showLoader();
    $.ajax({
      url: CAjax.ajax_url,
      type: "POST",
      data: {
        action: "crud_app_add_record",
        nonce: CAjax.nonce,
        name: $("#name").val(),
        email: $("#email").val(),
      },
      success: function (response) {
        // alert(response.data);
        showToast("success", "Record added successfully!");
        loadRecords();
        $("#crud-form")[0].reset(); // Clear the form
      },
      complete: function () {
        hideLoader();
      },
    });
  });

  // Load Records
  function loadRecords() {
    $.ajax({
      url: CAjax.ajax_url,
      type: "GET",
      data: {
        action: "crud_app_get_records",
        nonce: CAjax.nonce,
      },
      success: function (response) {
        // console.log(response);
        $("#crud-table tbody").empty();
        response.data.forEach(function (record) {
          $("#crud-table tbody").append(`
                        <tr>
                            <td>${record.id}</td>
                            <td>${record.name}</td>
                            <td>${record.email}</td>
                            <td>
                              <button
                                      class="delete-record" 
                                      data-id="${record.id}">
                                  Delete
                              </button>
                            </td>
                         <td>
                       <button 
                           class="edit-record"
                            data-id="${record.id}" 
                            data-name="${record.name}" 
                            data-email="${record.email}">
                            Edit
                          </button>
                         </td>
                        </tr>
                    `);
        });
      },
      complete: function () {
        hideLoader();
      },
    });
  }

  // Edit Record
  $(document).on("click", ".edit-record", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    var email = $(this).data("email");

    // Show the edit form and populate it with data
    $("#edit-form").show();
    $("#edit-id").val(id);
    $("#edit-name").val(name);
    $("#edit-email").val(email);
    $("#crud-form").hide(); // Hide the Add form
  });

  // Update Record
  $("#edit-form").on("submit", function (e) {
    e.preventDefault();
    showLoader();
    $.ajax({
      url: CAjax.ajax_url,
      type: "POST",
      data: {
        action: "crud_app_update_record",
        nonce: CAjax.nonce,
        id: $("#edit-id").val(),
        name: $("#edit-name").val(),
        email: $("#edit-email").val(),
      },
      success: function (response) {
        showToast("success", "Record updated successfully!");
        loadRecords();
        $("#edit-form").hide(); // Hide the edit form
        $("#edit-form")[0].reset(); // Clear the form
        $("#crud-form").show();
      },
      complete: function () {
        hideLoader();
      },
    });
  });

  // Cancel Edit
  $("#cancel-edit").on("click", function () {
    $("#edit-form").hide(); // Hide the edit form
    $("#edit-form")[0].reset(); // Clear the form
  });

  // Delete Record
  // $(document).on("click", ".delete-record", function () {
  //   var id = $(this).data("id");
  //   showLoader();
  //   $.ajax({
  //     url: CAjax.ajax_url,
  //     type: "POST",
  //     data: {
  //       action: "crud_app_delete_record",
  //       nonce: CAjax.nonce,
  //       id: id,
  //     },
  //     success: function (response) {
  //       // alert(response.data);
  //       loadRecords();
  //     },
  //     complete: function () {
  //       hideLoader();
  //     },
  //   });
  // });
  // Delete Record
  // $(document).on("click", ".delete-record", function () {
  //   var id = $(this).data("id");

  //   // Show confirmation dialog
  //   if (confirm("Are you sure you want to delete this record?")) {
  //     showLoader();
  //     $.ajax({
  //       url: CAjax.ajax_url,
  //       type: "POST",
  //       data: {
  //         action: "crud_app_delete_record",
  //         nonce: CAjax.nonce,
  //         id: id,
  //       },
  //       success: function (response) {
  //         alert(response.data);
  //         loadRecords();
  //       },
  //       complete: function () {
  //         hideLoader();
  //       },
  //     });
  //   }
  // });

  jQuery(document).ready(function ($) {
    // Delete Record with SweetAlert2
    $(document).on("click", ".delete-record", function () {
      var id = $(this).data("id");

      // Show SweetAlert2 confirmation dialog
      Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this record!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          showLoader();
          $.ajax({
            url: CAjax.ajax_url,
            type: "POST",
            data: {
              action: "crud_app_delete_record",
              nonce: CAjax.nonce,
              id: id,
            },
            success: function (response) {
              showToast("success", "Record deleted successfully!");
              // Swal.fire("Deleted!", response.data, "success");
              loadRecords();
            },
            complete: function () {
              hideLoader();
            },
          });
        }
      });
    });
  });

  // Load records on page load
  showLoader();
  loadRecords();
});
