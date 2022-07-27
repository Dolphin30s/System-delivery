/*=========================================================================================
  File Name: sidebarItems.js
  Description: Sidebar Items list. Add / Remove menu items from here.
  Strucutre:
          url     => router path
          name    => name to display in sidebar
          slug    => router path name
          icon    => Feather Icon component/icon name
          tag     => text to display on badge
          tagColor  => class to apply on badge element
          i18n    => Internationalization
          submenu   => submenu of current item (current item will become dropdown )
                NOTE: Submenu don't have any icon(you can add icon if u want to display)
          isDisabled  => disable sidebar item/group
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export const adminMenus = [
    {
        url: '/admin',
        name: 'Dashboard',
        tagColor: 'warning',
        icon: 'HomeIcon',
        i18n: 'Dashboard'
    },
    {
        url: null,
        name: 'Management',
        tagColor: 'warning',
        icon: 'HomeIcon',
        i18n: 'Management',
        submenu: [
            {
                url: '/admin/user/list',
                name: 'UserList',
                slug: 'user-list',
                i18n: 'Users',
                icon: 'HomeIcon'

            },
            {
                url: '/admin/restaurant/list',
                name: 'Shop',
                slug: 'restaurant-list',
                i18n: 'Shop',
                icon: 'HomeIcon'
            }
        ]
    },
    {
        url: null,
        name: 'Products',
        tagColor: 'warning',
        icon: 'HomeIcon',
        i18n: 'Products',
        submenu: [
            {
                url: '/admin/product/list',
                name: 'Product',
                slug: 'product-list',
                i18n: 'Product',
                icon: 'HomeIcon'
            },
            {
                url: '/admin/category/list',
                name: 'Categories',
                slug: 'category-list',
                i18n: 'Categories',
                icon: 'HomeIcon'
            }
        ]
    },
    {
        url: '/orders',
        name: 'Orders',
        tagColor: 'warning',
        icon: 'HomeIcon',
        i18n: 'Orders'
    }
];

export const customerMenus = [
    {
        url: '/home',
        name: 'Dashboard',
        tagColor: 'warning',
        icon: 'HomeIcon',
        i18n: 'Dashboard'
    },
    {
        url: '/orders',
        name: 'My Orders',
        tagColor: 'warning',
        icon: 'HomeIcon',
        i18n: 'My Orders'
    },
    // {
    //     url: '/home/addresses',
    //     name: 'Addresses',
    //     tagColor: 'warning',
    //     icon: 'HomeIcon',
    //     i18n: 'Addresses'
    // },
    {
        url: '/home/cart',
        name: 'My Cart',
        tagColor: 'warning',
        icon: 'HomeIcon',
        i18n: 'My Cart'
    }
];

export const delivererMenus = [
    {
        url: '/orders',
        name: 'Orders',
        tagColor: 'warning',
        icon: 'HomeIcon',
        i18n: 'Orders'
    },
];

