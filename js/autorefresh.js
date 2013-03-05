
    jq('div').live('pagebeforeshow', function(event, ui){
      var page = jq(event.target);

      var url = page.attr('data-refresh');

      if(url){
        var ajax = {};
        ajax.url = url;
        ajax.type = 'GET';
        ajax.cache = false;
        ajax.data = {'refresh' : true };
        ajax.async = false;

        ajax.success = function(data){
          var hidden = jq(data).hide().appendTo(jq.mobile.pageContainer);
          html = hidden.html();

          page.html(html);

// TODO - how to properly initialize the page?
//
          page.page();

          var all = jq("<div></div>");
          all.get(0).innerHTML = html; // force <script> tags to fire...
        };

        jq.ajax(ajax);
      };
    });
