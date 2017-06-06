
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('jquery')

$(document).ready(function() {
    $('select[name="assignable_type"]').change(function(e) {
        var selected = $('select[name="assignable_type"] option:selected').val();

        $('#node_select').hide();
        $('#node_select select').attr('disabled', 'disabled');

        $('#member_select').hide();
        $('#member_select select').attr('disabled', 'disabled');

        $('#' +selected+ '_select').show();
        $('#' +selected+ '_select select').attr('disabled', false);
    });

    $('select[name="assignable_type"]').trigger('change');
});