import "./lib/bootstrap.bundle.min.js";

(function ($) {
  $(".search__input").keyup(function () {
    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      type: "GET",
      data: { action: "search_products", keyword: jQuery("#keyword").val() },
      success: function (data) {
        jQuery(".search__dropdown__items").html(data);
      },
    });

    if ($("#keyword").val().length >= 2) {
      $(".header-navigation__search").addClass("focused");
    } else if ($("#keyword").val().length == 0) {
      $(".header-navigation__search").removeClass("focused");
    }
  });
})(jQuery);
