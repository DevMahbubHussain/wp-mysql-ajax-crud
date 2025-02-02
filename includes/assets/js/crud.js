jQuery(document).ready(function ($) {
  // Add Record
  $("#crud-form").on("submit", function (e) {
    e.preventDefault();
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
        loadRecords();
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
                                <button class="delete-record" data-id="${record.id}">Delete</button>
                            </td>
                        </tr>
                    `);
        });
      },
    });
  }

  // Delete Record
  $(document).on("click", ".delete-record", function () {
    var id = $(this).data("id");
    $.ajax({
      url: CAjax.ajax_url,
      type: "POST",
      data: {
        action: "crud_app_delete_record",
        nonce: CAjax.nonce,
        id: id,
      },
      success: function (response) {
        alert(response.data);
        loadRecords();
      },
    });
  });

  // Load records on page load
  loadRecords();
});
