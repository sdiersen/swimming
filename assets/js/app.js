'use strict';

import $ from 'jquery';
import 'bootstrap';

import '../css/app.scss';

$(document).ready(function() {
    $("#somebutton").click(function(e) {
        e.preventDefault();
        alert("hello");
    })
});
