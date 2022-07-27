
export const ORDER_STATUS_NONE = 0;
export const ORDER_STATUS_HOLDING = 1;
export const ORDER_STATUS_PURCHASED = 2;
export const ORDER_STATUS_DELIVERING = 3;
export const ORDER_STATUS_REFUND = 4;
export const ORDER_STATUS_FINISHED = 5;
export const ORDER_STATUS_CANCEL = 6;
export const ORDER_STATUS_COMPLETED = 9;

export const SHIPPING_STATUS_PICKED = 0;
export const SHIPPING_STATUS_ROUTE = 1;
export const SHIPPING_STATUS_NEAR = 2;
export const SHIPPING_STATUS_DELIVERING = 3;


export const PAYMENT_TYPE_STRIPE = 'stripe';
export const PAYMENT_TYPE_PAYPAL = 'paypal';

export const PAYMENT_STATUS_PENDING = 0;
export const PAYMENT_STATUS_PAYED = 1;
export const PAYMENT_STATUS_FAILED = 2;

export const USER_ROLE_ADMIN = 'admin';
export const USER_ROLE_DELIVERER = 'deliverer';
export const USER_ROLE_CUSTOMER = 'customer';

export const USER_ROLE_OPTIONS = [
    { label: 'Admin',  value: USER_ROLE_ADMIN },
    { label: 'Customer',  value: USER_ROLE_CUSTOMER },
    { label: 'Deliverer',  value: USER_ROLE_DELIVERER }
];

export const getOrderStatusColorStyle = (status) => {
    switch (status){
        case ORDER_STATUS_NONE:
        case ORDER_STATUS_HOLDING:
        case ORDER_STATUS_PURCHASED:
            return 'warning';
        case ORDER_STATUS_DELIVERING:
            return 'primary';
        case ORDER_STATUS_REFUND:
            return 'danger';
        case ORDER_STATUS_FINISHED:
        case ORDER_STATUS_COMPLETED:
            return 'success';
    }
    return 'warning';
}

export const getOrderStatusLabel = (status) => {
    switch (status){
        case ORDER_STATUS_NONE:
            return 'None';
        case ORDER_STATUS_HOLDING:
            return 'On hold';
        case ORDER_STATUS_PURCHASED:
            return 'Purchased';
        case ORDER_STATUS_DELIVERING:
            return 'Delivering';
        case ORDER_STATUS_REFUND:
            return 'Refund';
        case ORDER_STATUS_FINISHED:
            return 'Finished';
        case ORDER_STATUS_COMPLETED:
            return 'Completed';
    }
    return 'None';
}

export const getOrderStatusChoices = () => {
    return [
        {text:'None', value:ORDER_STATUS_NONE},
        {text:'On hold', value:ORDER_STATUS_HOLDING},
        {text:'Purchased', value:ORDER_STATUS_PURCHASED},
        {text:'Delivering', value:ORDER_STATUS_DELIVERING},
        {text:'Cancel', value:ORDER_STATUS_CANCEL},
        {text:'Refund', value:ORDER_STATUS_REFUND},
        {text:'Finished', value:ORDER_STATUS_FINISHED},
        {text:'Completed', value:ORDER_STATUS_COMPLETED}
    ]
}

export const getShippingStatusChoices = () => {
    return [
        {text:'PACKAGE HAS BEEN PICKED UP', value:SHIPPING_STATUS_PICKED},
        {text:'EN ROUTE', value:SHIPPING_STATUS_ROUTE},
        {text:'ALMOST AT THE DESTINATION', value:SHIPPING_STATUS_NEAR},
        {text:'DELIVERED ', value:SHIPPING_STATUS_DELIVERING},
    ]
}

export const getPaymentTypeLabel = (type) => {
    switch (type){
        case PAYMENT_TYPE_STRIPE:
            return 'Paid with Card';
        case PAYMENT_TYPE_PAYPAL:
            return 'Paid with Paypal';
    }
    return '';
}


export const getPaymentStatusLabel = (status) => {
    switch (status){
        case PAYMENT_STATUS_FAILED:
            return 'Failed';
        case PAYMENT_STATUS_PAYED:
            return 'Success';
        case PAYMENT_STATUS_PENDING:
            return 'Pending';
    }
    return '';
}

export const getShippingLabel = (status) => {
    switch (status){
        case SHIPPING_STATUS_PICKED:
            return 'PACKAGE HAS BEEN PICKED UP';
        case SHIPPING_STATUS_ROUTE:
            return 'EN ROUTE';
        case SHIPPING_STATUS_NEAR:
            return 'ALMOST AT THE DESTINATION';
        case SHIPPING_STATUS_DELIVERING:
            return 'DELIVERED';
    }
    return '';
}
