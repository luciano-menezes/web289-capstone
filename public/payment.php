<?php
require_once('../private/initialize.php');

if (isset($_POST['order_pay_btn'])) {
  $order_total_price = h($_POST['order_total_price']);
}
?>

<?php
$page_title = 'Payment';
include(SHARED_PATH . '/header.php');
?>

<!--Payment-->
<main role="main" id="main-content" tabindex="-1">
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h1 class="form-weight-bold">Payment</h1>
      <hr class="mx-auto">
    </div>
    <div class="mx-auto container text-center">

      <?php if (isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
        <?php $amount = strval($_SESSION['total']); ?>
        <p>Total payment: $<?php echo h($_SESSION['total']); ?></p>
        <!-- <input class="btn btn-primary" type="submit" value="Pay Now"> -->
        <!-- Set up a container element for the button -->
        <div id="paypal-button-container"></div>
      <?php  } else { ?>

        <p>Your cart is empty!</p>

      <?php } ?>

    </div>
  </section>
</main>
<!----- Code from PayPal's website ------>

<!-- Sample PayPal credentials (client-id) are included -->
<script src="https://www.paypal.com/sdk/js?client-id=AbAiodno3Df0bwdw-owa_xToHmoNEFluEHM2e9UaYdYnrf6HCjQ08xur0KtQSc5qZFzfaOY2rkVi3hf2&currency=USD&intent=capture" data-sdk-integration-source="integrationbuilder"></script>

<script>
  const fundingSources = [
    paypal.FUNDING.PAYPAL
  ]

  for (const fundingSource of fundingSources) {
    const paypalButtonsComponent = paypal.Buttons({
      fundingSource: fundingSource,

      // optional styling for buttons
      // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
      style: {
        shape: 'rect',
        height: 40,
      },

      // set up the transaction
      createOrder: (data, actions) => {
        // pass in any options from the v2 orders create call:
        // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
        const createOrderPayload = {
          purchase_units: [{
            amount: {
              value: '<?php echo $amount; ?>',
            },
          }, ],
        }

        return actions.order.create(createOrderPayload)
      },

      // finalize the transaction
      onApprove: (data, actions) => {
        const captureOrderHandler = (details) => {
          const payerName = details.payer.name.given_name
          console.log('Transaction completed!')

          // clear cart session
          <?php unset($_SESSION['cart']); ?>

          // update session variable
          <?php $_SESSION['quantity'] = 0; ?>

          // redirect to account page after payment and display message
          window.location.href = "account.php?payment=success";
        }

        return actions.order.capture().then(captureOrderHandler)

        window.onload = function() {
          if (window.location.href.indexOf("account.php") > -1) {
            document.getElementById("message").innerHTML = "Payment successful";
          }
        }
      },

      // handle unrecoverable errors
      onError: (err) => {
        console.error(
          'An error prevented the buyer from checking out with PayPal',
        )
      },
    })

    if (paypalButtonsComponent.isEligible()) {
      paypalButtonsComponent
        .render('#paypal-button-container')
        .catch((err) => {
          console.error('PayPal Buttons failed to render')
        })
    } else {
      console.log('The funding source is ineligible')
    }
  }
</script>

<!--Footer-->
<?php
include(SHARED_PATH . '/footer.php');
?>