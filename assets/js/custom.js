var page = window.location.href;
page = page.split("/")[3];

function ajaxAddCart(id, result) {
  $.ajax({
    url: "models/addToCart.php",
    method: "POST",
    data: {
      product: id,
      quantity: $("#quantity").val() ?? 1,
    },
    success: result,
    error: function (xhr) {
      console.error(xhr);
    },
  });
}

if (page.indexOf("index.php?page=shop") > -1) {
  var lastPage = 1;
  function filterProducts(result) {
    let selectedCategories = $(".category:checked")
      .map(function () {
        return $(this).data("id");
      })
      .get();

    let selectedBrands = $(".brand:checked")
      .map(function () {
        return $(this).data("id");
      })
      .get();

    let search = $("#search").val();

    let sort = $("#sort").val();

    let page = lastPage;

    $.ajax({
      url: "models/filterProducts.php",
      method: "post",
      data: {
        categories: selectedCategories,
        brands: selectedBrands,
        search: search,
        sort: sort,
        page: page,
      },
      dataType: "json",
      success: result,
      error: function (xhr) {
        console.error(xhr);
      },
    });
  }
  $(document).on("change", ".brand", function () {
    filterProducts(function (products) {
      displayProducts(products);
      displayPagination(products);
    });
  });
  $(document).on("change", ".category", function () {
    filterProducts(function (products) {
      displayProducts(products);
      displayPagination(products);
    });
  });
  $(document).on("keyup", "#search", function () {
    filterProducts(function (products) {
      displayProducts(products);
      displayPagination(products);
    });
  });
  $(document).on("change", "#sort", function () {
    filterProducts(function (products) {
      displayProducts(products);
      displayPagination(products);
    });
  });
  $(document).on("click", ".page-link", function () {
    lastPage = $(this).data("id");
    filterProducts(function (products) {
      displayProducts(products);
      displayPagination(products);
    });
  });
  $(document).on("click", ".add-cart", function (e) {
    e.preventDefault();
    let id = $(this).data("id");
    ajaxAddCart(id, function (result) {
      console.log("Quantity ", result);
    });
  });
  function processPrice(p) {
    html = "";
    if (p.sale) {
      html = `<h6>$
            ${p.sale}
        </h6>
        <h6 class="text-muted ml-2"><del>$
                 ${p.price} 
            </del></h6>`;
    } else {
      html = `<h6>$
            ${p.price} 
       </h6>`;
    }
    return html;
  }
  function displayProducts(products) {
    let html = "";
    if (products.length) {
      for (const p of products) {
        html += `<div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div
                        class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid" src="assets/img/shop/${
                          p.path
                        }" alt=" ${p.product_name} ">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">
                        ${p.product_name}
                        </h6>
                        <div class="d-flex justify-content-center">
                            
                          ${processPrice(p)}
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="index.php?page=product&id=${p.product_id}"
                            class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                            Detail</a>
                        <?php if (isLogged()): ?>
                            <a href="" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        `;
      }
    } else {
      html =
        '<h3 class="text-center mt-5">Oops. Seems like none of our products match your criteria.</h3>';
    }
    $("#products").html(html);
  }
  function displayPagination(products) {
    let html = "";
    let paginationNum = Math.ceil(products.length / 9);
    console.log(products.length);

    if (paginationNum) {
      for (let i = 1; i <= paginationNum; i++) {
        html += `<li class="page-item"><a class="page-link" href="#" data-id="${i}">${i}</a></li>`;
      }
    }
    $(".pagination").html(html);
  }
}

if (page.indexOf("index.php?page=product") > -1) {
  $(document).on("click", ".add-cart", function (e) {
    e.preventDefault();
    let id = $(this).data("id");
    ajaxAddCart(id, function (result) {
      console.log("Quantity ", result);
    });
  });
}

if (page.indexOf("index.php?page=cart") > -1) {
    function removeFromCart(id, result) {
      $.ajax({
        url: "models/removeFromCart.php",
        method: "POST",
        data: {
          product: id,
        },
        dataType: "json",
        success: function(response){
            console.log("ajax", response);
            result(response)
        },
        error: function (xhr) {
          console.error(xhr);
        },
      });
    }
  
    function cartPrice(p) {
      return p.sale ? p.sale : p.price;
    }
  
    function displayCart(products) {
      let html = "";
      if (products.length) {
        for (const p of products) {
          let totalPrice = cartPrice(p) * p.quantity;
          html += `<tr>
              <td class="align-middle"><img src="assets/img/shop/${p.path}" alt="${p.product_name}" style="width: 50px;">${p.product_name}</td>
              <td class="align-middle">$${cartPrice(p)}</td>
              <td class="align-middle">
                  <div class="input-group quantity mx-auto" style="width: 100px;">
                      <div class="input-group-btn">
                          <button class="btn btn-sm btn-primary btn-minus">
                          <i class="fa fa-minus"></i>
                          </button>
                      </div>
                      <input type="text" class="form-control form-control-sm bg-secondary text-center" value="${p.quantity}">
                      <div class="input-group-btn">
                          <button class="btn btn-sm btn-primary btn-plus">
                              <i class="fa fa-plus"></i>
                          </button>
                      </div>
                  </div>
              </td>
              <td class="align-middle">$${totalPrice}</td>
              <td class="align-middle"><button class="btn btn-sm btn-primary remove-cart" data-id="${p.product_id}"><i class="fa fa-times"></i></button></td>
          </tr>`;
          $("#cart-items").html(html);
        }
      } else {
        html += "<h2 class='mx-auto'>Your cart is empty.</h2>";
        $("#cart-block").addClass("d-none");
        $("#no-cart").html(html);
      }
      
    }
  
    $(document).on("click", ".remove-cart", function () {
      let id = $(this).data("id");
      removeFromCart(id, function (result) {
        displayCart(result);
      });
    });
  }
  
