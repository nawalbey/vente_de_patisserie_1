var urlPanier =
  window.location.origin + "/vente_de_patisserie_1/panier/addToCart";
var urlPanierQuantite =
  window.location.origin + "/vente_de_patisserie_1/panier/quantity";
document.addEventListener("DOMContentLoaded", function () {
  $(".addToCartBtn").on("click", function (event) {
    event.preventDefault();
    var form = $(this).closest(".add-to-cart-form");
    var formData = form.serialize();
    $.ajax({
      type: "POST",
      url: urlPanier,
      data: formData + "&ajouterPanier=panier",
      dataType: "json",
      success: function (response) {
        try {
          console.log(typeof response);
          $("#nbArticles").text(response.nombre);
        } catch (error) {
          console.error("Erreur lors de la conversion JSON :", error);
        }
      },
      error: function (xhr, status, error) {
        console.log("Erreur AJAX:", error);
        console.log("Status:", status);
        console.log("Réponse du serveur:", xhr.responseText);

        // Affiche aussi les propriétés détaillées de l'objet xhr
        console.log("Statut de la requête (XHR):", xhr.status);
        console.log("Texte du statut de la requête (XHR):", xhr.statusText);

        // Si le serveur renvoie du JSON mal formé, affiche l'erreur JSON
        try {
          var jsonError = JSON.parse(xhr.responseText.trim());
          console.error("Erreur JSON du serveur:", jsonError);
        } catch (jsonParseError) {
          console.error("Erreur lors de la conversion JSON :", jsonParseError);
        }
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
    url: urlPanierQuantite,
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
      $("#nbArticles").text(response.totalQuantity);
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

// function setFooterBackground(className) {
//   $(document).ready(function () {
//     // Obtenez l'élément div principal
//     var mainDiv = $(className); // Utilisez le nom de la classe passé en paramètre

//     // Obtenez l'URL de l'image d'arrière-plan de la div principale
//     var bgImage = mainDiv.css("background-image");

//     // Obtenez l'élément footer
//     var footer = $("footer"); // Remplacez 'footer' par la classe ou l'ID de votre footer

//     if (bgImage == "none") {
//       bgImage = mainDiv.css("background-color");
//       footer.css("background-color", bgImage);
//     } else {
//       // Définissez l'image d'arrière-plan du footer pour qu'elle soit la même que celle de la div principale
//       footer.css("background-image", bgImage);
//     }
//   });
// }

// setFooterBackground(".class1");
// setFooterBackground(".class2");
// setFooterBackground(".body1");
// setFooterBackground(".class4");
// setFooterBackground(".class5");
// setFooterBackground(".class6");
