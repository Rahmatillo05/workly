$(function () {
    let product_id = $('#order-product_id');
    let form = $("#sell-form");
    let action = form.attr("action");
    let minPrice = $('#mix-price');
    let sell_price = $('#order-sell_price');
    let amount = $('#order-sell_amount');
    let allSum = $('#all_summ');
    let button = $("#order-button");
    product_id.on("change", function (e) {
        getPrice($(this).val());
    });
    amount.on("keyup", function () {
        allSum.val(minPrice.val() * $(this).val());
    });

    sell_price.on("keyup", function () {
        if (parseFloat($(this).val()) < parseFloat(allSum.val())) {
            button.addClass('disabled');
        } else {
            button.removeClass('disabled');
        }
    });


    function getPrice(product_id) {
        $.post(
            action,
            {product_id: product_id},
            function (data, textStatus, jqXHR) {
                minPrice.val(data.discount);
                $("#discount").text("Discount: " + data.discount_per + " %");
                // console.log(data)
            },
            "json"
        );
    }
});