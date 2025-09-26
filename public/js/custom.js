
//ページトップに戻る
$(function() {
	var topBtn = $('.top_btn');
	topBtn.hide();
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			topBtn.fadeIn();
		} else {
			topBtn.fadeOut();
		}
	});
    topBtn.click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		return false;
    });
});
//カレント設定
$(function() {
	var id = $("body").attr("id");
	$("li." + id).addClass("active");
});

$(document).ready(function () {
	$('.drawer').drawer();
});

//CALCULATES TOTAL FROM PRICE*QUANTITY IN TOBUY ITEM
document.addEventListener("DOMContentLoaded", function () {
    const quantityInput = document.getElementById("quantity");
    const priceInput = document.getElementById("price");
    const totalInput = document.getElementById("total");

    // Store original DB total
    const dbTotal = parseFloat(totalInput.value) || 0;

    function calculateTotal() {
        const quantity = parseFloat(quantityInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;
        const total = quantity * price;

        // Only override DB total if user changed qty or price
        if (quantity > 0 && price > 0) {
            totalInput.value = total.toFixed(2);
        } else {
            totalInput.value = dbTotal.toFixed(2);
        }
    }

    quantityInput.addEventListener("input", calculateTotal);
    priceInput.addEventListener("input", calculateTotal);

    // On load: show DB total (don’t auto-calc)
    totalInput.value = dbTotal.toFixed(2);
});


//CART DETAILS HIDE / SHOW
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".toggle").forEach(btn => {
  btn.addEventListener("click", () => {
    const cartItem = btn.closest(".cart-item");   // always find the parent wrapper
    const details = cartItem.querySelector(".cart-details");
    details.hidden = !details.hidden;
    btn.textContent = details.hidden ? "+" : "–";
  });
});
});
