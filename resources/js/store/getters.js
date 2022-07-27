const getters = {
    is_dev: () => {
        //console.log('vue_dev', process.env.NODE_ENV);
        return process.env.NODE_ENV !== 'production';
    },

    windowBreakPoint: state => {
        if (state.windowWidth >= 1200) return 'xl';
        else if (state.windowWidth >= 992) return 'lg';
        else if (state.windowWidth >= 768) return 'md';
        else if (state.windowWidth >= 576) return 'sm';
        else return 'xs'
    },

    scrollbarTag: state => {
        return state.is_touch_device ? 'div' : 'VuePerfectScrollbar'
    },

    userList: state => {
        return state.userManagement.users.map(u => {
            return {
                id: u.id,
                name: u.name,
                email: u.email,
                phone: u.phone,
                role: u.role,
                gender: u.gender,
                birth_date: u.birth_date,
                image_url: u.image_url,
                valid: u.valid
            }
        })
    },

    productList: state => {
        return state.productList.products.map(p => {
            return {
                id: p.id,
                title: p.title,
                image_url: p.image_url,
                sku: p.sku,
                category: state.categories.find(c => c.id == p.category_id)?.name??'',
                restaurant: state.restaurants.find(r => r.id == p.restaurant_id)?.name??'',
                description: p.description,
                price: p.price,
                stock: p.stock
            }
        })
    },

    orderList: state => {
        return state.orderList.orders.map(o => {
            return {
                id: o.id,
                order_status: o.order_status,
                number_shipped: o.number_shipped,
                order_total: Number(o.order_total),
                purchase_date: o.purchase_date,
                shipping_address: o.shipping_address,
                payment: o.payment
            }
        })
    }
};

export default getters
