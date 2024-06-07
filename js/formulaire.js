$(document).ready(function () {
  let person = {};
  let helpers = {
    stepHistory: 1,
  };

  // fonction pour le stepper d'en haut
  function stepper(step) {
    helpers.step = step;

    // pour empecher d'avancer trop sur les etapes sans passer le suivant
    if (helpers.stepHistory < step) {
      helpers.stepHistory = step;
    }

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
    if (step == 4) {
      $("#nextStepToText").text("Soumettre");
    } else {
      $("#nextStepToText").text("Suivant");
    }

    // afficher les bons inputs sur les differens step/pages si c'est pour lui ou colaborateurs
    switch (step) {
      case 2:
        if (person.selfOrNot == "1") {
          $(".notSelf").hide();
          $(".self").show();
        } else {
          $(".self").hide();
          $(".notSelf").show();
        }
        break;

      case 3:
        if (person.selfOrNot == "1") {
          $(".notSelf2").parent().hide();
          $(".self2").parent().show();
        } else {
          $(".self2").parent().hide();
          $(".notSelf2").parent().show();
        }
        break;

      case 4:
        if (person.selfOrNot == "1") {
          $(".notSelf3").hide();
          $(".self3").show();
        } else {
          $(".self3").hide();
          $(".notSelf3").show();
        }
        break;
    }
  }

  // sur clique du step
  $(".step-icon").on("click", function (e) {
    e.preventDefault();
    // recuperer si la demande le concerne ou ses collaborateurs IL SERAIT PEUT ETRE MIEUX DE FAIRE UNE FONCTION?
    if ($(".selfOrNot option:selected").val() == "0") {
      // default
      person.selfOrNot = 1;
    } else {
      person.selfOrNot = $(".selfOrNot option:selected").val();
    }

    // naviguer avec le stepper que si on a validé
    if (helpers.stepHistory >= $(this).data("steptop")) {
      helpers.step = $(this).data("steptop");
      stepper(helpers.step);
    }

    return false;
  });

  // pour afficher cacher les pages sur le button suivant
  $("#nextStepTo").on("click", function (e) {
    e.preventDefault();

    // recuperer si la demande le concerne ou ses collaborateurs IL SERAIT PEUT ETRE MIEUX DE FAIRE UNE FONCTION?
    if ($(".selfOrNot option:selected").val() == "0") {
      // default
      person.selfOrNot = 1;
    } else {
      person.selfOrNot = $(".selfOrNot option:selected").val();
    }

    // pour afficher cacher les pages sur le button suivant
    if (helpers.step !== undefined) {
      helpers.step++;
      stepper(helpers.step);
    } else {
      stepper(2);
    }

    return false;
  });

  // SECTION 1
  // pour afficher les bons inputs sur le premier select
  $(".selectOccupation").on("change", function () {
    person.selected = $(".selectOccupation option:selected").val();
    for (let index = 1; index <= 7; index++) {
      $(".optionStatus" + index).hide();
    }
    if (person.selected == 3 || person.selected == 2) {
      $(".optionStatus4").show();
    }
    $(".optionStatus" + person.selected).show();
  });

  // SECTION 2

  // a ameliorer ?
  $("#checkBoxTools").on("click", function () {
    $("#checkBoxTools2").prop("checked", false);
    $("#checkBoxTools3").prop("checked", false);
    $("#checkBoxTools4").prop("checked", false);
  });

  $("#checkBoxTools2, #checkBoxTools3, #checkBoxTools4").on(
    "click",
    function () {
      $("#checkBoxTools").prop("checked", false);
    }
  );

  // SECTION 3

  // peut ameliorer? x4
  $("#checkProgrammationInformatique").on("change", function () {
    if ($("#checkProgrammationInformatique").is(":checked")) {
      $(".optionIfProgramming").show();
    } else {
      $(".optionIfProgramming").hide();
    }
  });

  $("#checkBdd").on("change", function () {
    if ($("#checkBdd").is(":checked")) {
      $(".optionIfDatabase").show();
    } else {
      $(".optionIfDatabase").hide();
    }
  });

  $("#checkReseauxSociaux").on("change", function () {
    if ($("#checkReseauxSociaux").is(":checked")) {
      $(".optionIfSocial").show();
    } else {
      $(".optionIfSocial").hide();
    }
  });

  $("#checkAutre").on("change", function () {
    console.log($("#checkAutre").is(":checked"));
    if ($("#checkAutre").is(":checked")) {
      $(".optionOtherOccupation").show();
    } else {
      $(".optionOtherOccupation").hide();
    }
  });

  // SECTION 4

  $(".radio-tile-group").on("change", function () {
    if ($("#yourLocal").is(":checked")) {
      $(".residential").hide();
      $(".notResidential").show();
    } else {
      $(".notResidential").hide();
      $(".residential").show();
    }
  });
});
