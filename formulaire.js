$(document).ready(function () {
  let person = { 
  };

  $("#nextStepTo").on("click", function (e) {

    e.preventDefault();
    
    let step = $(this).data("step");
    $("#section"+step).hide();
    step++;
    $("#section"+step).show();
    $(this).data("step", step);

    return false;

  });
});
