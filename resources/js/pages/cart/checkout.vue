<template>
    <div id="page-checkout">
        <form-wizard
            ref="checkoutWizard"
            color="rgba(var(--vs-primary), 1)"
            :title="null"
            :subtitle="null"
            :hide-buttons="true">

            <!-- tab 1 content -->
            <tab-content title="Cart" icon="feather icon-shopping-cart" class="mb-5">

                <!-- IF CART HAVE ITEMS -->
                <div class="vx-row" v-if="cartItems.length">

                    <!-- LEFT COL -->
                    <div class="vx-col lg:w-2/3 w-full relative">
                        <div class="items-list-view" v-for="(item, index) in cartItems" :key="item.id">
                            <item-list-view :item="item" class="mb-base">

                                <!-- SLOT: ITEM META -->
                                <template slot="item-meta">
                                    <h6
                                        class="item-name font-semibold mb-1 cursor-pointer hover:text-primary"
                                        @click="$router.push({name: 'ecommerce-item-detail-view', params: {item_id: item.id }}).catch(() => {})">
                                        {{ item.title }}</h6>
                                    <p class="text-sm mb-2">{{ item.description }}</p>
                                    <!--                                <p class="text-success text-sm">In Stock</p>-->

                                    <p class="mt-4 font-bold text-sm">Quantity</p>
                                    <vs-input-number min="1" :value="item.quantity"
                                                     @input="updateItemQuantity($event, index)" class="inline-flex"/>

                                    <!--                                <p class="font-medium text-grey mt-4">Delivery by, {{ item.delivery_date }}</p>-->
                                    <!--                                <p class="text-success font-medium">{{ item.discount_in_percentage }}% off {{ item.offers_count }} offers Available</p>-->
                                </template>

                                <!-- SLOT: ACTION BUTTONS -->
                                <template slot="action-buttons">

                                    <!-- PRIMARY BUTTON: REMOVE -->
                                    <div
                                        class="item-view-primary-action-btn p-3 rounded-lg flex flex-grow items-center justify-center cursor-pointer mb-3"
                                        @click="removeItemFromCart(item)">
                                        <feather-icon icon="XIcon" svgClasses="h-4 w-4"/>
                                        <span class="text-sm font-semibold ml-2">REMOVE</span>
                                    </div>

                                    <!-- SECONDARY BUTTON: MOVE-TO/VIEW-IN WISHLIST -->
                                    <div
                                        class="item-view-secondary-action-btn bg-primary p-3 rounded-lg flex flex-grow items-center justify-center text-white cursor-pointer"
                                        @click="wishListButtonClicked(item)">
                                        <feather-icon icon="HeartIcon"
                                                      :svgClasses="[{'text-white fill-current': isInWishList(item.id)}, 'h-4 w-4']"/>
                                        <span class="text-sm font-semibold ml-2"
                                              v-if="isInWishList(item.id)">WISHLIST</span>
                                        <span class="text-sm font-semibold ml-2" v-else>WISHLIST</span>
                                    </div>
                                </template>
                            </item-list-view>
                        </div>
                    </div>

                    <!-- RIGHT COL -->
                    <div class="vx-col lg:w-1/3 w-full">
                        <vx-card>
                            <p class="text-grey mb-3">Options</p>
                            <!--                        <div class="flex justify-between">-->
                            <!--                            <span class="font-semibold">Coupons</span>-->
                            <!--                            <span class="font-medium text-primary cursor-pointer">Apply</span>-->
                            <!--                        </div>-->

                            <vs-divider/>

                            <p class="font-semibold mb-3">Price Details</p>
                            <div class="flex justify-between mb-2">
                                <span class="text-grey">Total MRP</span>
                                <span>${{ cart_total }}</span>
                            </div>
                            <!--                        <div class="flex justify-between mb-2">-->
                            <!--                            <span class="text-grey">Bag Discount</span>-->
                            <!--                            <span class="text-success">-25$</span>-->
                            <!--                        </div>-->
