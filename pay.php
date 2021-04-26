<?php
session_start();
/* use Razorpay\Api\Api;
$api_key = "rzp_test_LpPon7FfcU6SjR";
$api_secret = "3bkx4WRExK8xkG0EYuc5vrXo";
$api = new Api($api_key, $api_secret);

$order = $api->order->create(array(
  'receipt' => $_SESSION['order_id'],
  'amount' => $_SESSION['amount'],
  'currency' => 'INR'
  )
); */

?>
<form method="post" hidden>
    <table>
        <tr>
            <td><b>Mandatory Parameters</b></td>
        </tr>
        <tr>
            <td>Amount:</td>
            <td><input readonly  id="amount" name="amount" value="<?php if (isset($_SESSION['amount'])) {
                    echo $_SESSION['amount'];
                } ?>"/></td>
            <td>Name:</td>
            <td><input readonly name="firstname" id="firstname" value="<?php if (isset($_SESSION['name'])) {
                    echo $_SESSION['name'];
                } ?>"/></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input readonly name="email" id="email" value="<?php if (isset($_SESSION['email'])) {
                    echo $_SESSION['email'];
                } ?>"/></td>
            <td>Phone:</td>
            <td><input id="phone" readonly name="phone" value="<?php if (isset($_SESSION['mobile'])) {
                    echo $_SESSION['mobile'];
                } ?>"/></td>
        </tr>
        <tr>
            <td>Order Id:</td>
            <td colspan="3"><textarea id="orderid" readonly name="productinfo"><?php if (isset($_SESSION['order_id'])) {
                        echo $_SESSION['order_id'];
                    } ?></textarea></td>
        </tr>
        <tr>

            <td colspan="4"><input id="btn" type="button" value="pay now" onclick="pay_now()"/></td>
        </tr>
    </table>

</form>
<!--<button id="btn" onclick="pay_now()" value="pay now">Pay</button>-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
window.onload=function(){
$("#btn").click();
}
</script>
<script>
    function pay_now() {
        var name = jQuery('#firstname').val();
        var amount = jQuery('#amount').val();
        var email = jQuery('#email').val();
        var phone = jQuery('#phone').val();

        var options = {
            "key": "rzp_test_LpPon7FfcU6SjR",
            "amount": amount * 100,
            "currency": "INR",
            "name": "Mulgandha",
            "description": "Test Transaction",
            "image": "https://mulgandha.in/images/home/logo.png",
            "prefill": {
                "name": name,
                "email": email,
                "contact": phone
            },
            "theme": {
                "color": "#f05050"
            },
            "handler": function (response) {
                jQuery.ajax({
                    type: 'post',
                    url: 'payment_process.php',
                    data: "payment_id=" + response.razorpay_payment_id,
                    success: function (result) {
                        window.location.href = "success.php";
                    }
                });
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    }
</script>