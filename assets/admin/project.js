
$(document).on('submit', ".update-form", function (e) {

    e.preventDefault();
    var _this = $(this);
    var url = _this.attr('action');
    var ajaxSubmit = _this.find('.btn-update-submit');
    var formData = new FormData(this);
    if (_this.data('url') !== undefined) {
        url = _this.data('url');
    }

    $.ajax({
        url: url,
        type: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        processData: false,
        data: formData,
        contentType: false,

        success: function (data) {
            // success data
            if (data.status == 'success') {
              new Noty({
                  layout   : 'topRight',
                  type     : 'success',
                  theme    : 'relax',
                  timeout  : true,
                  dismissQueue: true,
                  text     : [data.text],
              }).show()

              // setTimeout(function() {
              //     location.reload(0);
              // },2000);

            } else {
                //error code...
                new Noty({
                    layout   : 'topRight',
                    type     : 'error',
                    theme    : 'relax',
                    timeout: 3000,
                    text: [data.text],
                }).show();
            }
        },
        error: function (data) {
          new Noty({
              layout   : 'topRight',
              type     : 'error',
              theme    : 'relax',
              timeout: 3000,
              text: [data.text],
          }).show();
        }
    });
});


$(document).on('submit', ".add-form", function (e) {
    e.preventDefault();
    var $this = $(this);
    var url = $this.attr('action');
    var ajaxSubmit = $this.find('.btn-submit');

    var formData = new FormData(this);
    if ($this.data('url') !== undefined) {
        url = $this.data('url');
    }
    $.ajax({
        url: url,
        type: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        processData: false,
        data: formData,
        contentType: false,

        success: function (data) {
            // success data
            if (data.status == 'success') {
              new Noty({
                  layout   : 'topRight',
                  type     : 'success',
                  theme    : 'relax',
                  timeout  : true,
                  dismissQueue: true,
                  text     : [data.text],
              }).show()

              setTimeout(function() {
                  location.reload();
              }, 2000);

            } else {
                //error code...
                new Noty({
                    layout   : 'topRight',
                    type     : 'error',
                    theme    : 'relax',
                    timeout: 1500,
                    text: [data.text],
                }).show();
            }
        },
        error: function (data) {
          new Noty({
              layout   : 'topRight',
              type     : 'error',
              theme    : 'relax',
              timeout: 1500,
              text: [data.text],
          }).show();
        }
    });
});

$('#delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    $('#url').val(button.data('url'));
    $('#delete_id').val(button.data('id'));
    $('#delete_token').val(button.data('token'));
});

function ajaxDelete(filename, token, content) {
    content = typeof content !== 'undefined' ? content : 'content';
    $.ajax({
        type: 'POST',
        data: {_method: 'DELETE', _token: token},
        url: filename,
        success: function (data) {
            $('#modalDelete').modal('hide');
            $("#" + content).html(data);
            new Noty({
                layout   : 'topRight',
                type     : 'success',
                theme    : 'relax',
                timeout  : true,
                dismissQueue: true,
                text     : [data.text],
            }).show()

            setTimeout(function() {
                location.reload();
            }, 2000);

        },
        error: function (data, status, error) {
          new Noty({
              layout   : 'topRight',
              type     : 'error',
              theme    : 'relax',
              timeout  : 1500,
              text     : [data.text],
          }).show();
        }
    });
}
