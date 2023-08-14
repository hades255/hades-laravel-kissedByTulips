// console.log(stripe_key);
var stripe = Stripe('pk_test_51F1hD0CPDNJaogsD6OwQprE9hHb0vAoEhE9mwEBMjUdRfwiJrNrTt3XL2m6xgKNSJqegtOiG7S4EAfQeOsjmYOqp00zpbL4lVH');
var elements = stripe.elements();
var errors;
// Create an instance of the card Element.
var card = elements.create('card', {hidePostalCode: true});
// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
card.addEventListener('change', function (event) {
    if (event.error) {
        notificationAlert('error', event.error.message);
    }
});
// Create a token or display an error when the form is submitted.

// if (document.getElementById('payment-form')) {
    // var form = document.getElementById('payment-form');
    // var new_subscription = document.getElementById('new_subscription');
    /*form.addEventListener('submit', function (event) {
        event.preventDefault();
        errors = validateFields('payment-form');
        var send_call = true;
        if (errors.length > 0 || (!$("#terms").is(":checked") && new_subscription.value !== "0")) {
            errors[errors.length] = 'Please accept terms of services.';
            showErrors(errors);
            send_call = false;
        }
        if (send_call) {
            // checking user selected payment method
            // var payment_method = $("input[name='payment_method']:checked").val();
            // if (payment_method && payment_method == 'stripe') {
            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    // Inform the customer that there was an error.
                    // var errorElement = document.getElementById('card-errors');
                    notificationAlert('error', result.error.message);
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
            // } else {
            //     var form = document.getElementById('payment-form');
            //     form.submit();
            // }
        }
    });*/
// }

if (document.getElementById('create-form')) {
    var create_form = document.getElementById('create-form');
    create_form.addEventListener('submit', function (event) {
        event.preventDefault();
        errors = validateFields('create-form');
        var send_call = true;

        if (send_call) {
            // checking user selected payment method
            // var payment_method = $("input[name='payment_method']:checked").val();
            // if (payment_method && payment_method == 'stripe') {
            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    // Inform the customer that there was an error.
                    // var errorElement = document.getElementById('card-errors');
                    notificationAlert('error', result.error.message);
                } else {
                    // Send the token to your server.
                    createStripeTokenHandler(result.token, 'create-form');
                }
            });
            /*} else {
                var form = document.getElementById('payment-form');
                form.submit();
            }*/
        }
    });
}

if (document.getElementById('update_credit_card_form')) {
    var form_id = 'update_credit_card_form';
    var update_credit_card_form = document.getElementById(form_id);

    update_credit_card_form.addEventListener('submit', function (event) {
        event.preventDefault();
        errors = validateFields(form_id);

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                // Inform the customer that there was an error.
                // var errorElement = document.getElementById('card-errors');
                notificationAlert('error', result.error.message);
            } else {
                $(".main_loader").show();

                if ($("#update_card").length) {
                    $("#update_card").html('Updating...');
                }
                // Send the token to your server.
                createStripeTokenHandler(result.token, form_id);
            }
        });
    });
}

function createStripeTokenHandler(token, form_id) {

    // Insert the token ID into the form so it gets submitted to the server
    var create_form = document.getElementById(form_id);
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    create_form.appendChild(hiddenInput);
    // Submit the form
    $(".main_loader").show();

    create_form.submit();
}

function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
    // Submit the form
    form.submit();
}
