import config, { colors } from '../config'

// /////////////////////////////////////////////
// Helper
// /////////////////////////////////////////////

// *From Auth - Data will be received from auth provider
const userDefaults = {
    uid         : 0,            // From Auth
    nickname    : 'john',       // From Auth
    displayName    : 'John Doe',   // From Auth
    about       : '',
    avatar      : '/assets/main/images/user-male.png', // From Auth
    status      : 'online',
    role        : 'guest'
}

const userInfoLocalStorage = JSON.parse(localStorage.getItem('userInfo')) || {}

// Set default values for active-user
// More data can be added by auth provider or other plugins/packages
const getUserInfo = () => {
    const userInfo = {}

    // Update property in user
    Object.keys(userDefaults).forEach((key) => {
        // If property is defined in localStorage => Use that
        userInfo[key] = userInfoLocalStorage[key] ?  userInfoLocalStorage[key] : userDefaults[key]
    })

    // Include properties from localStorage
    Object.keys(userInfoLocalStorage).forEach((key) => {
        if (userInfo[key] === undefined && userInfoLocalStorage[key] !== null) userInfo[key] = userInfoLocalStorage[key]
    })

    return userInfo
}



// Check if device is touch device
// This is used to remove perfect scrollbar from touch devices
// Using Dynamic components
const is_touch_device = () => {
    const prefixes = ' -webkit- -moz- -o- -ms- '.split(' ')
    const mq = function (query) {
        return window.matchMedia(query).matches
    }

    if ('ontouchstart' in window || window.DocumentTouch) {
        return true
    }

    // include the 'heartz' as a way to have a non matching MQ to help terminate the join
    // https://git.io/vznFH
    const query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join('')
    return mq(query)
}

// /////////////////////////////////////////////
// State
// /////////////////////////////////////////////

const state = {
    AppActiveUser           : getUserInfo(),
    bodyOverlay             : false,
    isVerticalNavMenuActive : true,
    is_touch_device         : is_touch_device(),
    mainLayoutType          : config.mainLayoutType || 'vertical',
    //mainLayoutType          : 'horizontal',
    //navbarSearchAndPinList,
    reduceButton            : config.sidebarCollapsed,
    //reduceButton            : false,
    verticalNavMenuWidth    : 'default',
    verticalNavMenuItemsMin : false,
    scrollY                 : 0,
    //starredPages            : navbarSearchAndPinList['pages'].data.filter((page) => page.is_bookmarked),
    theme                   : config.theme || 'light',
    //theme                   : 'light',
    themePrimaryColor       : colors.primary,

    // Can be used to get current window with
    // Note: Above breakpoint state is for internal use of sidebar & navbar component
    windowWidth: null,
    categories: [],
    restaurants: [],
};

export default state
