var urlPanier = window.location.origin + "/vente_de_patisserie_1/cart/show";
document.addEventListener("DOMContentLoaded", function () {
  $(".addToCartBtn").on("click", function (event) {
    event.preventDefault();
    var form = $(this).closest(".add-to-cart-form");
    var formData = form.serialize();
    console.log(formData);
    $.ajax({
      type: "POST",
      url: urlPanier,
      data: formData + "&ajouterPanier=panier",
      dataType: "json",
      success: function (response) {
        // response = JSON.parse(response);
        var reponse = JSON.parse(response);
        if (response) {
          $("#nbArticles").text(reponse.nombre);
        }
        // ... le reste du code
      },
      error: function (xhr, status, error) {
        console.log("Erreur AJAX:"+ error);
        console.log("Status: " + status);
        console.log("Réponse du serveur:");
        console.log(xhr.responseText);
        // console.log("Erreur: " + error);
      },
    });
  });
});

function increment_quantity(cart_id, price) {
  var uniquequentite = 1;
  var inputQuantityElement = $("#input-quantity-" + cart_id);
  var newQuantity = parseInt($(inputQuantityElement).text()) + 1;
  var newPrice = newQuantity * price;
  save_to_db(
    cart_id,
    newQuantity,
    newPrice,
    uniquequentite,
    price,
    "increment"
  );
}

function decrement_quantity(cart_id, price) {
  var uniquequentite = -1;
  var inputQuantityElement = $("#input-quantity-" + cart_id);
  if ($(inputQuantityElement).text() > 1) {
    var newQuantity = parseInt($(inputQuantityElement).text()) - 1;
    var newPrice = newQuantity * price;
    save_to_db(
      cart_id,
      newQuantity,
      newPrice,
      uniquequentite,
      price,
      "decrement"
    );
  }
}

function save_to_db(
  cart_id,
  new_quantity,
  newPrice,
  uniquequentite,
  uniqueprix,
  status
) {
  var inputQuantityElement = $("#input-quantity-" + cart_id);
  var priceElement = $("#cart-price-" + cart_id);
  // alert(new_quantity);
  $.ajax({
    url: "../model/achete.php",
    data:
      "checkId=" +
      cart_id +
      "&updateQuantite=" +
      new_quantity +
      "&newPrice=" +
      newPrice +
      "&uniquequentite=" +
      uniquequentite +
      "&quantityChange=" +
      uniqueprix +
      "&uniqueprix=" +
      true +
      "&status=" +
      status,
    type: "post",
    dataType: "json",
    success: function (response) {
      // alert(response.totalQuantity);
      $(inputQuantityElement).html(
        '<p class="card-text1"><i class="fa-solid fa-cookie-bite">' +
          new_quantity +
          "</i></p>"
      );
      $(priceElement).text("€" + newPrice);
      var totalQuantity = 0;
      $("div[id*='input-quantity-']").each(function () {
        var cart_quantity = $(this).val();
        totalQuantity = parseInt(totalQuantity) + parseInt(cart_quantity);
      });
      var totalItemPrice = 0;
      $("div[id*='cart-price-']").each(function () {
        var cart_price = $(this).text().replace("€", "");
        totalItemPrice = parseInt(totalItemPrice) + parseInt(cart_price);
      });

      // alert(response.totalQuantity);
      $("#nbArticles").text(response.totalQuantity);
      $("#total-price").text(response.totalPrice);
      $("#total-quantity").text(response.totalQuantity);
    },
    error: function (xhr, status, error) {
      console.log("Erreur AJAX:");
      console.log("Status: " + status);
      console.log("Réponse du serveur:");
      console.log(xhr.responseText);
      // console.log("Erreur: " + error);
    },
  });
}
