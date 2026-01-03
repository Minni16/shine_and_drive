# Khalti Personal Account vs Merchant Account

## The Difference

### Personal Khalti Account
- **Purpose:** For individual users to **make payments**
- **What you can do:** Pay for services, transfer money, top up
- **What you CANNOT do:** Accept payments on your website
- **No API access:** Personal accounts don't get API keys

### Merchant Account
- **Purpose:** For businesses/websites to **accept payments**
- **What you can do:** Accept payments from customers on your website
- **API Access:** Get API keys to integrate payment gateway
- **Required for:** Any website that wants to accept payments

## Why You Need a Merchant Account

To accept payments on your website (like your car wash booking system), you need:
1. **API Keys** - Only merchant accounts provide these
2. **Payment Processing** - Only merchants can receive payments
3. **Business Verification** - Required for security and compliance

**Your personal Khalti ID can only SEND money, not RECEIVE it on a website.**

## Options for You

### Option 1: Use Test Mode (No Registration Needed) ✅ RECOMMENDED FOR DEVELOPMENT
- **No Khalti registration required**
- **Works immediately** - Just click "Complete Payment (Test Mode)"
- **Perfect for development and testing**
- **No real money involved**
- **Grants dashboard access immediately**

**This is the easiest option if you're just developing/testing!**

### Option 2: Register as Merchant (For Real Payments)
If you want to accept **real payments** from customers:
1. Register at: https://khalti.com/merchant/
2. Complete KYC (company documents)
3. Get API keys
4. Add keys to `khalti-config.php`

**Note:** Merchant registration is free, but requires business documents.

### Option 3: Use Khalti Test Credentials (If Available)
Some payment gateways provide public test credentials. However, Khalti typically requires merchant registration even for testing.

## Recommendation

**For Development/Testing:**
- ✅ Use the **"Complete Payment (Test Mode)"** button
- No registration needed
- Works immediately
- Perfect for testing the system

**For Production (Real Payments):**
- Register as a merchant
- Get API keys
- Integrate Khalti properly

## Can I Use My Personal Khalti ID?

**Short answer: No.**

Your personal Khalti account:
- ❌ Cannot accept payments on websites
- ❌ Doesn't have API keys
- ❌ Cannot be used for payment gateway integration

**Think of it this way:**
- Personal account = Your wallet (you can pay others)
- Merchant account = Your business cash register (others can pay you)

## Summary

| Feature | Personal Account | Merchant Account |
|---------|-----------------|------------------|
| Make Payments | ✅ Yes | ✅ Yes |
| Accept Payments on Website | ❌ No | ✅ Yes |
| API Keys | ❌ No | ✅ Yes |
| Free | ✅ Yes | ✅ Yes (registration) |
| KYC Required | Basic | Business documents |

**Bottom line:** For your car wash booking system to accept payments, you need a merchant account. But for development, just use Test Mode - it's much simpler!

