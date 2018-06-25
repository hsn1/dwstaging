jQuery('.qafp-faq-anchor').click(function() {
  //alert('click event');
  var eventValue = jQuery(this).text();
  console.log(eventValue);
  var eventCategory = jQuery(this).parents('.qafp-faq-title').hasClass('active')? "Close" : "Open";
  //alert(eventCategory);
  if("ga" in window)
  {
    console.log(window.ga);
    //alert('ga in window');
    //ga('send','event', 'FAQs', 'Open');
    ga('send', {
      'hitType': 'event',         
      'eventCategory': 'FAQs', 
      'eventAction': eventCategory,  
      'eventLabel' : eventValue,
      'hitCallback' : function () {
          console.log("Event received");
       }
    });
    //alert('ga2 in window');
  }
  else
  {
    alert('Could not make tracking right now');
  }


});
jQuery('.copy').find('div').first().click(function() {
console.log('hohohoho');
console.log('first');
console.log(jQuery(this).find('a').attr('href'));
var firstlayer = jQuery(this).find('a').attr('href').split("?");
console.log("firstlayer="+firstlayer);
var secondlayer = firstlayer[firstlayer.length-1].split("&");
console.log("secondlayer="+secondlayer);
var thridlayer = secondlayer[0].split("=");
console.log("thridlayer="+thridlayer);
var fourthlayer = thridlayer[thridlayer.length-1];
console.log("4="+fourthlayer);
console.log('heheheehhe');
//var iddelim = jQuery(this).find('a').attr('id').split("-");
//var idvid = iddelim[iddelim.length-2]+'-'+iddelim[iddelim.length-1];
var idvid = fourthlayer;
var api_key = 'AIzaSyB_qS8h_MXq9xd_MPsUITEaR0fKGRP-KHc';
var title = '';
var url_api = 'https://www.googleapis.com/youtube/v3/videos?key='+api_key+'&part=snippet&id='+idvid;
    jQuery.getJSON(url_api, function (data) {
      console.log('step1');
        jQuery.each(data, function (i, field) {
            var textNode = document.createTextNode(i+ " " +JSON.stringify(field));
            //alert('no items');
            if(i=='items')
            {
              console.log(' items');
               console.log(i.length);
                console.log(data.items);
               jQuery.each(data.items, function (i, field) {
                console.log("i="+i);
                if(field.snippet!=null)
                {
                  console.log(field.snippet);
                  jQuery.each(field.snippet, function (i, field1) {
                    if(field1.title!=null)
                    {
                      console.log('title= '+field1.title);
                      title = field1.title;
                      console.log(title);
                      if("ga" in window)
                      {
                        console.log(window.ga);
                        //alert('ga in window');
                        //ga('send','event', 'FAQs', 'Open');
                        ga('send', {
                          'hitType': 'event',         
                          'eventCategory': 'Videos', 
                          'eventAction': 'Play',  
                          'eventLabel' : title,
                          'hitCallback' : function () {
                              console.log("Event received");
                           }
                        });
                        console.log('ga2 in window');
                      }
                      else
                      {
                        alert('Could not make tracking right now');
                      }
                    }
                  });
                }
               });
            } 
           
        });
    });
    
});

jQuery('.fitvid').click(function() {
  var iddelim = jQuery(this).find('span').attr('data-mfp-src').split("=");
  var idvid = iddelim[iddelim.length-1];

  var api_key = 'AIzaSyB_qS8h_MXq9xd_MPsUITEaR0fKGRP-KHc';
  var title = '';
  var url_api = 'https://www.googleapis.com/youtube/v3/videos?key='+api_key+'&part=snippet&id='+idvid;
  
  jQuery.getJSON(url_api, function (data) {
        jQuery.each(data, function (i, field) {
            var textNode = document.createTextNode(i+ " " +JSON.stringify(field));
            //alert('no items');
            if(i=='items')
            {
              console.log(' items');
               console.log(i.length);
                console.log(data.items);
               jQuery.each(data.items, function (i, field) {
                console.log("i="+i);
                if(field.snippet!=null)
                {
                  console.log(field.snippet);
                  jQuery.each(field.snippet, function (i, field1) {
                    if(field1.title!=null)
                    {
                      console.log('title= '+field1.title);
                      title = field1.title;
                      console.log(title);
                      if("ga" in window)
                      {
                        console.log(window.ga);
                        console.log('ga in window');
                        //ga('send','event', 'FAQs', 'Open');
                        ga('send', {
                          'hitType': 'event',         
                          'eventCategory': 'Videos', 
                          'eventAction': 'Play',  
                          'eventLabel' : title,
                          'hitCallback' : function () {
                              console.log("Event received");
                           }
                        });
                        console.log('ga2 in window');
                      }
                      else
                      {
                        alert('Could not make tracking right now');
                      }
                    }
                  });
                }
               });
            } 
           
        });
  });
});

