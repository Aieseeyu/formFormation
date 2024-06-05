$(document).ready(function () {
  let person = {};

  $("#selectOccupation").on("change", function () {
    person.selected = $("#selectOccupation option:selected").val();

    for (let index = 0; index <= 7; index++) {
      $("#option" + index).hide();
    }
    $("#option" + person.selected).show();
  });

  $("#nextStepTo").on("click", function (e) {
    e.preventDefault();

    let step = $(this).data("step");
    $("#section" + step).hide();
    step++;
    $("#section" + step).show();
    $(this).data("step", step);

    return false;
  });
});
