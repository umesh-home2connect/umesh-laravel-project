var Theme = function () {
	
	var chartColors, validationRules = getValidationRules();
	
	return { init: init,validationRules: validationRules };

	function init () {	

                if($.fn.geocomplete){
                    $("input#attorney_location").geocomplete({
//                      country: "IN",
                      details: 'form#attorney-search-form'
                //    location: "New Delhi"
                    });
                    $("input#question_location").geocomplete({
                      details: 'form#ask-question'
                    });
                }   
                
                if($.fn.dcAccordion){
                    $('#nav-accordion, #admin_leftmenu').dcAccordion({
                        eventType: 'click',
                        autoClose: true,
                        saveState: true,
                        disableLink: true,
                        speed: 'slow',
                        showCount: false,
                        autoExpand: true,
                //        cookie: 'dcjq-accordion-1',
                        classExpand: 'dcjq-current-parent'
                    });
                }
		if ($.fn.cirque) {
			$('.ui-cirque').cirque ({  });
		}
		if ($.fn.lightbox) {
			$('.lightbox').lightbox();
		}
                if ($.fn.tooltip) {
                    $('.tooltips').tooltip();
                }
                
                if ($.fn.popover) {
                    $('.popovers').popover();
                }
                
                if ($.fn.bxSlider) {
                    $('.slider1').bxSlider({
                        slideWidth: 400,
                        minSlides: 4,
                        maxSlides: 5,
                        moveSlides: 1,
                        slideMargin: 5
                    });
                }
                
                if ($.fn.tagsInput) { 
			$('.tagsinput').tagsInput();			
		}
                //for dropdown selection multiple items
                if ($.fn.select2) { 
			$(".multi-select-dropdown").select2({
                        // minimumInputLength: 2,
                           maximumSelectionSize: 4,
                        // minimumResultsForSearch : 4,
                           width : '100%',
                           separator: ","
                      });		
		}
                
                //for multiselect searchable
                
                 if ($.fn.multiSelect) { 
                     $('#my_multi_select3').multiSelect({
                    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    afterInit: function (ms) {
                        var that = this,
                            $selectableSearch = that.$selectableUl.prev(),
                            $selectionSearch = that.$selectionUl.prev(),
                            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                            .on('keydown', function (e) {
                                if (e.which === 40) {
                                    that.$selectableUl.focus();
                                    return false;
                                }
                            });

                        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                            .on('keydown', function (e) {
                                if (e.which == 40) {
                                    that.$selectionUl.focus();
                                    return false;
                                }
                            });
                    },
                    afterSelect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    },
                    afterDeselect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    }
                });			
		}
	
		$('#wrapper').append ('<div class="push"></div>');
	}
	
//	function enhancedAccordion () {
//		$('.accordion').on('show', function (e) {
//	         $(e.target).prev('.accordion-heading').parent ().addClass('open');
//	    });
//	
//	    $('.accordion').on('hide', function (e) {
//	        $(this).find('.accordion-toggle').not($(e.target)).parents ('.accordion-group').removeClass('open');
//	    });
//	    
//	    $('.accordion').each (function () {	    	
//	    	$(this).find ('.accordion-body.in').parent ().addClass ('open');
//	    });
//	}
	
	function getValidationRules () {
		var custom = {
	    	focusCleanup: false,
			
			wrapper: 'div',
			errorElement: 'span',
			
			highlight: function(element) {
				$(element).parents ('.form-group').removeClass ('success').addClass('error');
                                $(element).parents ('.controls').find ('div:last').addClass('js_error_notification');
			},
			success: function(element) {
				$(element).parents ('.form-group').removeClass ('error').addClass('success');
//				$(element).parents ('.controls:not(:has(.clean))').find ('div:last').before ('<div class="clean"></div>');
			},
			errorPlacement: function(error, element) {
				error.appendTo(element.parents ('.controls'));
                                $(element).parents ('.controls').find ('div:last').addClass('js_error_notification');
			}
	    	
	    };
	    
	    return custom;
	}
	
}();


jQuery(document).ready(function() {
    
  Theme.init();

  jQuery('form').each(function(){
    var form_class  = jQuery(this).attr('class');
    var form_id     = jQuery(this).attr('id');
    if (form_class.indexOf("jquery-validate") != -1) {
//      var selector = 'form.jquery-validate';
      var selector = 'form#'+form_id;
      console.log('this is '+selector);
      jquery_form_validate(selector);
    }
    if (form_class.indexOf("jquery-admin-validate") != -1) {
      var selector = 'form#'+form_id;
      console.log('this is '+selector);
      jQuery(selector).validate();
    }
  });
  
    /*
     * Left menu selected code for client attorney
     */
//    var url = window.location.href; 
//
//    jQuery(".sidebar-menu a").each(function() {
//        
//        if(url == (this.href)) { 
//            jQuery(this).closest("li").addClass("active");
//            jQuery(this).parents(":eq(2)").addClass("active");
//            jQuery(this).parents(":eq(2)").children("a").addClass("active");
//        }
//    });
  

  
});


function jquery_form_validate(selector) {
  var rules = {
    rules: {
    }
  };

  var validationObj = jQuery.extend(rules, Theme.validationRules);

  jQuery(selector).validate(validationObj);
}

function jquery_custom_form_validate(selector) {
  var rules = {
      onkeyup: false, 
    rules: {
    }
  };

  var validationObj = jQuery.extend(rules, Theme.validationRules);

  jQuery(selector).validate(validationObj);
}

