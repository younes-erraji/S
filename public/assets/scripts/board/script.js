$(function () {
  $(".show-dashboard").on("click", function () {
    $(".dashboard").animate({ left: "0" }, 200);
    $("body").css("overflow", "hidden");
  });
  $(".x").on("click", function () {
    $(".dashboard").animate({ left: "-100vw" }, 200);
    $("body").css("overflow", "visible");
  });
  $(".dashboard ul li a.list").on("click", function () {
    let el = $(`.${$(this).data("list")}`);
    if ($(`.${$(this).data("list")}.sublinks`).css("display") === "none") {
      el.slideDown(200);
    } else {
      el.slideUp(200);
    }
  });
});
