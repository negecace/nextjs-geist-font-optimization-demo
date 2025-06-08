<?php
require_once 'inc/header.php';
require_once 'config.php';

session_start();

// Check if this is a registration payment or logged-in user payment
$is_registration = isset($_GET['type']) && $_GET['type'] === 'registration';

if (!$is_registration && !isset($_SESSION['student_id'])) {
    header('Location: login.php');
    exit;
}

if ($is_registration && !isset($_SESSION['registration'])) {
    header('Location: register.php');
    exit;
}

// Get payment options based on context
$payment_options = $is_registration ? [
    [
        'id' => 'registration',
        'name' => 'Registration Fee',
        'amount' => 50.00,
        'description' => 'One-time registration fee'
    ]
] : [
    [
        'id' => 'registration',
        'name' => 'Registration Fee',
        'amount' => 50.00,
        'description' => 'One-time registration fee'
    ],
    [
        'id' => 'monthly',
        'name' => 'Monthly Lesson Fee',
        'amount' => 200.00,
        'description' => 'Monthly piano lesson fee'
    ],
    [
        'id' => 'private',
        'name' => 'Private Lesson',
        'amount' => 75.00,
        'description' => 'Single private lesson (1 hour)'
    ]
];
?>

<section style="padding: 4rem 0; background: #fafafa;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h1 style="text-align: center; margin-bottom: 3rem;">Make a Payment</h1>

        <!-- Payment Options -->
        <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
            <h2 style="margin-bottom: 1.5rem;">Select Payment Option</h2>

            <form id="payment-form">
                <div style="margin-bottom: 2rem;">
                    <?php foreach ($payment_options as $option): ?>
                    <div style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #ddd; border-radius: 4px; cursor: pointer;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="radio" name="payment_option" value="<?php echo $option['id']; ?>" 
                                   style="margin-right: 1rem;" required>
                            <div>
                                <div style="font-weight: 500;"><?php echo htmlspecialchars($option['name']); ?></div>
                                <div style="color: #666; font-size: 0.9rem;"><?php echo htmlspecialchars($option['description']); ?></div>
                                <div style="font-weight: 500; color: #000; margin-top: 0.5rem;">
                                    $<?php echo number_format($option['amount'], 2); ?>
                                </div>
                            </div>
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Payment Method Selection -->
                <div style="margin-bottom: 2rem;">
                    <h3 style="margin-bottom: 1rem;">Select Payment Method</h3>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <!-- PayPal Option -->
                        <div style="padding: 1rem; border: 1px solid #ddd; border-radius: 4px; text-align: center; cursor: pointer;">
                            <label style="cursor: pointer;">
                                <input type="radio" name="payment_method" value="paypal" required style="margin-bottom: 0.5rem;">
                                <div style="font-weight: 500;">PayPal</div>
                                <div style="color: #666; font-size: 0.9rem;">Pay securely with PayPal</div>
                            </label>
                        </div>

                        <!-- Stripe Option -->
                        <div style="padding: 1rem; border: 1px solid #ddd; border-radius: 4px; text-align: center; cursor: pointer;">
                            <label style="cursor: pointer;">
                                <input type="radio" name="payment_method" value="stripe" required style="margin-bottom: 0.5rem;">
                                <div style="font-weight: 500;">Credit Card</div>
                                <div style="color: #666; font-size: 0.9rem;">Pay with credit/debit card</div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Stripe Card Element (hidden by default) -->
                <div id="stripe-element" style="display: none; margin-bottom: 2rem;">
                    <div id="card-element" style="padding: 1rem; border: 1px solid #ddd; border-radius: 4px;">
                        <!-- Stripe Card Element will be inserted here -->
                    </div>
                    <div id="card-errors" role="alert" style="color: #dc2626; margin-top: 0.5rem;"></div>
                </div>

                <!-- Submit Button -->
                <div style="text-align: center;">
                    <button type="submit" class="btn" style="background: #000; color: #fff; border: none; padding: 1rem 2rem; font-size: 1.1rem; cursor: pointer; min-width: 200px;">
                        Proceed to Payment
                    </button>
                </div>
            </form>
        </div>

        <!-- Payment Instructions -->
        <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 1rem;">Payment Instructions</h3>
            <ul style="list-style: none; padding: 0;">
                <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative;">
                    <span style="position: absolute; left: 0; top: 0;">•</span>
                    Select your desired payment option from the list above.
                </li>
                <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative;">
                    <span style="position: absolute; left: 0; top: 0;">•</span>
                    Choose your preferred payment method (PayPal or Credit Card).
                </li>
                <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative;">
                    <span style="position: absolute; left: 0; top: 0;">•</span>
                    Complete the payment process securely through our payment provider.
                </li>
                <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative;">
                    <span style="position: absolute; left: 0; top: 0;">•</span>
                    You will receive a confirmation email once your payment is processed.
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo PAYPAL_CLIENT_ID; ?>&currency=USD"></script>

<!-- Stripe SDK -->
<script src="https://js.stripe.com/v3/"></script>

<!-- Payment Processing JavaScript -->
<script>
// Initialize Stripe
const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');
const elements = stripe.elements();
const card = elements.create('card');

// Payment form handling
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('payment-form');
    const stripeElement = document.getElementById('stripe-element');
    
    // Handle payment method selection
    document.querySelectorAll('input[name="payment_method"]').forEach(input => {
        input.addEventListener('change', function() {
            stripeElement.style.display = this.value === 'stripe' ? 'block' : 'none';
            if (this.value === 'stripe') {
                card.mount('#card-element');
            } else {
                card.unmount();
            }
        });
    });

    // Handle form submission
    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        
        const paymentOption = document.querySelector('input[name="payment_option"]:checked').value;
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

        if (paymentMethod === 'stripe') {
            // Handle Stripe payment
            const {token, error} = await stripe.createToken(card);
            if (error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                // Send token to server
                // Implementation needed
            }
        } else {
            // Handle PayPal payment
            // Implementation needed
        }
    });
});
</script>

<?php require_once 'inc/footer.php'; ?>
