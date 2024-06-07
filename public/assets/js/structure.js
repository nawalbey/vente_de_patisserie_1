var urlPanier = window.location.origin + "/vente_de_patisserie_1/panier/addToCart";
var urlPanierQuantite =
window.location.origin + "/vente_de_patisserie_1/panier/quantity";
//attend que la page soit chager.
document.addEventListener("DOMContentLoaded", function ()
 {
  //c'est la dans que il y a la requete ajax. Quand tu clique sur ajouter au panier il va executer tout ce que il y a dedans.
  $(".addToCartBtn").on("click", function (event) {
     //event.preventDefault() est une méthode JavaScript utilisée pour empêcher le comportement par défaut d'un événement.
// Lorsque vous cliquez sur un lien hypertexte ou soumettez un formulaire, par exemple, le navigateur effectue une action par défaut correspondante, comme suivre le lien ou soumettre le formulaire. Parfois, vous souhaitez annuler ce comportement par défaut et prendre une action différente en réponse à l'événement.
// Pour cela, vous pouvez utiliser event.preventDefault() dans le gestionnaire d'événements. Par exemple, si vous avez un formulaire et que vous souhaitez vérifier les données avant de les soumettre, vous pouvez utiliser event.preventDefault() pour empêcher le formulaire de se soumettre immédiatement après le clic sur le bouton de soumission. Vous pouvez ensuite effectuer votre propre logique de validation des données et, si nécessaire, soumettre le formulaire programmation.
    event.preventDefault();
    var form = $(this).closest(".add-to-cart-form");
    // serialize il transforme en chaine de caractere.
    var formData = form.serialize();
    console.log(formData);
    $.ajax({
      // requete http de methode post ( on peux aussi utiliser la methode Get).
      type: "POST",
      // url nous dirige vers la methode addtocart dans le controller panier (classe) afin de traiter les donnees que on va envoier vers cette methode.
      url: urlPanier,
      //les donnees du formulaire du fichier home.html.php (ligne 23)
      data: formData,
      dataType: "json",
      success: function (response) {
        try {
          //j'ai cree un element html dans nav je lui est attribut un id "nbArticles" le nombre des produits dans le panier(session) sera a jour a chaque fois que j'ajoute un produit dans le panier il sera affciher dans cet element html(span).
          $("#nbArticles").text(response.nombre);
        } catch (error) {
          console.error("Erreur lors de la conversion JSON :", error);
        }
      },
      error: function (xhr) {


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
    error: function (xhr, status) {
      console.log("Erreur AJAX:");
      console.log("Status: " + status);
      console.log("Réponse du serveur:");
      console.log(xhr.responseText);
      // console.log("Erreur: " + error);
    },
  });
}
