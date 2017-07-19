
jQuery(document).ready(function () {
  jQuery('.button.section').on('click', function(){
    jQuery(this).next().toggle();
  });
  /*
  if(typeof  wdwt_is_customizer == 'undefined'){
    jQuery("select[multiple]").mousedown(function(e){
      e.preventDefault();
      var scroll = this.scrollTop;
      e.target.selected = !e.target.selected;
      this.scrollTop = scroll;
      jQuery(this).focus();
    }).mousemove(function(e){e.preventDefault()});  
  }
  */
  
});



var wdwt_elements = {
    checkbox_open : function(element){

    if (jQuery('#' + element.id).prop('checked')) {
      for (i = 0; i < element.show.length; i++) { 
        jQuery('#wdwt_wrap_'+element.show[i]).parent().parent().show();
      }
      for (i = 0; i < element.hide.length; i++) { 
        jQuery('#wdwt_wrap_'+element.hide[i]).parent().parent().hide();
      }
    }
    else{
      for (i = 0; i < element.show.length; i++) { 
        jQuery('#wdwt_wrap_'+element.show[i]).parent().parent().hide();
      }
      for (i = 0; i < element.hide.length; i++) { 
        jQuery('#wdwt_wrap_'+element.hide[i]).parent().parent().show();
      }
    }
  
  },
  diagram : {
    len : function(titles_together){
      var titles = titles_together.split(this.delimiter);
      return titles.length;
    },
    reset_diagram: function(element){
      /*copy and paste percent controls, modyfy only IDs*/
      for(var i = 1; i< element.number_percents; i++){
        jQuery("#wdwt_diagram_"+element.id+"_"+i).remove();
      }
      jQuery(".wdwt_diagram_"+element.id).eq(0).prop('class', "wdwt_diagram wdwt_diagram_"+element.id + " last_percent");
    },
    init : function(element){
      /*copy and paste percent controls, modyfy only IDs*/
      for(var i = 0; i< element.number_percents-1; i++){
        jQuery(".wdwt_diagram_"+element.id+".last_percent").clone().insertAfter(".wdwt_diagram_"+element.id+".last_percent");
        jQuery(".wdwt_diagram_"+element.id+".last_percent").eq(0).prop('class', "wdwt_diagram wdwt_diagram_"+element.id);
        jQuery(".wdwt_diagram_"+element.id+".last_percent").prop('id', "wdwt_diagram_"+element.id+"_"+(i+1));
        jQuery(".wdwt_diagram_"+element.id+".last_percent").find("#"+element.id+"_title_"+i).prop('id', element.id+"_title_"+(i+1));
        jQuery(".wdwt_diagram_"+element.id+".last_percent").find("#"+element.id+"_percent_"+i).prop('id', element.id+"_percent_"+(i+1));
        jQuery(".wdwt_diagram_"+element.id+".last_percent").find("#"+element.id+"_remove-button_"+i).prop('id', element.id+"_remove-button_"+(i+1));
      }

    },
    show : function(element){
      var titles = element.titles.split(this.delimiter);
      var percents = element.percents.split(this.delimiter);

      /*refresh values in visible inputs*/
      for(var i = 0; i< element.number_percents; i++){
        jQuery("#"+element.id+"_title_"+i).val(this.esc_attr_chars(titles[i]));
        jQuery("#"+element.id+"_percent_"+i).val(this.esc_attr_chars(percents[i]));
      }
    },
    insert : function(element, index, new_title){
      element.active = index;
      element.number_percents++;
      var titles = element.titles.split(this.delimiter);
      var percents = element.percents.split(this.delimiter);
      titles.splice(index+1, 0, "");
      percents.splice(index+1, 0, "");
      element.titles = titles.join(this.delimiter);
      element.percents = percents.join(this.delimiter);
      this.reset_diagram(element);
      this.init(element);
      this.show(element);
      this.update(element, "inserted");
    },
    remove : function(element){
      var index = element.active;
      if(element.number_percents > 1){
        this.reset_diagram(element);
        element.number_percents--;
      }
      else{
        /*no alert, just does not remove*/
        return;
      }
      if(element.active != 0){
        element.active--;
      };
      var titles = element.titles.split(this.delimiter);
      var percents = element.percents.split(this.delimiter);
      titles.splice(index, 1);
      percents.splice(index, 1);
      element.titles = titles.join(this.delimiter);
      element.percents = percents.join(this.delimiter);
      
      this.init(element);
      this.show(element);
      this.update(element, "deleted");

    },
    edit : function(element, index, param_edited){
      /*called when user edits inputs
        changes the value of element object and hidden inputs
      */
      switch(param_edited) {
        case 'title':
          var titles = element.titles.split(this.delimiter);
          titles[index] = this.esc_attr_chars(jQuery("#"+element.id+"_title_"+index).val());
          element.titles = titles.join(this.delimiter);
          /*update hidden fields and trigger chahges*/
          this.update(element, 'title');
          break;
        case 'percent':
          var percents = element.percents.split(this.delimiter);
          percents[index] = this.esc_attr_chars(jQuery("#"+element.id+"_percent_"+index).val());
          element.percents = percents.join(this.delimiter);
          /*update hidden fields and trigger chahges*/
          this.update(element, 'percent');
          break;
        default:
          /*do nothing*/
      }

    },
    delimiter : "||wd||",
    update : function(element, param_edited){
      switch(param_edited) {
        case 'title':
          jQuery("#"+element.id+"_titles").val(element.titles);
          jQuery("#"+element.id+"_titles").change();
          break;
        case 'percent':
          jQuery("#"+element.id+"_percents").val(element.percents);
          jQuery("#"+element.id+"_percents").change();
          break;
        case "inserted":
        case "deleted":
          jQuery("#"+element.id+"_titles").val(element.titles);
          jQuery("#"+element.id+"_percents").val(element.percents);
          jQuery("#"+element.id+"_titles").change();
          jQuery("#"+element.id+"_percents").change();
          break;
        default:
        /*do nothing*/
      }
    },
    esc_attr_chars : function(str){
      var tagsToReplace = {
          '&': '&amp;',
          '<': '&lt;',
          '>': '&gt;',
          '"' : '&quot',
          "'" : '&quot',
      };
    for (var tag in tagsToReplace) {
      str.replace(tag, tagsToReplace.tag);
    }
    return str;
    },
    find_index : function(dom_element, id_base){
      var elem_id = dom_element.prop("id");
      var st = id_base.length;
      var end = elem_id.length;
      var index = Number(elem_id.substring(st, end));
      return index;
    } 

  },
  
  select_open : function(element){
    var sel = jQuery('#' + element.id).val();
    /*hide all "show" elements*/
    for (i = 0; i < element.show.length; i++) {
      for (j = 0; j < element.show[i].val.length; j++) {
        jQuery('#wdwt_wrap_'+element.show[i].val[j]).parent().parent().hide();
      }
    }
    /*show only the elements with correct key*/
    for (i = 0; i < element.show.length; i++) {
      if(element.show[i].key == sel){
        for (j = 0; j < element.show[i].val.length; j++) {
          jQuery('#wdwt_wrap_'+element.show[i].val[j]).parent().parent().show();
        }
      }
    }
    /*hide all "hide" elements with correct key*/
    for (i = 0; i < element.hide.length; i++) {
      if(element.hide[i].key == sel){
        for (j = 0; j < element.hide[i].val.length; j++) {
          jQuery('#wdwt_wrap_'+element.hide[i].val[j]).parent().parent().hide();
        }
      }
    }
  },

  button_toggle : function(element){

    var first_to_toggle = element.show.length > 0 ? element.show[0] : (element.hide.length > 0 ? element.hide[0] : "undefined") ;
    
    if(first_to_toggle != "undefined"){
      /*which elements should be shown and which ones hidden onclick*/
      if (!jQuery('#' + first_to_toggle).is(":visible")) {
        for (i = 0; i < element.show.length; i++) { 
          jQuery('#wdwt_wrap_'+element.show[i]).parent().parent().show();
        }
        for (i = 0; i < element.hide.length; i++) { 
          jQuery('#wdwt_wrap_'+element.hide[i]).parent().parent().hide();
        }
      }
      else{
        for (i = 0; i < element.show.length; i++) {
          jQuery('#wdwt_wrap_'+element.show[i]).parent().parent().hide();
        }
        for (i = 0; i < element.hide.length; i++) { 
          jQuery('#wdwt_wrap_'+element.hide[i]).parent().parent().show();
        }
      }
    }
  },

  radio_open : function(element){

    var sel = jQuery('input[type=radio][name="' + element.name + '"]:checked').val();
    /*hide all "show" elements*/
    for (i = 0; i < element.show.length; i++) {
      for (j = 0; j < element.show[i].val.length; j++) {
        jQuery('#wdwt_wrap_'+element.show[i].val[j]).parent().parent().hide();
      }
    }
    /*show only the elements with correct key*/
    for (i = 0; i < element.show.length; i++) {
      if(element.show[i].key == sel){
        for (j = 0; j < element.show[i].val.length; j++) {
          jQuery('#wdwt_wrap_'+element.show[i].val[j]).parent().parent().show();
        }
      }
    }
    /*hide all "hide" elements with correct key*/
    for (i = 0; i < element.hide.length; i++) {
      for (j = 0; j < element.hide[i].val.length; j++) {
        jQuery('#wdwt_wrap_'+element.hide[i].val[j]).parent().parent().hide();
      }
    }
  },

  select_style : function(element){

    var param_val = jQuery('#' + element.id).val();
    jQuery('#' + element.text_preview).css( element.style_param, param_val );
  },
  refresh_colorpanel : function(element){

    var active = jQuery('#' + element.id).val();
    /*change active theme hidden index in colorpanel */
    jQuery('#active_' + element.cpanel).val(active);
    /*change colors values, defaults and backgrounds in pickers and color hidden inputs*/
    for (color in element.colors[active]) {
      colorname = element.colors[active][color].name;
      def = element.colors[active][color].def;
      val = element.colors[active][color].val;
      jQuery("#default_"+element.cpanel+"_"+colorname).prop("value", def);
      jQuery("#value_"+element.cpanel+"_"+colorname).prop("data-default-color",def);
      jQuery("#value_"+element.cpanel+"_"+colorname).wpColorPicker('defaultColor', def);
      jQuery("#value_"+element.cpanel+"_"+colorname).prop("value", val);
      jQuery("#value_"+element.cpanel+"_"+colorname).css("background-color", val);
      jQuery("#value_"+element.cpanel+"_"+colorname).parent().parent().find(".wp-color-result").css('background-color', val);
    }
  },
  slider : {
    len : function(urls_together){
      var urls = urls_together.split(this.delimiter);
      return urls.length;
    },
    reset_slider: function(element){
      /*copy and paste slide controls, modyfy only IDs*/
      for(var i = 1; i< element.number_slides; i++){
        jQuery("#wdwt_slide_"+element.id+"_"+i).remove();
      }
      jQuery(".wdwt_slide_"+element.id).eq(0).prop('class', "wdwt_slide wdwt_slide_"+element.id + " last_slide");
    },
    init : function(element){

      /*copy and paste slide controls, modyfy only IDs*/
      for(var i = 0; i< element.number_slides-1; i++){
        jQuery(".wdwt_slide_"+element.id+".last_slide").clone().insertAfter(".wdwt_slide_"+element.id+".last_slide");
        jQuery(".wdwt_slide_"+element.id+".last_slide").eq(0).prop('class', "wdwt_slide wdwt_slide_"+element.id);
        jQuery(".wdwt_slide_"+element.id+".last_slide").prop('id', "wdwt_slide_"+element.id+"_"+(i+1));
        jQuery(".wdwt_slide_"+element.id+".last_slide").find("#"+element.id+"_url_"+i).prop('id', element.id+"_url_"+(i+1));
        jQuery(".wdwt_slide_"+element.id+".last_slide").find("#"+element.id+"_update-button_"+i).prop('id', element.id+"_update-button_"+(i+1));
        jQuery(".wdwt_slide_"+element.id+".last_slide").find("#"+element.id+"_img_"+i).prop('id', element.id+"_img_"+(i+1));
        jQuery(".wdwt_slide_"+element.id+".last_slide").find("#"+element.id+"_href_"+i).prop('id', element.id+"_href_"+(i+1));
        jQuery(".wdwt_slide_"+element.id+".last_slide").find("#"+element.id+"_title_"+i).prop('id', element.id+"_title_"+(i+1));
        jQuery(".wdwt_slide_"+element.id+".last_slide").find("#"+element.id+"_descr_"+i).prop('id', element.id+"_descr_"+(i+1));
        jQuery(".wdwt_slide_"+element.id+".last_slide").find("#"+element.id+"_remove-button_"+i).prop('id', element.id+"_remove-button_"+(i+1));
      }

    },
    show : function(element){
      var urls = element.urls.split(this.delimiter);
      var hrefs = element.hrefs.split(this.delimiter);
      var titles = element.titles.split(this.delimiter);
      var descrs = element.descrs.split(this.delimiter);

      /*refresh values in visible inputs and preview img*/
      for(var i = 0; i< element.number_slides; i++){
        jQuery("#"+element.id+"_url_"+i).val(this.esc_attr_chars(urls[i]));
        jQuery("#"+element.id+"_img_"+i).prop('src',this.esc_attr_chars(urls[i]));
        jQuery("#"+element.id+"_href_"+i).val(this.esc_attr_chars(hrefs[i]));
        jQuery("#"+element.id+"_title_"+i).val(this.esc_attr_chars(titles[i]));
        jQuery("#"+element.id+"_descr_"+i).val(this.esc_attr_chars(descrs[i]));
      }
    },
    insert : function(element, index, new_url){
      element.active = index;
      element.number_slides++;
      var urls = element.urls.split(this.delimiter);
      var hrefs = element.hrefs.split(this.delimiter);
      var titles = element.titles.split(this.delimiter);
      var descrs = element.descrs.split(this.delimiter);
      urls.splice(index+1, 0, new_url);
      hrefs.splice(index+1, 0, "");
      titles.splice(index+1, 0, "");
      descrs.splice(index+1, 0, "");
      element.urls = urls.join(this.delimiter);
      element.hrefs = hrefs.join(this.delimiter);
      element.titles = titles.join(this.delimiter);
      element.descrs = descrs.join(this.delimiter);
      this.reset_slider(element);
      this.init(element);
      this.show(element);
      this.update(element, "inserted");
    },
    remove : function(element){
      var index = element.active;
      if(element.number_slides > 1){
        this.reset_slider(element);
        element.number_slides--;
      }
      else{
        alert(wdwt_slide_warning);
        return;
      }
      if(element.active != 0){
        element.active--;
      };
      var urls = element.urls.split(this.delimiter);
      var hrefs = element.hrefs.split(this.delimiter);
      var titles = element.titles.split(this.delimiter);
      var descrs = element.descrs.split(this.delimiter);
      urls.splice(index, 1);
      hrefs.splice(index, 1);
      titles.splice(index, 1);
      descrs.splice(index, 1);
      element.urls = urls.join(this.delimiter);
      element.hrefs = hrefs.join(this.delimiter);
      element.titles = titles.join(this.delimiter);
      element.descrs = descrs.join(this.delimiter);
      
      this.init(element);
      this.show(element);
      this.update(element, "deleted");

    },
    edit : function(element, index, param_edited){
      /*called when user edits inputs
        changes the value of element object and hidden inputs
      */
      switch(param_edited) {
        case 'url':
          var urls = element.urls.split(this.delimiter);
          urls[index] = this.esc_attr_chars(jQuery("#"+element.id+"_url_"+index).val());
          /*refresh*/
          jQuery("#"+element.id+"_img_"+index).prop('src',this.esc_attr_chars(urls[index]));
          element.urls = urls.join(this.delimiter);
          /*update hidden fields and trigger chahges*/
          this.update(element, 'url');
          break;
        case 'href':
          var hrefs = element.hrefs.split(this.delimiter);
          hrefs[index] = this.esc_attr_chars(jQuery("#"+element.id+"_href_"+index).val());
          element.hrefs = hrefs.join(this.delimiter);
          /*update hidden fields and trigger changes*/
          this.update(element, 'href');
          break;
        case 'title':
          var titles = element.titles.split(this.delimiter);
          titles[index] = this.esc_attr_chars(jQuery("#"+element.id+"_title_"+index).val());
          element.titles = titles.join(this.delimiter);
          /*update hidden fields and trigger chahges*/
          this.update(element, 'title');
          break;
        case 'descr':
          var descrs = element.descrs.split(this.delimiter);
          descrs[index] = this.esc_attr_chars(jQuery("#"+element.id+"_descr_"+index).val());
          element.descrs = descrs.join(this.delimiter);
          /*update hidden fields and trigger chahges*/
          this.update(element, 'descr');
          break;
        default:
          /*do nothing*/
      }

    },
    delimiter : "||wd||",
    empty_str : function(n){
      empty_str = '';
      for(var i = 0; i< n-1; i++){
        empty_str += this.delimiter;
      }
      return empty_str;
    },
    update : function(element, param_edited){
      switch(param_edited) {
        case 'url':
          jQuery("#"+element.id+"_urls").val(element.urls);
          jQuery("#"+element.id+"_urls").change();
          break;
        case 'href':
          jQuery("#"+element.id+"_hrefs").val(element.hrefs);
          jQuery("#"+element.id+"_hrefs").change();
          break;
        case 'title':
          jQuery("#"+element.id+"_titles").val(element.titles);
          jQuery("#"+element.id+"_titles").change();
          break;
        case 'descr':
          jQuery("#"+element.id+"_descrs").val(element.descrs);
          jQuery("#"+element.id+"_descrs").change();
          break;
        case "inserted":
        case "deleted":
          jQuery("#"+element.id+"_urls").val(element.urls);
          jQuery("#"+element.id+"_hrefs").val(element.hrefs);
          jQuery("#"+element.id+"_titles").val(element.titles);
          jQuery("#"+element.id+"_descrs").val(element.descrs);
          jQuery("#"+element.id+"_urls").change();
          jQuery("#"+element.id+"_hrefs").change();
          jQuery("#"+element.id+"_titles").change();
          jQuery("#"+element.id+"_descrs").change();
          break;
        default:
        /*do nothing*/
      }
    },
    esc_attr_chars : function(str){
      var tagsToReplace = {
          '&': '&amp;',
          '<': '&lt;',
          '>': '&gt;',
          '"' : '&quot',
          "'" : '&quot',
      };
    for (var tag in tagsToReplace) {
      str.replace(tag, tagsToReplace.tag);
    }
    return str;
    },
    find_index : function(dom_element, id_base){
      var elem_id = dom_element.prop("id");
      var st = id_base.length;
      var end = elem_id.length;
      var index = Number(elem_id.substring(st, end));
      return index;
    } 

  },
  
  

};