jQuery('#how_menu').find('.title').click(function() {
  var eventLabel = jQuery(this).find('strong').text();
  console.log('eventLabel='+eventLabel);
  if("ga" in window)
  {
    console.log(window.ga);
    console.log('ga in window');
    //ga('send','event', 'FAQs', 'Open');
    ga('send', {
      'hitType': 'event',         
      'eventCategory': 'Slideshows', 
      'eventAction': 'Click',  
      'eventLabel' : eventLabel,
      'hitCallback' : function () {
          console.log("Event received");
       }
    });
    console.log('ga2 in window');
  }
  else
  {
    alert('Could not make tracking right now');
  }
});

jQuery('.feature_row').find('div').click(function() {
  var eventLabel = 'How-it-works:'+jQuery(this).find('h1').text();
  if("ga" in window)
  {
    console.log(window.ga);
    console.log('gaaa in window');
    console.log(eventLabel);
    //ga('send','event', 'FAQs', 'Open');
    ga('send', {
      'hitType': 'event',         
      'eventCategory': 'Slideshows', 
      'eventAction': 'Zoom',  
      'eventLabel' : eventLabel,
      'hitCallback' : function () {
          console.log("Event received");
       }
    });
    console.log('ga2 in window');
  }
  else
  {
    alert('Could not make tracking right now');
  }
});

//populate all element that has href  containing yoube link with onclick event
jQuery('.qafp-faq-answer').find('li').find('a').each(function() {
  console.log(jQuery(this).attr('href'));
  var youtubelink = jQuery(this).attr('href');
  jQuery(this).attr('onclick','track_youtube_link("'+youtubelink+'")');
});

jQuery('#player').click(function() {
  console.log('here player');
  var youtubelink = jQuery(this).attr('href');
  jQuery(this).attr('onclick','console.log("player");');
});
//function handling click on youtubelink
function track_youtube_link(link)
{
console.log('here');
var split_id = link.split('=');
var idvid = split_id[split_id.length-1];
var api_key = 'AIzaSyB_qS8h_MXq9xd_MPsUITEaR0fKGRP-KHc';
  var title = '';
  var url_api = 'https://www.googleapis.com/youtube/v3/videos?key='+api_key+'&part=snippet&id='+idvid;
  jQuery('#player').attr('onclick','alert("test")');
  console.log('here2#player');
  jQuery.getJSON(url_api, function (data) {
        jQuery.each(data, function (i, field) {
            var textNode = document.createTextNode(i+ " " +JSON.stringify(field));
            //alert('no items');
            if(i=='items')
            {
              console.log(' items');
               console.log(i.length);
                console.log(data.items);
               jQuery.each(data.items, function (i, field) {
                console.log("i="+i);
                if(field.snippet!=null)
                {
                  console.log(field.snippet);
                  jQuery.each(field.snippet, function (i, field1) {
                    if(field1.title!=null)
                    {
                      console.log('title= '+field1.title);
                      title = field1.title;
                      console.log(title);
                      if("ga" in window)
                      {
                        console.log(window.ga);
                        console.log('ga in window');
                        //ga('send','event', 'FAQs', 'Open');
                        ga('send', {
                          'hitType': 'event',         
                          'eventCategory': 'Videos', 
                          'eventAction': 'Open',  
                          'eventLabel' : title,
                          'hitCallback' : function () {
                              console.log("Event received");
                           }
                        });
                        console.log('ga2 in window');
                        /*if(jQuery('body').find('#fancybox-frame')==null )
                        {
                          console.log('funcking true');
                        }
                        else
                        {
                          console.log('funcking false');
                          console.log('++++++++++++');
                          console.log(jQuery('body').find('#fancybox-frame'));
                          console.log('===============');
                          console.log(jQuery('body').find('#fancybox-frame').contents());
                          console.log('-------------');
                          console.log(jQuery('body').find('#fancybox-frame').contentWindow);
                          //jQuery('body').find('#fancybox-frame').contents().find('body').find('#player').attr('style','display:none');
                          console.log(jQuery('body').find('#fancybox-frame').contents().find("html").html());                           
                        }
                        jQuery.when( jQuery('body').find('#fancybox-frame')!=null ).done(function( x ) {
                          console.log('done finally'); // Alerts "123"
                        });*/
                        console.log('###EDIT1 TRIGGER FUNCTION####');
                        ytTracker.init();
                        var iframes = document.getElementsByTagName( 'iframe' );
                        console.log(iframes);
                        ytTracker.digestPotentialVideos(iframes); 
                        console.log('###DONE TRIGGERING FUNCTION####');
                        jQuery.ajax({
                          url:'https://www.datawinners.com/wp-content/themes/department/ajax/create_session_popup_close.php',
                          type: 'POST',
                          data: jQuery.param({ vidTitle: title}) ,
                          success:function(results){console.log(results);console.log('success');},
                          error:function(results){console.log("###############");console.log(results);console.log('error request');}
                        });
                      }
                      else
                      {
                        alert('Could not make tracking right now');
                      }
                    }
                  });
                }
               });
            } 
           
        });
  });
}