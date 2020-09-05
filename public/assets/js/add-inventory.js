$(document).ready(function () {
    let discountContainer = $('#discounts-container');
    let discountTypes = $('#discounts-container input[name="discountType"]');
    $('#discount-checkbox').change(function () {
        if ($(this).is(':checked')) {
            discountContainer.show('slow');
        } else {
            discountContainer.hide('slow');
            discountContainer.find('.form-row.discount').each(function (i, item) {
                $(this).html('');
            });
        }
    });

    //limit discount amount
    discountTypes.change(function () {
        let discountRates = $('#discounts-container input[name="discountAmount[]"]');
        if ($(this).is(':checked') && $(this).attr('id') === "amount") {
            discountRates.each(function (i, item) {
                $(this).attr('max', '');
            });
        } else {
            discountRates.each(function (i, item) {
                $(this).attr('max', 100);
            });
        }
    });

    //add discounts
    $('#addDiscountBtn').click(function () {
        discountContainer.append(discountItem());
    });

    function discountItem() {
        let max = "";
        discountTypes.each(function () {
            if ($(this).is(':checked') && $(this).attr('id') === "percent") {
                max = 'max="100"';
            }
        });
        return '<div class="form-row discount mb-2">\n' +
            '       <div class="col-4">\n' +
            '           <input class="form-control form-control-sm" type="number" name="discountQuantity[]"\n' +
            '           placeholder="quantity >" min="0" step="0.01" required>\n' +
            '           </div>\n' +
            '           <div class="col-6">\n' +
            '              <input class="form-control form-control-sm" type="number" name="discountAmount[]"\n' +
            '                 placeholder="discount amount" min="1" step="0.01" ' + max + ' required>\n' +
            '           </div>\n' +
            '           <div class="col">\n' +
            '               <span class="close" style="cursor: pointer;color: red;" title="delete">\n' +
            '               <i class="icon ion-close-round"></i>\n' +
            '               </span>\n' +
            '           </div>\n' +
            '  </div>';
    }

    //delete discount
    $(document).on('click', '#discounts-container .form-row .close', function () {
        $(this).parents('.form-row').html('');
    });

    //check profit
    $('#sellingPrice').keyup(function () {
        let price = $(this).val();
        let qty = $('#quantity').val();
        let cost = $('#cost').val();
        let profit = Math.floor(price - (cost / qty));
        if (isNaN(qty) || isNaN(cost)) return;
        if (profit >= 0) {
            $('#profit').text(profit + '/=').removeClass('text-danger').addClass('value');
        } else {
            $('#profit').text(profit + '/=').removeClass('value').addClass('text-danger');
        }
    });
});
