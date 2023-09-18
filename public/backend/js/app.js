$(document).ready(function() {
    // all the variables
    var developermode = false;
    var wrapper = $(".wrapper");
    var wrapperbg = $(".wrapper_background");

    var is_aside = window.localStorage.isAside;
    if (window.matchMedia('(max-width: 992px)').matches) {
        if(is_aside && is_aside==1){
            wrapper.removeClass("aside_close");
        }else {
            wrapper.addClass("aside_close");
        }
    }else {
        wrapper.removeClass("aside_close");
    }
    // aside toggle, hide and show programm start
    function asideToggle() {
        if(wrapper.hasClass('aside_close')) {
            wrapper.removeClass("aside_close");
            window.localStorage.isAside = 1;
        } else {
            wrapper.addClass("aside_close");
            window.localStorage.isAside = 0;
        }
    }
    if (window.matchMedia('(max-width: 991px)').matches) {
        wrapper.addClass("aside_close");
    }
    function asideHide() {
        wrapper.addClass("aside_close");
        window.localStorage.isAside = 0;
    }
    // click on the wrapper-background (close)
    $(".wrapper_background").on("click", function() {
        asideHide();
    });
    // click on the aside-close (close)
    $('a#panelClose_btn').on("click", function() {
        asideHide();
    });

    // click on toggle button (toggle)
    $("#aside-toggle").on("click", function(event) {
        asideToggle();
        event.preventDefault();
    });
    $("#panelOpen_btn").on("click", function(event) {
        wrapper.removeClass("aside_close");
        window.localStorage.isAside = 1;
    });

    // dropdown toggle programm start
    $(".aside_nav .dropdown > a").on("click", function(event) {
        var parent = $(this).closest("li.dropdown");

        if(parent.hasClass("active")) {
            parent.removeClass("active");
        } else {
            parent.addClass("active");
            $( "li.dropdown" ).not( parent ).removeClass( "active" );
        }
        event.preventDefault();
    });

    // user dropdown toggle programm start
    $(".user_dropdown > a").on("click", function(event) {
        var parent = $(this).closest("li.user_dropdown");

        if(parent.hasClass("active")) {
            parent.removeClass("active");
        } else {
            parent.addClass("active");
            $( "li.user_dropdown" ).not( parent ).removeClass( "active" );
        }
        event.preventDefault();
    });

    $(document).click(function(event){
        var value = $(event.target).closest('.user_dropdown > a, .user_dropdown .sub_menu').length;
        if (value == 0) {
            if ($('.user_dropdown').hasClass('active')) {
                $('.user_dropdown').removeClass('active');
            }
        }
    });

    // nicescroll plugin
    new PerfectScrollbar(('.aside_nav'), {
        wheelSpeed: 0.2
    });

    // list dropdown
    if ($('.wrapper').data('menu').length > 1) {
        var menu = $('.wrapper').data('menu');
        var li = '.aside_nav li#' + menu;
        $(li).addClass('active');
    }

    if ($('.wrapper').data('submenu').length > 1) {
        var submenu = $('.wrapper').data('submenu');
        $(li + ' ul li .' + submenu).addClass('active');
        $('ul li .' + submenu).addClass('active');
    }

    // print media
    $('#print').click(function(){
        window.print();
    });

	// datepicker js
	$('.datepicker').each((key, tag)=>{
		$(tag).datepicker({
			uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd',
		});
	});

	$('#startDate').datepicker({
		uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd',
		minDate: '2021-01-01',
		maxDate: function () {
			return $('#endDate').val();
		}
	});
	$('#endDate').datepicker({
		uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd',
		minDate: function () {
			return $('#startDate').val();
		}
	});
    // timepicker
	$('.timepicker').timepicker({
        format: 'HH.MM'
    });
	$('.timepicker_2').timepicker({
        format: 'HH.MM'
    });

	// selectpicker
	$('.selectpicker').selectpicker();


    // privilege js
    $("tr .main_menu input").click(function () {
        // $(this).closest('tr').find('.sub_checked input:checkbox').not(this).prop('checked', this.checked).closest('.condition_group').find('.condition_btn').addClass('open');
        // $('.sub_checked input:checkbox').not(this).prop('checked', this.checked);

        var checkedd = $(this).closest('tr').find('.group_menu input:checkbox').not(this).prop('checked', this.checked);
            classHass = checkedd.closest('.condition_group').find('.condition_btn').hasClass('open');

        if(classHass) {
            checkedd.closest('.condition_group').find('.condition_btn').removeClass('open');
        } else {
            checkedd.closest('.condition_group').find('.condition_btn').addClass('open');
        }
        if(classHass) {
            checkedd.closest('.condition_group').find('> .custom-switch').removeClass('open');
        } else {
            checkedd.closest('.condition_group').find('> .custom-switch').addClass('open');
        }

        // action button checked
        $('.condition_group > .custom-switch input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $(this).closest('.condition_group').find('.condition_btn input:checkbox').not(this).prop('checked', this.checked);
            }
            else if($(this).prop("checked") == false){
                $(this).closest('.condition_group').find('.condition_btn input:checkbox').not(this).prop('checked', this.checked);
            }
        });
    });
    
    // same place even after refresh
    $('.aside_nav').scroll(function () {
        sessionStorage.scrollTop = $(this).scrollTop();
    });
    $(document).ready(function () {
        if (sessionStorage.scrollTop != "undefined") {
            $('.aside_nav').scrollTop(sessionStorage.scrollTop);
        }
    });
});
