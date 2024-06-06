$(document).ready(function () {
  let person = {};
  let helpers = {};

  // fonction pour le stepper d'en haut
  function stepper(step) {
    helpers.step = step;

    // on cache toutes les pages
    $(".section").hide();

    // on montre que les bonnes pages
    $(".section" + step).show();

    // on enleve la classe completed jusqu'a avant le step
    for (let index = 4; index > step; index--) {
      $(".step" + index).removeClass("completed");
    }
    // on met la classe completed jusqu'au step inclus
    for (let index = 1; index <= step; index++) {
      $(".step" + index).addClass("completed");
    }

    // sur la page 4 ca change le texte du button suivant
    if (step == "4") {
      $("#nextStepTo").html("Soumettre");
    } else {
      $("#nextStepTo").html("Suivant");
    }
  }

  // sur clique du step
  $(".step-icon").on("click", function () {
    helpers.step = $(this).data("steptop");
    stepper(helpers.step);
  });

  // pour afficher les pages suivantes
  $("#nextStepTo").on("click", function (e) {
    e.preventDefault();

    if (helpers.step !== undefined) {
      helpers.step++;
      stepper(helpers.step);
    } else {
      stepper(2);
    }

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
