$(document).ready(function() {

    $(document).on('click', '.remove-btn', function() {
        $(this).closest('.main-form').remove();
    });

    $(document).on('click', '.add-more-form', function() {
        $('.paste-new-forms').append('<div class="main-form mt-3 border-bottom">\
                        <div class="row">\
                            <div class="col-md-2">\
                                <div class="form-group mb-2">\
                                    <label for="">Tree</label>\
                                    <input type="text" name="tree[]" class="form-control">\
                                </div>\
                            </div>\
                            <div class="col-md-2">\
                            <div class="form-group mb-2">\
                                    <label for="">Type</label>\
                                    <select name="type[]" id="type" class="form-control">\
                                      <option>--Select--</option>\
                                      <option value="foriegn"></option>\
                                      <option value="native"></option>\
                                      <option value="fruit"></option>\
                                    </select>\
                                </div>\
                            </div>\
                            <div class="col-md-2">\
                                <div class="form-group mb-2">\
                                    <label for="">Status</label>\
                                    <select name="status[]" id="status" class="form-control">\
                                      <option>--Select--</option>\
                                      <option value="alive"></option>\
                                      <option value="dead"></option>\
                                    </select>\
                                </div>\
                            </div>\
                            <div class="col-md-2">\
                                <div class="form-group mb-2">\
                                    <label for="">Longitude</label>\
                                    <input type="text" name="longitude[]" class="form-control">\
                                </div>\
                            </div>\
                            <div class="col-md-2">\
                                <div class="form-group mb-2">\
                                    <label for="">Latitude</label>\
                                    <input type="text" name="latitude[]" class="form-control">\
                                </div>\
                            </div>\
                            <div class="col-md-2">\
                                <div class="form-group mb-2">\
                                    <br>\
                                    <button type="button" class="remove-btn btn btn-danger">Remove</button>\
                                </div>\
                            </div>\
                        </div>\
                    </div>');
    });

});