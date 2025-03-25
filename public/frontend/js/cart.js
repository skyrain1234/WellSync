// 購物車測試

function addToCart(productId, qty) {
    $.post('/guest-cart/add', { product_id: productId, qty: qty }, function(response) {
        alert(response.message);
    });
}


function getCart() {
    $.get('/guest-cart', function(response) {
        console.log(response);
    });
}


function updateCartItem(productId, qty) {
    $.post('/guest-cart/update', { product_id: productId, quantity: qty }, function(response) {
        alert(response.message);
    });
}


function removeCartItem(productId) {
    $.ajax({
        url: `/guest-cart/remove/${productId}`,
        type: 'DELETE',
        success: function(response) {
            alert(response.message);
        }
    });
}


function clearCart() {
    $.ajax({
        url: '/guest-cart/clear',
        type: 'DELETE',
        success: function(response) {
            alert(response.message);
        }
    });
}
