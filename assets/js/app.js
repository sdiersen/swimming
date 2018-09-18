'use strict';

import $ from 'jquery';
import 'bootstrap';
import '@fortawesome/fontawesome-free';

import '../../node_modules/bootstrap/scss/bootstrap.scss';
import '../../node_modules/@fortawesome/fontawesome-free/css/all.css';
import '../css/app.scss';

$(document).ready(function() {
    let swimForm = `
<form  id="createFrom" action="www.swimming.test/swim/levels/new" method="POST">
    <div class="container">
        <div class="row">
            <label for="title" class="form-control-lg col-sm-2">Title: </label>
            <input id="title" name="title" type="text" class="form-control form-control-lg w-50 col-sm-10">
        </div>
        <div class="row">
            <label for="description" class="form-control-lg col-sm-2">Description: </label>
            <textarea id="description" name="description" class="form-control-lg form-control w-50 col-sm-10"></textarea>
        </div>
        <div class="row">
            <label for="requirements" class="form-control-lg col-sm-2">Requirements: </label>
            <textarea id="requirements" name="requirements" class="form-control-lg form-control w-50 col-sm-10"></textarea>
        </div>
        <div class="row">
            <label for="ageRange" class="form-control-lg col-sm-2">Age Range: </label>
            <input id="ageRange" name="ageRange" type="text" class="form-control form-control-lg w-50 col-sm-10">
        </div>
    </div>
</form>       
<div class="container">
    <div class="row">
        <a class="btn btn-danger w-25 col-sm-6" id="cancelSwimLevelCreate" href="http://swimming.test/swim/levels/" role="button">Cancel</a>
        <button type="submit" id="createSwimLevel" class="btn btn-success w-25 col-sm-6">Create Swim Level</button>
    </div>    
</div> 
`;
    const initCreateSwimLevel = () => {
        $("#createSwimLevel").on("click", () => {
            let jsonObj = new Object();
            jsonObj.title = $("#title").val();
            jsonObj.description = $("#description").val();
            jsonObj.requirements = $("#requirements").val();
            jsonObj.ageRange = $("#ageRange").val();

            $.ajax({
                type: "POST",
                url: "http://swimming.test/swim/levels/new",
                data: jsonObj,
                success: () => {
                    $("#newSwimLevelDiv").html('');
                    $("#swimLevelCreate").removeClass("d-none");
                }
            });



        });
    };

    $("#swimLevelCreate").on("click", function() {
        $("#newSwimLevelDiv").html(swimForm);
        $("#swimLevelCreate").addClass("d-none");
        initCreateSwimLevel();
    });

    $("#cancelSwimLevelCreate").on("click", () => {
        $("#swimLevelCreate").removeClass("d-none");
    });



});