<!--                            <div class="flex justify-between mb-2">-->
<!--                                <span class="text-grey">Estimated Tax</span>-->
<!--                                <span>${{ tax }}</span>-->
<!--                            </div>-->
                            <!--                        <div class="flex justify-between mb-2">-->
                            <!--                            <span class="text-grey">EMI Eligibility</span>-->
                            <!--                            <a href="#" class="text-primary">Details</a>-->
                            <!--                        </div>-->
                            <div class="flex justify-between mb-2">
                                <span class="text-grey">Delivery Fee</span>
                                <span class="text-success">{{ delivery_charges }}</span>
                            </div>

                            <vs-divider/>

                            <div class="flex justify-between font-semibold mb-3">
                                <span>Total</span>
                                <span>${{ all_total }}</span>
                            </div>

                            <vs-button class="w-full" @click="$refs.checkoutWizard.nextTab()">PLACE ORDER</vs-button>
                        </vx-card>
                    </div>
                </div>

                <!-- IF NO ITEMS IN CART -->
                <vx-card title="You don't have any items in your cart." v-else>
                    <vs-button @click="$router.push('/home').catch(() => {})">Browse Shop</vs-button>
                </vx-card>

            </tab-content>

            <!-- tab 2 content -->
            <tab-content title="Address" icon="feather icon-home" class="mb-5">

                <div class="vx-row">

                    <!-- LEFT COL: NEW ADDRESS -->
                    <div class="vx-col lg:w-2/3 w-full">
                        <vx-card title="Add New Address"
                                 subtitle="Be sure to check &quot;Deliver to this address&quot; when you have finished"
                                 class="mb-base">

                            <form data-vv-scope="add-new-address">
                                <div class="vx-row">
                                    <div class="vx-col sm:w-1/2 w-full">

                                        <vs-input
                                            v-validate="'required|alpha_spaces'"
                                            data-vv-as="field"
                                            name="fullName"
                                            label="Full Name:"
                                            v-model="fullName"
                                            class="w-full mt-5"/>
                                        <span v-show="errors.has('add-new-address.fullName')"
                                              class="text-danger">{{ errors.first('add-new-address.fullName') }}</span>

                                    </div>

                                    <div class="vx-col sm:w-1/2 w-full">

                                        <!--                                        <vs-input-->
                                        <!--                                            v-validate="'required|digits:10'"-->
                                        <!--                                            name="mobileNum"-->
                                        <!--                                            label="Mobile Number:"-->
                                        <!--                                            v-model="mobileNum"-->
                                        <!--                                            class="w-full mt-5"/>-->
                                        <div class="text-sm mt-6 color-gray">PhoneNumber:</div>
                                        <vue-tel-input v-model="mobileNum" defaultCountry="US"
                                                       @validate="this.onValidPhone"></vue-tel-input>
                                        <span v-show="invalidPhone"
                                              class="text-danger">PhoneNumber is invalid</span>
                                    </div>
                                </div>


                                <div class="vx-row">

                                    <div class="vx-col sm w-full">
                                        <vs-input
                                            v-validate="'required'"
                                            name="full_address"
                                            label="Full Address:"
                                            v-model="full_address"
                                            class="w-full mt-5"/>
                                        <span v-show="errors.has('add-new-address.full_address')"
                                              class="text-danger">{{
                                                errors.first('add-new-address.full_address')
                                            }}</span>
                                    </div>
                                </div>

                                <vs-button class="mt-6 ml-auto flex" @click.prevent="submitNewAddressForm">SAVE AND
                                    DELIVER HERE
                                </vs-button>
                            </form>
                        </vx-card>
                    </div>

                    <!-- RIGHT COL: CONTINUE WITH SAVED ADDRESS -->
                    <div class="vx-col lg:w-1/3 w-full">
                        <vx-card :title="item.name" v-for="item in shippingAddresses" :key="item.id">
                            <div>
                                <p>{{ item.address }}</p>
                                <p>Latitude: {{ item.latitude }}, Longitude: {{ item.longitude }}</p>
                                <p>{{ item.phone_number }}</p>
                            </div>
                            <div class="flex justify-center color-primary" v-if="item.id===select_address_id">
                                <feather-icon icon="CheckIcon" class="mr-2" svgClasses="h-6 w-6"/>
                                <p>Selected</p>
                            </div>

                            <vs-divider/>

                            <vs-button class="w-full" @click="onSelectAddress(item.id)">DELIVER TO THIS ADDRESS
                            </vs-button>
                        </vx-card>
                    </div>

                </div>

                <div class="vx-row mt-4">
                    <div class="vx-col w-full">
                        <gmap-map
                            style="width: 100%; height: 500px"
                            :center="currentLocation"
                            :zoom="15"
                            ref="mapRef"
                            @click="handleMapClick"
                        >
                            <gmap-marker
                                :position="currentLocation"
                                :clickable="true"
                                @click="panToMarker"
                            />
                        </gmap-map>
                    </div>
                </div>
            </tab-content>

            <!-- tab 3 content -->
            <tab-content title="Payment" icon="feather icon-credit-card" class="mb-5">

                <div class="vx-row">

                    <!-- LEFT COL: PAYMENT OPTIONS -->
                    <div class="vx-col lg:w-2/3 w-full">
                        <vx-card title="Payment Options" subtitle="Please select payment option"
                                 class="mb-base">

                            <div class="mt-3">
                                <ul>
                                    <!-- OPTION 1 -->
                                    <li>
                                        <div id="stripe"></div>
                                        <vs-button class="mt-4" @click.prevent="onStripePay" :disabled="false">
                                            Pay with Card
                                        </vs-button>
                                    </li>

                                    <vs-divider class="my-6"/>

                                    <!-- OPTION 2 -->
                                    <li>
                                        <div class="flex items-center flex-wrap">
                                            <div id="paypal"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </vx-card>
                    </div>

                    <!-- RIGHT COL: PRICE -->
                    <div class="vx-col lg:w-1/3 w-full">
                        <vx-card title="Price Details">

                            <div class="flex justify-between mb-2">
                                <span>Price 3 Items</span>
                                <span class="font-semibold">${{ cart_total }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span>Delivery Charges</span>
                                <span class="text-success">{{ delivery_charges }}</span>
                            </div>

                            <vs-divider/>

                            <div class="flex justify-between">
                                <span>Amount Payable</span>
                                <span class="font-semibold">${{ all_total }}</span>
                            </div>
                        </vx-card>
                    </div>
                </div>
            </tab-content>

        </form-wizard>
    </div>
</template>

<script>
import {FormWizard, TabContent} from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import ItemListView from './ItemListView.vue';
import {VueTelInput} from 'vue-tel-input';
import {showNotify} from "../../helper";


export default {
    name: "Checkout",
    data() {
        return {

            // TAB 2
            fullName: '',
            mobileNum: '',
            invalidPhone: false,
            currentLocation: {lat: 40.689247, lng: -74.044502},
            full_address: '',
            searchAddressInput: '',
            select_address_id: null,

            // TAB 3
            is_paying: false,
            card: null,
            client_secret: null,
        }
    },
    computed: {
        cartItems() {
            return this.$store.state.eCommerce.cartItems.slice().reverse()
        },
        shippingAddresses() {
            return this.$store.state.eCommerce.addresses.slice();
        },
        isInWishList() {
            return (itemId) => this.$store.getters['eCommerce/isInWishList'](itemId)
        },
        cart_total() {
            let total = 0;
            this.cartItems.forEach(item => {
                total += Number(item.price) * item.quantity;
            });
            return total.toFixed(2);
        },
        tax() {
            // todo
            let tax = 0;
            return tax.toFixed(2);
        },
        delivery_fee() {
            // todo
            let delivery_fee = 0;
            return delivery_fee.toFixed(2);
        },
        delivery_charges() {
            return this.delivery_fee ? (`$` + this.delivery_fee) : 'Free';
        },
        all_total() {
            let all_total = Number(this.cart_total) + Number(this.tax) + Number(this.delivery_fee);
            return all_total.toFixed(2);
        },
        user: function () {
            return this.$store.getters['auth/user'];
        }
    },
    methods: {

        // TAB 1
        removeItemFromCart(item) {
            this.$store.dispatch('eCommerce/toggleItemInCart', item)
        },
        wishListButtonClicked(item) {
            // Toggle in Wish List
            if (this.isInWishList(item.id)) this.$router.push('/home/wish-list').catch(() => {
            })
            else {
                this.toggleItemInWishList(item)
                this.removeItemFromCart(item)
            }
        },
        toggleItemInWishList(item) {
            this.$store.dispatch('eCommerce/toggleItemInWishList', item)
        },
        updateItemQuantity(event, index) {
            const itemIndex = Math.abs(index + 1 - this.cartItems.length)
            this.$store.dispatch('eCommerce/updateItemQuantity', {quantity: event, index: itemIndex})
        },

        // TAB 2
        submitNewAddressForm() {
            if (this.invalidPhone) {
                return;
            }
            return new Promise(() => {
                this.$validator.validateAll('add-new-address').then(result => {
                    if (result) {
                        this.select_address_id = null;
                        this.$refs.checkoutWizard.nextTab()
                    } else {
                        this.$vs.notify({
                            title: 'Error',
                            text: 'Please enter valid details',
                            color: 'warning',
                            iconPack: 'feather',
                            icon: 'icon-alert-circle'
                        })
                    }
                })
            })
        },
        onValidPhone(object) {
            this.invalidPhone = !object.valid;
        },
        searchLocation: function () {
            navigator.geolocation.getCurrentPosition(async (position) => {
                this.currentLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
            });
        },
        panToMarker() {
            this.$refs.mapRef.panTo(this.currentLocation);
            this.$refs.mapRef.setZoom(18);
        },
        handleMapClick(e) {
            this.currentLocation = {lat: e.latLng.lat(), lng: e.latLng.lng()};
        },
        onSelectAddress(address_id) {
            this.select_address_id = address_id;
            this.$refs.checkoutWizard.nextTab();
        },

        // TAB 3
        onStripePay() {
            this.$store.dispatch('orderList/getIntent', {price: Number(this.all_total)}).then((client_secret) => {
                if (client_secret) {
                    this.is_paying = true;
                    this.stripe.confirmCardPayment(
                        client_secret,
                        {
                            payment_method: {
                                card: this.card,
                                billing_details: {
                                    name: this.user.name
                                }
                            }
                        }
                    ).then(data => {
                        if (data.error) {
                            showNotify(this.$vs, 'Payment Failed', data.error.code, false);
                            this.is_paying = false;
                            return false;
                        } else {
                            this.completeOrder({type: 'stripe', data: data.paymentIntent});
                        }
                    });
                } else {
                    showNotify(this.$vs, 'Payment Failed', 'Network Error', false);
                }
            }).catch(error => showNotify(this.$vs, 'Payment Failed', error, false));
        },
        completeOrder({type, data}) {
            const payload = {
                address: {
                    id: this.select_address_id,
                    name: this.fullName,
                    phone: this.mobileNum,
                    lat: this.currentLocation.lat,
                    lng: this.currentLocation.lng,
                    full_address: this.full_address
                },
                payment: {
                    type: type,
                    price: this.cart_total,
                    delivery_fee: this.delivery_fee,
                    total: this.all_total,
                    data: data
                }
            }

            this.$store.dispatch('orderList/createOrder', payload)
                .then((response) => {
                    showNotify(this.$vs, 'Success', 'Payment received successfully');
                    this.$router.replace('/home')
                        .then(() => {
                            this.$store.dispatch('eCommerce/fetchCart');
                            this.$store.dispatch('eCommerce/fetchAddress');
                        });
                })
                .catch((reason) => {
                    showNotify(this.$vs, 'Failed', reason, false);
                })
        },
        mountStripeElements() {
            // Stripe
            const stripe_key = process.env.MIX_STRIPE_KEY;
            this.stripe = Stripe(stripe_key, {locale: 'en'});
            this.elements = this.stripe.elements();
            let style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: 'sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            this.card = this.elements.create('card', {style: style, hidePostalCode: true});
            this.card.mount('#stripe');
        },
        mountPaypalElements() {
            // Paypal
            window.paypal_sdk.Buttons({
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [
                            {
                                description: this.user.name,
                                amount: {
                                    currency_code: "USD",
                                    value: Number(this.all_total)
                                }
                            }
                        ]
                    })
                },
                onApprove: (data, actions, resp) => {
                    // const order = await actions.order.capture();
                    // console.log('paypal data', order, data);
                    this.completeOrder({type: 'paypal', data: data});
                },
                onError: err => {
                    showNotify(this.$vs, 'Pay with Paypal Failed', err, false);
                }
            }).render('#paypal');
        }
    },
    watch: {
        currentLocation: function () {
            this.$store.dispatch('getAddressFromCoordinate', this.currentLocation).then((address) => {
                if (address && address.formatted_address) {
                    this.full_address = address.formatted_address;
                }
            });
        }
    },
    components: {
        ItemListView,
        FormWizard,
        TabContent,
        VueTelInput
    },
    created() {

    },
    mounted() {
        this.searchLocation();
        this.$store.dispatch('eCommerce/fetchAddress');

        // Load Paypal SDK
        const p_script = document.createElement('script');
        const paypal_client_id = process.env.MIX_PAYPAL_CLIENT_ID;
        p_script.src = `https://www.paypal.com/sdk/js?client-id=${paypal_client_id}`;
        p_script.setAttribute('data-namespace', "paypal_sdk");
        p_script.addEventListener("load", this.mountPaypalElements);
        document.body.appendChild(p_script);

        // load Stripe SDK
        const s_script = document.createElement('script');
        s_script.src = "https://js.stripe.com/v3/";
        s_script.addEventListener("load", this.mountStripeElements);
        document.body.appendChild(s_script);
    }
}
</script>

<style lang="scss" scoped>
#page-checkout {
    .item-view-primary-action-btn {
        color: #2c2c2c !important;
        background-color: #f6f6f6;
    }

    .item-name {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        -webkit-line-clamp: 2;
    }

    .vue-form-wizard {
        padding-bottom: 0;

        ::v-deep .wizard-header {
            padding: 0;
        }

        ::v-deep .wizard-tab-content {
            padding-right: 0;
            padding-left: 0;
            padding-bottom: 0;

            .wizard-tab-container {
                margin-bottom: 0 !important;
            }
        }
    }
}
</style>
