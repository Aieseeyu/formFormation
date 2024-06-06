$(document).ready(function () {
  let person = {};
  let helpers = {};

  // fonction pour le stepper d'en haut
  function stepper(step) {
    // console.log();
    $(".section").hide();
    $(".section" + step).show();
    for (let index = 4; index > step; index--) {
      $(".step" + index).removeClass("completed");
    }
    for (let index = 1; index <= step; index++) {
      $(".step" + index).addClass("completed");
    }
  }

  $(".step-icon").on("click", function () {
    // alert($(this).text());
    stepper($(this).text());
  });

  // pour afficher les pages suivantes
  $("#nextStepTo").on("click", function (e) {
    e.preventDefault();

    helpers.step = $(this).data("step");
    $(".section" + helpers.step).hide();
    helpers.step++;
    stepper(helpers.step);
    $(".section" + helpers.step).show();
    $(this).data("step", helpers.step);

    return false;
  });

  // SECTION 1
  // pour afficher les bons inputs sur le select
  $("#selectOccupation").on("change", function () {
    person.selected = $("#selectOccupation option:selected").val();
    for (let index = 1; index <= 7; index++) {
      $("#option" + index).hide();
    }
    $("#option" + person.selected).show();
  });
});
