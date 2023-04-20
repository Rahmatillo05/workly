$(function () {
    let product_id = $('#order-product_id');
    let form = $("#sell-form");
    let action = form.attr("action");
    const discount_percent = $('#discount_percent');
    const each_price = $('#each_price');
    const discount_price = $('#discount_price');
    const amount = $("#order-amount");
    const order_sell_price = $('#order-sell_price');
    const order_discount_price = $('#order-discount_price');

    product_id.on("change", function () {
        getPrice($(this).val());
    });
    amount.on("keyup", function () {
        order_sell_price.val(each_price.val() * $(this).val());
        order_discount_price.val(discount_price.val() * $(this).val());
    });

    function getPrice(product_id) {
        $.post(
            action,
            {product_id: product_id},
            function (data, textStatus, jqXHR) {
                each_price.val(data.sell_price);
                discount_price.val(data.discount);
                discount_percent.text("Discount: " + data.discount_per + " %")
            },
            "json"
        );
    }


    const settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://type.fit/api/quotes",
        "method": "GET"
    }
    const motivText = $('#motiv-text');
    const motivAuthor = $('#motiv-author');
    let random = parseInt(Math.random() * 1000);

    $.ajax(settings).done(function (response) {
        const data = JSON.parse(response);
        motivText.text(data[random].text)
        motivAuthor.text(data[random].author);
    });
});