/**
 * Created by Oleksiy on 05.04.2016.
 */

jQuery(function ($) {
    
    /* *
    * Show menu/hidden(mobile) menu
    * */

    var burger = $('.hidden-menu'),
        loginBtn = $('.login-btn');

    loginBtn.on('click', function () {
        console.log('good');

        $(this).parents('.m-header').find('.user-menu').slideToggle(300);
        $(this).toggleClass('active-login');
    });

    burger.on('click', function () {
        $(this).parents('.m-header').find('.user-menu').slideToggle(300);
    });

    /* *
    * Show user menu
    * */

    var userMenu = $('.user-menu'),
        loginUser = $('.login-user');

    loginUser.on('click', function () {
        $(this).toggleClass('active-login');
        userMenu.slideToggle(100);
    });

    /* *
    * show faq-list answers
    * */

    var faq = $('.footer-row');

    faq.on('click', '.faq-item', function () {
        $(this).siblings('.faq-answer').slideToggle(300);
    });

    /* *
    * search input
    * */

    var searchBtn = $('.search .btn-search'),
        searchInput = $('.search .search-input'),
        searchForm = $('.search form');

    searchBtn.on('click', function () {
        searchInput.toggleClass('search-active');
    });

    searchForm.on( 'submit', function ( event ) {
       if( searchInput.val() == "" ) {
           event.preventDefault();
       }
    });

    /* *
     * show category nav list & dynamic position
     * */

    if($('ul').hasClass('category-list')){

        var imgBtn = $('.img-link'),
            categoryList = $('.category-list'),
            imgPositionX = imgBtn.offset().left,
            imgPositionY = imgBtn.offset().top,
            imgHeight = imgBtn.innerHeight();

        categoryList.css({
            "left": imgPositionX + "px",
            "top": (imgPositionY + imgHeight) + "px",
            "padding": "20px"
        });

        $(window).on('resize', function () {

            imgPositionX = imgBtn.offset().left;
            imgPositionY = imgBtn.offset().top;
            imgHeight = imgBtn.innerHeight();

            categoryList.css({
                "left": imgPositionX + "px",
                "top": (imgPositionY + imgHeight) + "px"
            });

        });

        imgBtn.on('mouseenter', function () {

            categoryList.show();

        });

        imgBtn.on('mouseleave', function () {

            categoryList.hide();

        });

        categoryList.on('mouseenter', function () {

            categoryList.show();

        });

        categoryList.on('mouseleave', function () {

            categoryList.hide();

        });
        
    }

    /* *
    * chess post list (first 4 items for loop)
    * */

    var postArea = $( '.middle-row'),
        postList = postArea.children(),
        postCount = postList.length;

    for( var i = 0; i < postCount; i++ ){
        var eq = i;

        if( i == 0 ){
            postList.eq(eq).addClass('big');
        } else if( i == 1 ){
            postList.eq(eq).removeClass('big');
        } else if ( i == 2 ) {
            postList.eq(eq).removeClass('big');
        } else if ( i == 3 ){
            postList.eq(eq).addClass('big');
        }
    }
    
    /*
    * filter  
    */
    var chooseCountry = $('.select-country');

    chooseCountry.on('click', '.current-country', function () {

        $(this).next().slideToggle();
        $(this).toggleClass('active');

    });

    chooseCountry.on('click', 'li', function () {

        var id = $(this).attr('data-label'),
            country = $(this).text();

        chooseCountry.find('.current-country').text(country).attr('data-current',id);
        chooseCountry.find('.select-list').slideToggle();
        chooseCountry.find('.current-country').toggleClass('active');

    });

    $('.filter-btn').on('click', function () {

        $(this).siblings('.product-filter').toggleClass('show');

    });

    /* *
    * show more color pick
    * */

    $('.color-pick').on('click', function () {

        $(this).hide();
        $(this).siblings('.hidden-color-item').addClass('show');

    });

    /* *
    * adding products
    * */

    $('.product-item .wrap-img').prepend('<svg class="shopping-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 443.903 443.903" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 443.903 443.903"><g><path d="m61.484,131.085c-1.117-20.767-2.157-40.101-3.231-60.055 26.44-10.656 53.905-4.66 80.683-6.84 0.72-3.475 1.612-6.612 1.997-9.81 4.548-37.817 41.329-59.314 74.91-53.412 7.811,1.373 15.53,3.362 23.208,5.381 14.918,3.922 31.891,18.718 30.837,40.913-0.186,3.91-0.026,7.836-0.026,12.38 3.608,0.327 6.384,0.887 9.134,0.779 27.074-1.061 54.144-2.227 81.214-3.387 2.158-0.093 4.329-0.652 6.457-0.497 7.362,0.539 9.954,3.552 9.799,11.17-0.25,12.292-0.334,24.595-0.944,36.87-0.279,5.619 1.102,9.572 6.175,12.571 4.324,2.556 7.815,6.522 12.138,9.081 7.26,4.298 9.39,10.393 8.311,18.35-1.939,14.305-3.962,28.608-5.429,42.965-2.897,28.359-5.793,56.726-8.038,85.141-3.099,39.219-7.012,78.317-13.72,117.109-1.536,8.882-2.438,17.872-3.713,26.801-0.406,2.846-0.779,5.754-1.685,8.46-2.106,6.293-5.017,8.525-11.304,7.061-6.349-1.478-11.911,0.517-17.935,1.335-24.648,3.346-48.881,9.783-74.057,9.422-17.341-0.249-34.714,1.344-52.048,0.974-42.256-0.901-84.461-2.931-126.273-9.794-8.89-1.459-10.71-2.881-12.033-12.39-3.725-26.779-7.272-53.584-10.664-80.407-4.706-37.219-9.163-74.469-13.81-111.696-3.129-25.065-6.257-50.132-9.686-75.157-1.211-8.836 1.743-14.566 10.046-17.954 3.942-1.608 7.507-4.132 9.687-5.364zm121.285,287.83l-.223-.212c-1.502,3.508-3.004,7.016-5.047,11.787 3.908,0.466 7.651,1.939 10.616,0.987 3.166-1.017 5.598-4.322 8.945-7.127-0.994,2.726-1.672,4.585-2.337,6.409 1.071,0.486 1.751,1.099 2.313,1.005 12.623-2.109 25.751,3.68 38.108-2.427 6.575,5.231 14.054,1.944 21.008,1.783 13.672-0.317 27.415-1.021 40.952-2.866 19.594-2.671 39.03-6.497 59.096-9.926 1.934-12.616 4.094-24.999 5.69-37.455 3.989-31.132 7.765-62.292 11.547-93.451 4.217-34.75 8.207-69.527 12.591-104.255 1.602-12.691 4.053-25.276 6.212-38.498-43.592,1.126-86.006,2.222-130.092,3.361 1.45,9.461 2.316,17.608 4.054,25.564 1.141,5.221-0.416,9.263-3.412,13.025-3.41,4.282-9.22,5.612-13.64,3.489-4.453-2.141-5.948-6.939-3.969-13.051 0.555-1.713 1.348-3.349 2.046-5.014 3.309-7.894 3.03-15.953 1.686-24.635-28.624,1.231-56.656,2.436-85.833,3.69 1.173,8.301-1.486,15.777 3.514,22.81 1.452,2.042 1.268,5.618 1.017,8.417-0.393,4.363-3.116,7.341-7.455,8.215-4.897,0.987-8.367-1.269-10.616-5.602-2.487-4.792-1.426-9.624 1.622-13.243 5.815-6.904 2.967-13.138 0.333-20.363-13.748,1.79-27.353-2.6-39.205,2.283-20.151-5.843-39.889-1.096-60.819-3.551 2.237,14.36 4.112,27.481 6.472,40.514 0.399,2.205 2.88,4.033 4.399,6.036v-0.013c-6.232,4.904-1.3,9.987-0.82,16.986 4.99-7.755 8.93-13.88 12.87-20.005 0.611,0.374 1.222,0.747 1.833,1.121-3.5,6.121-6.593,12.525-10.608,18.287-4.599,6.6-4.425,13.03-1.16,21.009 7.728-11.35 15.01-22.043 22.292-32.737 0.636,0.428 1.273,0.855 1.909,1.283-6.775,11.392-13.503,22.814-20.351,34.162-2.662,4.412-4.405,8.767-0.74,14.852 6.417-9.134 10.786-19.001 18.484-26.351-3.258,7.743-6.442,15.615-11.494,22.01-8.227,10.414-6.064,21.092-3.446,34.281 5.421-8.397 9.857-15.268 14.293-22.139-1.575,6.951-4.444,13.113-8.225,18.654-5.331,7.813-6.612,15.635-1.927,24.912 2.92-3.806 5.661-7.38 8.403-10.954-5.797,11.168-11.171,21.943-6.107,34.952 1.59-0.746 3.06-1.435 5.273-2.473-5.763,13.245-5.829,20.072-0.593,30.076 5.832-9.638 11.588-19.152 17.344-28.665-4.35,15.473-15.763,27.569-18.768,43.334 0.687,0.376 1.374,0.753 2.061,1.128 5.832-8.708 11.664-17.417 17.496-26.125-3.55,9.952-8.505,19.004-14.105,27.637-4.611,7.108-4.567,13.831-0.38,21.839 5.262-7.66 10.071-14.66 14.879-21.66 0.61,0.421 1.22,0.843 1.83,1.264-4.247,7.043-8.367,14.167-12.785,21.1-3.035,4.763-4.634,9.513-2.873,15.206 1.254,4.054 1.89,8.299 2.874,12.786 6.613,1.087 12.52,2.057 17.343,2.85 6.991-10.135 13.206-19.146 19.421-28.156 0.738,0.448 1.477,0.896 2.215,1.344-5.518,8.78-11.036,17.56-17.58,27.972 21.812,1.383 41.527,2.633 60.229,3.818 4.375-4.351 7.858-7.817 11.34-11.284zm81.905-281.794c22.326,1.717 44.653-0.62 67.616-2.27 0-10.501 0.058-19.527-0.018-28.552-0.063-7.47 1.349-14.041 7.317-19.524 5.408-4.968 9.853-10.985 15.648-17.596-29.498,1.002-57.092,1.94-86.085,2.925 1.451,3.85 3.342,6.958 3.68,10.225 0.456,4.422 0.781,9.386-0.783,13.349-1.836,4.652-7.002,4.833-11.354,3.297-4.748-1.675-6.17-5.874-5.907-10.542 0.313-5.566 0.929-11.114 1.511-17.783-35.311,1.814-69.174-1.318-103.252,3.296 1.105,6.419 2.402,12.069 2.953,17.792 0.402,4.172-1.231,7.951-5.48,9.68-3.976,1.619-8.357,1.525-10.933-1.978-1.879-2.555-2.545-6.333-2.781-9.636-0.13-1.824 1.993-3.709 2.65-5.713 0.911-2.782 1.399-5.703 2.345-9.752-22.621,0-43.625,0-64.629,0 2.891,3.939 6.477,5.974 10.117,7.907 7.02,3.728 14.014,7.513 21.125,11.061 6.261,3.123 8.905,8.192 8.664,14.939-0.129,3.603-0.557,7.194-0.806,10.793-0.516,7.441-1.003,14.885-1.514,22.519 13.017,0 24.705,0 35.894,0 1.503-9.02 2.221-16.987 4.236-24.611 3.397-12.852 10.956-22.167 23.637-27.835 13.556-6.06 27.327-5.734 41.497-4.812 20.3,1.319 34.799,12.222 40.551,31.756 1.916,6.506 2.641,13.362 4.101,21.065zm-109.643-74.255c33.353-0.85 66.756-1.702 100.965-2.574 0-7.194 0.586-13.334-0.134-19.318-1.147-9.525-6.041-17.548-14.808-21.391-15.341-6.725-31.263-11.167-48.43-7.116-23.318,5.502-39.577,26.628-37.593,50.399zm94.387,74.85c1.166-9.479-1.053-17.05-4.018-24.422-3.676-9.137-10.757-14.468-20.277-16.048-7.099-1.179-14.42-2.309-21.533-1.833-12.041,0.806-23.793,3.666-31.215,14.517-6.214,9.085-8.026,19.59-8.904,31.48 28.928-1.244 57-2.45 85.947-3.694zm-188.338,4.495c16.718,0 30.966,0 45.988,0 0.64-10.992 1.237-21.239 1.987-34.121-16.736,11.903-31.341,22.291-47.975,34.121zm277.422-6.687c15.432-0.767 29.245-1.453 44.11-2.192-7.017-8.41-35.758-26.386-44.11-28.396 0,9.606 0,19.292 0,30.588zm-272.228-56.172c2.915,15.07 5.414,27.986 8.114,41.939 10.422-6.951 20.884-12.512 30.559-21.479-12.831-6.788-24.46-12.94-38.673-20.46zm300.737-4.135c-0.597-0.374-1.194-0.748-1.791-1.122-6.387,6.978-12.774,13.956-19.693,21.515 7.695,4.051 12.502,10.513 21.484,10.278 0-10.624 0-20.647 0-30.671z"/><path d="m211.261,258.993c16.329-24.365 50.125-32.435 73.461-18.315 15.071,9.119 20.833,22.272 19.127,39.303-3.112,31.063-14.063,58.721-35.057,82.23-5.498,6.157-9.977,13.219-14.997,19.809-1.735,2.278-3.555,4.523-5.57,6.551-8.957,9.02-13.065,7.783-22.817,2.046-11.197-6.587-22.347-13.266-33.724-19.53-18.857-10.381-35.207-24.062-50.144-39.244-11.43-11.618-20.577-24.962-23.014-42.001-2.42-16.921 2.149-29.5 17.07-37.385 21.787-11.515 44.266-11.828 66.438-0.429 3.117,1.603 5.694,4.256 9.227,6.965z"/><path d="m113.062,387.841c-6.002,9.674-12.003,19.348-18.005,29.022-0.752-0.458-1.504-0.917-2.255-1.375 4.166-10.793 11.95-19.381 18.329-28.826 0.643,0.393 1.287,0.786 1.931,1.179z"/><path d="m160.699,409.262c-2.26,3.73-4.521,7.459-6.781,11.189-0.886-5.488 2.425-8.63 6.781-11.189z"/><path d="m62.342,196.613c-2.303-5.48 0.743-9.403 4.718-13.03-1.573,4.339-3.146,8.678-4.719,13.017l.001,.013z"/><path d="m75.537,169.695c-1.431,2.267-2.861,4.534-4.292,6.801-0.36-0.189-0.72-0.377-1.08-0.565 1.301-2.503 2.601-5.005 3.902-7.508 0.49,0.424 0.98,0.848 1.47,1.272z"/><path d="m182.769,418.915c1.281-2.455 2.561-4.91 3.842-7.365 0.66,0.515 1.321,1.03 1.981,1.544-2.015,1.869-4.031,3.739-6.046,5.608l.223,.213z"/><path d="m126.661,423.366c1.436-2.134 2.872-4.267 4.308-6.4 0.492,0.273 0.983,0.547 1.475,0.821-1.303,2.236-2.606,4.473-3.91,6.709-0.624-0.377-1.248-0.754-1.873-1.13z"/></g></svg>');

    $('.add-product-btn').on('click', function () {

        $(this).toggleClass('cancel');
        $(this).parents('.wrap-img').toggleClass('current');

        if($(this).parents('.wrap-img').children().hasClass("show")){
            $(this).parents('.wrap-img').find('.shopping-icon').removeClass('show');
        } else {
            $(this).siblings('.shopping-icon').addClass('show');
        }

    });

    /* *
    * copy link
    * */

    $('.copy-link').on('click', function(){

        document.execCommand('SelectAll');
        document.execCommand("Copy", false, null);

    });

    /* *
     * show register/login modal windows
     * */

    var loginBtn = $('.enter-btn'),
        registerBtn = $('.register-btn'),
        recoverPassBtn = loginBtn.siblings('.login-modal').find('.recover-pass'),
        changeTelBtn = loginBtn.siblings('.login-modal').find('.change-tel');

    loginBtn.on('click', function () {

        console.log('good');

        $(this).siblings('.modals').hide();
        $(this).siblings('.login-modal').slideDown();

    });

    recoverPassBtn.on('click', function () {

        $(this).parents('.modals').hide();
        $(this).parents('.modals').siblings('.email-modal').slideDown();

    });

    changeTelBtn.on('click', function () {

        $(this).parents('.modals').hide();
        $(this).parents('.modals').siblings('.telephone-modal').slideDown();

    });

    registerBtn.on('click', function () {

        $(this).siblings('.modals').hide();
        $(this).siblings('.register-modal').slideDown();

    });

    $('.modals').on('mouseleave', function () {

        $(this).delay(3000).slideUp();

    });

    /* *
    * toggle tabs new-tests/my-tests in lk
    * */

    var myTestBtn = $('.my-test-tab'),
        newTestBtn = $('.new-test-tab'),
        myTestTab = $('.my-tests'),
        newTestTab = $('.new-tests');

    myTestBtn.on('click', function () {

        newTestTab.addClass('hide-tab');
        myTestTab.removeClass('hide-tab');
        $(this).siblings().removeClass('current');
        $(this).addClass('current');

    });

    newTestBtn.on('click', function () {

        myTestTab.addClass('hide-tab');
        newTestTab.removeClass('hide-tab');
        $(this).siblings().removeClass('current');
        $(this).addClass('current');

    });
    
    /* *
     * toggle tabs male test/female test/ wedding test
     * */
    
    var femaleBtn = $('.toggle-tab.lips'),
        maleBtn = $('.toggle-tab.usi'),
        weddBtn = $('.toggle-tab.wedd'),
        maleTest = $('.male-tests'),
        femaleTest = $('.female-tests'),
        weddTest = $('.wedd-tests');

    femaleBtn.on('click', function () {

        maleTest.addClass('hide-tab');
        weddTest.addClass('hide-tab');
        femaleTest.removeClass('hide-tab');
        
    });

    maleBtn.on('click', function () {

        femaleTest.addClass('hide-tab');
        weddTest.addClass('hide-tab');
        maleTest.removeClass('hide-tab');

    });

    weddBtn.on('click', function () {

        femaleTest.addClass('hide-tab');
        weddTest.removeClass('hide-tab');
        maleTest.addClass('hide-tab');

    });
    
});
