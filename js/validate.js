$(document).ready(function () {
  $("#formulaire").validate({
    debug: true,
    errorClass: "is-invalid",
    validClass: "is-valid",
    // errorElement: "span",
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
      bussinesActivity: {
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
      },
      phoneNumber: {
        required: true,
        minlength: 2,
      },
      rgpdCheck: "required",
    },
    messages: {
      selectOccupation: "Veuillez choisir un statut",
      preciseStatus: "Veuillez préciser votre statut",
      businessName: "Veuillez renseigner le nom de l'entreprise",
      bussinesActivity: "Veuillez renseigner l'activité de l'entreprise",
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
      email: "Veuillez renseigner email",
      phoneNumber: "Veuillez renseigner numéro de téléphone",
      rgpdCheck: "Veuillez accepter les conditions",
    },
    submitHandler: function (form) {
      console.log("3");
      return false; /* required to block normal submit since you used ajax */
    },
  });
});
