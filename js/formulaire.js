$(document).ready(function () {
  let person = {};
  let helpers = {
    stepHistory: 1,
    step: 1,
  };

  // fonction pour le stepper d'en haut
  function stepper(step) {
    helpers.step = step;

    // pour empecher d'avancer trop sur les etapes sans passer le suivant
    if (helpers.stepHistory < step) {
      helpers.stepHistory = step;

      if ($(".section" + helpers.stepHistory).is(":empty")) {
        $("#nextStepTo").addClass("disabled");
        $.ajax({
          url: "ajax.php",
          method: "POST",
          dataType: "html",
          async: false,
          data: "action=getstep&stepHistory=" + helpers.stepHistory,
        })
          .done(function (response) {
            $(".section" + helpers.stepHistory).html(response);
          })
          .fail(function (error) {
            console.log(
              "La requête s'est terminée en échec. Infos : " +
                JSON.stringify(error)
            );
          })
          .always(function () {
            $("#nextStepTo").removeClass("disabled");
          });
      }
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

  $("#formulaire").validate({
    // debug: true,
    errorClass: "is-invalid",
    validClass: "is-valid",
    errorLabelContainer: "#errorBox",
    wrapper: "li",
    rules: {
      selectOccupation: "required",
      preciseStatus: {
        required: true,
        minlength: 2,
      },
      businessName: {
        required: true,
        minlength: 2,
      },
      businessActivity: {
        required: true,
        minlength: 2,
      },
      studentLevel: "required",
      jobTitle: {
        required: true,
        minlength: 2,
      },
      jobSearch: {
        required: true,
        minlength: 2,
      },
      selfOrNot: "required",
      selfPcUsageRate: "required",
      checkBoxTools: "required",
      softwares: "required",
      numberCollaborators: "required",
      notSelfUsagePc: "required",
      checkBoxWantToSelf: "required",
      checkboxWantToCollaborators: "required",
      domainWanted: "required",
      checkBoxProgramming: "required",
      checkBoxDatabase: "required",
      checkBoxSocial: "required",
      otherWish: {
        required: true,
        minlength: 2,
      },
      typeWish: "required",
      lastName: {
        required: true,
        minlength: 2,
      },
      firstName: {
        required: true,
        minlength: 2,
      },
      cityResidence: {
        required: true,
        minlength: 2,
      },
      countryResidence: {
        required: true,
        minlength: 2,
      },
      cityBusiness: {
        required: true,
        minlength: 2,
      },
      countryBusiness: {
        required: true,
        minlength: 2,
      },
      email: {
        required: true,
        minlength: 2,
        email: true,
      },
      phoneNumber: {
        required: true,
        minlength: 7,
      },
      rgpdCheck: "required",
    },
    messages: {
      selectOccupation: "Veuillez choisir un statut",
      preciseStatus: "Veuillez préciser votre statut",
      businessName: "Veuillez renseigner le nom de l'entreprise",
      businessActivity: "Veuillez renseigner l'activité de l'entreprise",
      studentLevel: "Veuillez choisir un niveau d'étude",
      jobTitle: "Veuillez renseigner le poste que vous occupez",
      jobSearch: "Veuillez renseigner le domaine dans lequel vous recherchez",
      selfOrNot: "Veuillez choisir pour qui est la demande",
      selfPcUsageRate:
        "Veuillez choisir un niveau d'usage personnel de l'ordinateur",
      checkBoxTools: "Veuillez sélectionner les outils que vous utilisez",
      softwares: "Veuillez cocher les outils que vous utilisez",
      numberCollaborators: "Veuillez renseigner le nombre de collaborateurs",
      notSelfUsagePc:
        "Veuillez choisir si ils utilisent l'ordinateur dans le cadre de leur travail",
      checkBoxWantToSelf: "Veuillez sélectionner ce que vous souhaitez",
      checkboxWantToCollaborators:
        "Veuillez sélectionner ce que vous souhaitez",
      domainWanted: "Veuillez cocher les domaines souhaitées",
      checkBoxProgramming: "Veuillez sélectionner les languages souhaités",
      checkBoxDatabase: "Veuillez sélectionner les bases de donées souhaitées",
      checkBoxSocial: "Veuillez sélectionner les réseaux souhaités",
      otherWish: "Veuillez renseigner quelle autre demande",
      typeWish: "Veuillez choisir le type de formation souhaitée",
      lastName: "Veuillez renseigner votre nom",
      firstName: "Veuillez renseigner votre prénom",
      cityResidence: "Veuillez renseigner votre ville de résidence",
      countryResidence: "Veuillez renseigner votre pays de résidence",
      cityBusiness: "Veuillez renseigner la ville de vos locaux",
      countryBusiness: "Veuillez renseigner le pays de vos locaux",
      email: "Veuillez renseigner votre email",
      phoneNumber: "Veuillez renseigner votre numéro de téléphone",
      rgpdCheck: "Veuillez accepter les conditions",
    },
    submitHandler: function (form) {
      if (!(helpers.step == 4)) {
        if (helpers.step == 1) {
          // recuperer si la demande le concerne ou ses collaborateurs IL SERAIT PEUT ETRE MIEUX DE FAIRE UNE FONCTION?
          if ($(".selfOrNot option:selected").val() == "0") {
            // default
            person.selfOrNot = 1;
          } else {
            person.selfOrNot = $(".selfOrNot option:selected").val();
          }
        }

        // pour afficher cacher les pages sur le button suivant
        if (helpers.step !== undefined) {
          helpers.step++;
          stepper(helpers.step);
        } else {
          stepper(2);
        }

        formBackToTop();
      } else {
        let inputData = $("form").serialize();

        if (!inputData.includes("selfOrNot")) {
          inputData = inputData + "&selfOrNot=" + person.selfOrNot;
        }

        $.ajax({
          url: "ajax.php",
          method: "POST",
          dataType: "json",
          data: "action=validform&" + inputData,
        })
          .done(function (response) {
            console.log(response);

            if (response.status == 1) {
              $("#formulaire").replaceWith(response.html);
            } else {
              for (let key in response.errors) {
                $("#errorBox")
                  .append(
                    "<li ><label id='" +
                      key +
                      "-error' class='is-invalid' for='" +
                      key +
                      "' style></label>" +
                      response.errors[key] +
                      "</li>"
                  )
                  .show();
              }
            }

            return false;
          })
          .fail(function (error) {
            console.log(JSON.stringify(error));
          })
          .always(function () {
            // $("#nextStepTo").removeClass("disabled");
          });
      }

      // sur la page 4 on change le texte du boutton par "soumettre", la remise à suivant se fait dans le click du stepper d'en haut
      if (helpers.step == 4) {
        $("#nextStepText").text("Soumettre");
      }

      return false; /* required to block normal submit since you used ajax */
    },
    invalidHandler: function (event, validator) {
      formBackToTop();

      // pour tous les boutons group si invalid passe en rouge, le vert se fait dans le script de chaque section
      $(".btn-outline-primary:visible")
        .removeClass("btn-outline-primary")
        .addClass("btn-outline-danger");

      if (!$(".checkClassic:checked:visible").length) {
        $(".checkClassic:visible").addClass("is-invalid");
      }

      // pour le type formation, on change la variable css pour faciliter le changement de couleurs
      if (
        !$(".radio-button").is(":checked") &&
        $(".radio-button").is(":visible")
      ) {
        $("body").get(0).style.setProperty("--radioTile-color", "#dc3545");
      }
    },
  });

  function formBackToTop() {
    var hauteur = $("#errorBox").offset().top - 30;
    $("html, body").animate({ scrollTop: hauteur }, 10);
  }

  // sur clique du step
  $(".step-icon").on("click", function (e) {
    e.preventDefault();

    // on cache toutes les erreurs
    $("#errorBox").children().hide();

    // si on clique sur plus petit que step actuel, on change de page, sinon on ne change pas de page
    if ($(this).data("steptop") <= helpers.step) {
      stepper($(this).data("steptop"));
    }

    // on change le texte par suivant sur clique du stepper, sauf sur clique de section 4
    if (!($(this).data("steptop") == 4)) {
      $("#nextStepText").text("Suivant");
    }

    return false;
  });

  // SECTION 1
  // pour afficher les bons inputs sur le premier select
  $(".selectOccupation").on("change", function () {
    $("#errorBox").children().hide();
    person.selected = $(".selectOccupation option:selected").val();
    for (let index = 1; index <= 8; index++) {
      $(".optionStatus" + index).hide();
    }

    if (
      person.selected == 2 ||
      person.selected == 3 ||
      person.selected == 4 ||
      person.selected == 6
    ) {
      $(".optionStatus8").show();
    }
    $(".optionStatus" + person.selected).show();
  });
});
