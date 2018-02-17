(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.tpoPopup = {
    attach: function (context, settings) {
      $('body', context).once('tpoPopup').each(function () {
        //Stores all setting information from tpo popups as passed in by php drupal settings
        var createPopupMarkup = function(paragraphBodyMarkup, modalID, classOfDisplay) {
              //Stores all the markup of the modal giving each popup a unique ID. Also inserts the markup from the paragraph info.



              var markup = [
                '<div class="'+ classOfDisplay +' modal fade" id="tpo_popup_' + modalID + '" role="dialog" data-backdrop="false" >',
                ' <div class="modal-dialog">',
                '   <div class="modal-content">',
                '     <div class="modal-header">',
                '       <button type="button" class="close" data-dismiss="modal">&times;</button>',
                '     </div>',
                '     <div class="modal-body">',
                paragraphBodyMarkup,
                '     </div>',
                '   </div>',
                ' </div>',
                '</div>'
              ].join('\n');

              var $markup = $(markup,{html:markup});

              //Removes the contianer of the paragraph and content-wpr unset to float so paragraphs show properly.
              $markup.find('.content-wpr').css({'float': 'unset'});
              $markup.find('.container').removeClass();
              $markup.find('article.tpo-popup').children().not('div.content').remove();

              return $markup;
            },
            getDisplayClass = function(displayType) {
              //Sets the class depending on the options chosen by the user for display type
              var classOfDisplay = null;
              switch(displayType) {
                case 'Drawer':
                  classOfDisplay = 'tpo_popup_display_drawer';
                  if(!$('body').hasClass('tpo_body_popup_drawer_override')){
                    $('body').addClass('tpo_body_popup_drawer_override');
                  };
                  break;
                case 'Modal':
                default:
                  classOfDisplay = 'tpo_popup_display_modal'
              }
              return classOfDisplay;
            },
            checkIfPopupCanShow = function(popupID, popupObject) {
              //Used to determine if a popup can show up

              //First  gets the scroll settings and the delay settings, also sets a variable to determine if the user has scrolled passed desired location
              var userDelaySetting = popupObject['action']['delay'],
                  userScrollSetting = popupObject['action']['scroll'],
                  userScrollPassed = false;

              //First check if the user scroll setting exists, if it does then run logic for scroll
              if(userScrollSetting !== null) {
                $(context).scroll(function() {
                  var scrollPercent = 100 * $(window).scrollTop() / ($(document).height() - $(window).height());
                  if (scrollPercent >= userScrollSetting && userScrollPassed === false){
                    userScrollPassed = true;
                    displayPopup(popupID);
                  }
                });
              }
              else if(userDelaySetting !== null) {
                //Otherwise, run the logic for the user delay on tpo popups
                setTimeout(function() {
                  displayPopup(popupID);
                }, userDelaySetting*1000);
              }
            },
            createCookie = function (cname, cvalue, exdays) {
              //Used to create a cookie
              var d = new Date();
              d.setTime(d.getTime() + (exdays*24*60*60*1000));
              var expires = "expires="+ d.toUTCString();
              document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            },
            getCookie = function (cname) {
              //Used to get cookie information, returns null if cookie does not exist
              var name = cname + "=";
              var decodedCookie = decodeURIComponent(document.cookie);
              var ca = decodedCookie.split(';');
              for(var i = 0; i <ca.length; i++) {
                  var c = ca[i];
                  while (c.charAt(0) == ' ') {
                      c = c.substring(1);
                  }
                  if (c.indexOf(name) == 0) {
                      return c.substring(name.length, c.length);
                  }
              }
              return null;
            },
            getImpressionsStorage = function(popupID) {
              //Gets the impression stored information either uses local storage or cookie storage depending on what the users browser supports
              if (typeof(Storage) !== "undefined") {
                var impressionStoredValue = localStorage.getItem(popupID.concat("_tpo_popup_impression"));
                return impressionStoredValue;
              } else {
                var cookieValue = getCookie(popupID.concat("_tpo_popup_impression"));
                return cookieValue;
              }
            },
            setImpressionsStorage = function(popupID, popupImpressions) {
            //Sets the impression stored information either uses local storage or cookie storage depending on what the users browser supports
              if (typeof(Storage) !== "undefined") {
                localStorage.setItem(popupID.concat("_tpo_popup_impression"), popupImpressions);
              } else {
                createCookie(popupID.concat("_tpo_popup_impression"), popupImpressions,90);
              }
            },
            insertPopup = function(popupID,popupObject) {
              //Inserts the popup markup in the appropriate location of the page for displaying
              $('#page-wrapper',context).once('TpoPopupBehavior').first().append(createPopupMarkup(popupObject['body'],popupID,getDisplayClass(popupObject['action']['display'])));
            },
            displayPopup = function(popupID) {
              var nameOfId = "#tpo_popup_"+popupID;
              $("#tpo_popup_"+popupID).modal();
            };


        //Runs logic for each popup that is detected in the tpo popup information passed from PHP
        $.each( drupalSettings.tpo_popup, function( popupID, popupObject ) {
          var currentImpressions = 0;

          //First sets the current impression from stored information
          if (getImpressionsStorage(popupID) !== null ) {
            currentImpressions = Number(getImpressionsStorage(popupID));
          }

          //If the current impression for this popup is below the impression count or equal then it runs popup logic
          if (currentImpressions < Number(popupObject['impressions'])){
            insertPopup(popupID,popupObject);
            checkIfPopupCanShow(popupID,popupObject);
          }

          //Adds one to the impression count and stores it away for later use.
          setImpressionsStorage(popupID, ++currentImpressions)
        });
      });
    }
  };
})(jQuery, Drupal, drupalSettings);
