<?php
/// random post widget
$wdwt_random_post_id=0;

  class best_magazine_random_post extends WP_Widget {

  // Constructor //

    function __construct() {
      $widget_ops = array( 'classname' => WDWT_VAR.'_random_post', 'description' => __( 'Spider Random Post allows you to show posts in a random order in a sidebar.', "best-magazine" ) ); // Widget Settings
      $control_ops = array( 'id_base' => WDWT_VAR.'_random_post' ); // Widget Control Settings
      parent::__construct( WDWT_VAR.'_random_post', sprintf(__( '%s Random  Posts', "best-magazine" ), WDWT_TITLE ), $widget_ops, $control_ops ); // Create the widget
    }

  // Extract Args //

    function widget($args, $instance) {
      extract( $args );
      $title=$instance['title'];  
      $url = plugins_url();
      global $wdwt_random_post_id;
  // Before widget //
  

      echo $before_widget;

  // Title of widget //

      if ( $title ) { echo $before_title . $title . $after_title; }

  // Widget output //








if($wdwt_random_post_id==0){
      /////// print script code one time
?>
<script type="text/javascript">

function autoUpdate(id,time,category,limit,style,text_for_insert){

  document.getElementById('randarticle_'+id).innerHTML=text_for_insert;
var t=Math.floor(Math.random()*4+1);


    
    if (style==5){

style=t;
 

}

  if (style == 1){
 jQuery("#randarticle_"+id+"").ready(function()
  {   
  jQuery("#randarticle_"+id+"").animate({
     
    opacity: 1,
  margin:'0in' ,   
    fontSize: "1em"
    
  },1000 );
});
   setTimeout("style("+id+","+style+","+time+','+category+','+limit+")", time*1000);  
  }
 
 
  if (style == 2){
 jQuery("#randarticle_"+id+"").ready(function()
  {
    jQuery("#randarticle_"+id+"").animate({
     
    opacity: 1,
    
    fontSize: "1.2em"
    
  },700 );
  
  jQuery("#randarticle_"+id+"").animate({
     
    opacity: 1,
    
    fontSize: "1em"
    
  } ,300);
});
   setTimeout("style("+id+","+style+","+time+','+category+','+limit+")", time*1000);
  }
  
  if (style == 3){
 jQuery("#randarticle_"+id+"").ready(function()
  {
   jQuery("#randarticle_"+id+"").animate({
     
    opacity: 1,
    
    fontSize: "1em"
    
  }, 1000 );
  });
   setTimeout("style("+id+","+style+","+time+','+category+','+limit+")", time*1000);  
  }
  
  if (style == 4){
document.getElementById("randarticle_"+id).style.overflow="hidden";
jQuery("#randarticle_"+id+"").ready(function()
  {
  jQuery("#randarticle_"+id+"").animate({
    width: "100%",
    opacity: 1,
    fontSize: "1em"
    
  },1000);
  });
  
   setTimeout("style("+id+","+style+","+time+','+category+','+limit+")", time*1000);  
  }
  
}





function style(id,style,time,category,limit)
{ 
if (style == 1)
{
   jQuery("#randarticle_"+id+"").ready(function()
  {
    
    jQuery("#randarticle_"+id+"").animate({
    
    opacity: 0,
  
    marginLeft: "0.6in",
   fontSize: "1em"
    
  },1000 );
  
    
  }); 
}
if (style == 2)
{

   jQuery("#randarticle_"+id+"").ready(function()
  {
    
    jQuery("#randarticle_"+id+"").animate({
    
    opacity: 0,
  
    
   fontSize: "0em"
    
  },1000 );
 
    
  }); 
}


if (style == 3)
{
   jQuery("#randarticle_"+id+"").ready(function()
  {
    
    jQuery("#randarticle_"+id+"").animate({
    
    opacity: 0,
  
    
   fontSize: "1em"
    
  }, 1000 );
 
    
  }); 
}

if (style == 4)
{
     jQuery("#randarticle_"+id+"").ready(function()
  {
    
 jQuery("#randarticle_"+id).animate({
    width: "0.0%"
    
  }, 1000);
});   


}
document.getElementById("randarticle_"+id).style.overflow="hidden"; 
setTimeout("ajax_for_post("+id+","+time+","+category+","+limit+","+style+")",2000);
}

function ajax_for_post(id,time,category,limit,style){
  jQuery.ajax({
     url: "<?php echo admin_url( 'admin-ajax.php' )."?action=wdwt_random_post&categori_id="; ?>"+category+"&count_pages="+limit+"&rand="+Math.floor(Math.random()*100000000000000)
    }).done(function(responseText) { 
   autoUpdate(id,time,category,limit,style,responseText);
});
}

function Update(id,time,category,limit,style)
{

  document.getElementById('randarticle_'+id).style.display='none';
  jQuery.fx.interval = 1;

jQuery("#randarticle_"+id+"").ready(function(){
  
  jQuery("#randarticle_"+id+"").fadeIn( 1000 );
}); 
  
var xmlHttp;
  try{  
    xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
  }
  catch (e){
    try{
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
    }
    catch (e){
        try{
        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch (e){
        alert("No AJAX!?");
        return false;
      }
    }
  }

xmlHttp.onreadystatechange=function(){
  if(xmlHttp.readyState==4){
    document.getElementById('randarticle_'+id).innerHTML=xmlHttp.responseText;
    <?php
if ($instance['AutoUpdate'] ==1 )
echo "autoUpdate(id,time,category,limit,style,xmlHttp.responseText);";
?>
  }
}

xmlHttp.open("GET","<?php echo admin_url( 'admin-ajax.php' )."?action=wdwt_random_post&categori_id="; ?>"+category+"&count_pages="+limit+"&rand="+Math.floor(Math.random()*100000000000000),true);
xmlHttp.send(null);

}






</script>
<?php 


 }// enf if 
 
 

  ?>
<div  id="randarticle_<?php echo $wdwt_random_post_id ?>" >
<?php
global $wdwt_random_post_id;
echo "<script type='text/javascript'> Update(".$wdwt_random_post_id.",".$instance['Updating_Time'].",".$instance['Category'].",".$instance['quantity_of_posts'].",".$instance['Style_sra'].");  </script>";
  
$wdwt_random_post_id++;   
?>
</div>
<?php
  // After widget //

      echo $after_widget;
    }






  // Update Settings //
  
  
  
  
  

    function update($new_instance, $old_instance) {
      $instance['title']           = strip_tags($new_instance['title']);   // title
      $instance['Category']        = $new_instance['Category']; /// Post quantity
      $instance['quantity_of_posts']     = $new_instance['quantity_of_posts']; /// Post quantity
      $instance['AutoUpdate']        = $new_instance['AutoUpdate']; /// update automatic or no
      $instance['Style_sra']             = $new_instance['Style_sra'];  // custom style
      $instance['Updating_Time']         = $new_instance['Updating_Time']; /// time for updating posts or post

      return $instance;  /// return new value of parametrs
    }
    
    
    
    

  // Widget Control Panel //

    function form($instance) {
    $url = plugins_url(); //url plugin

    $defaults = array( 'title' => '', 'Category' => '1', 'quantity_of_posts' => '1', 'AutoUpdate' => '1', 'Style_sra' =>'1',  'Updating_Time' => '10');
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:',"best-magazine"); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
    </p>
       <table width="100%" class="paramlist admintable" cellspacing="1">
<tbody>

<tr>
<td style="width:120px" class="paramlist_key"><span class="editlinktip"><label style="font-size:10px" id="paramsstandcatid-lbl" for="Category" class="hasTip"><?php echo __('Select Category',"best-magazine"); ?></label></span></td>
<td class="paramlist_value">
<select name="<?php echo $this->get_field_name('Category'); ?>" id="<?php echo $this->get_field_id('category') ?>" style="font-size:10px" class="inputbox">
<option value="0"><?php echo __('Select Category',"best-magazine"); ?></option>

<?php 
$categories=get_categories();
$category_count=count($categories);
for($i=0;$i<$category_count;$i++)
{
?>


<option value="<?php if(isset($categories[$i])) echo $categories[$i]->term_id?>" <?php selected(isset($categories[$i]) && $instance['Category']==$categories[$i]->term_id); ?>><?php if(isset($categories[$i])) echo $categories[$i]->name ?></option>

<?php
}
 ?>
</select>
</td>
</tr>
<tr>
<tr><td><br /></td></tr>
<td style="width:120px" class="paramlist_key"><span class="editlinktip"><label style="font-size:10px" id="paramsrand_show-lbl" for="quantity_of_posts"><?php echo __('Quantity of Posts:',"best-magazine"); ?></label></span></td>
<td class="paramlist_value"><input type="text" name="<?php echo $this->get_field_name('quantity_of_posts'); ?>" id="<?php echo $this->get_field_id('quantity_of_posts') ?>" value="<?php echo $instance['quantity_of_posts']; ?>" class="text_area" size="3"></td>
</tr>
<tr><td><br /></td></tr>
<tr>
<td style="width:120px" class="paramlist_key"><span class="editlinktip"><label style="font-size:10px"  for="autoupdate"><?php echo __('Auto Update',"best-magazine"); ?></label></span></td>
<td class="paramlist_value"><span id="cuca"></span>
<input type="radio" name="<?php echo $this->get_field_name('AutoUpdate'); ?>" value="0" <?php checked($instance['AutoUpdate'],0); ?>  onchange="document.getElementById('<?php echo $this->get_field_id('Updating_Time') ?>time_sec').setAttribute('style','display:none')" id="showup0"><?php echo __(' No',"best-magazine"); ?>
<input type="radio" name="<?php echo $this->get_field_name('AutoUpdate'); ?>" value="1" <?php checked($instance['AutoUpdate'],1); ?> onchange="document.getElementById('<?php echo $this->get_field_id('Updating_Time') ?>time_sec').removeAttribute('style');" id="showup1"> <?php echo __('Yes',"best-magazine"); ?>

        </td>
</tr>
<tr><td><br /></td></tr>
<tr>
<td width="120px" class="paramlist_key"><span class="editlinktip"><label style="font-size:10px" id="paramsstyle-lbl" for="Style_sra"><?php echo __('Visualization',"best-magazine"); ?></label></span></td>
<td class="paramlist_value">
<select name="<?php echo $this->get_field_name('Style_sra'); ?>" id="<?php echo $this->get_field_id('Style_sra') ?>" class="inputbox">
  <option value="1" <?php selected($instance['Style_sra'],1); ?>><?php echo __('Style 1',"best-magazine"); ?></option>
    <option value="2" <?php selected($instance['Style_sra'],2); ?>><?php echo __('Style 2',"best-magazine"); ?></option>
    <option value="3" <?php selected($instance['Style_sra'],3); ?>><?php echo __('Style 3',"best-magazine"); ?></option>
    <option value="4" <?php selected($instance['Style_sra'],4); ?>><?php echo __('Style 4',"best-magazine"); ?></option>
    <option value="5" <?php selected($instance['Style_sra'],5); ?>><?php echo __('Random',"best-magazine"); ?></option>
</select></td>
</tr>
<tr><td><br /></td></tr>
<tr id="<?php echo $this->get_field_id('Updating_Time') ?>time_sec" <?php if(!$instance['AutoUpdate']==1) echo   'style="display:none"'; ?>>
<td style="width:120px" class="paramlist_key"><span class="editlinktip"><label style="font-size:10px" for="Updating_Time"><?php echo __('Time of update(sec)',"best-magazine"); ?></label></span></td>
<td class="paramlist_value">
<input type="text" name="<?php echo $this->get_field_name('Updating_Time'); ?>" id="<?php echo $this->get_field_id('Updating_Time') ?>" value="<?php echo $instance['Updating_Time']; ?>" size="3">
        </td>
</tr>
</tbody></table>
         <?php }
    

}

// End class random_post

add_action('widgets_init', create_function('', 'return register_widget("best_magazine_random_post");'));

add_action('wp_ajax_wdwt_random_post', WDWT_VAR.'_random_post_fornt_end');
add_action('wp_ajax_nopriv_wdwt_random_post', WDWT_VAR.'_random_post_fornt_end');

function best_magazine_random_post_fornt_end(){
  if(isset($_GET['count_pages'])){
    if($_GET['count_pages']>0){
      $numberposts=$_GET['count_pages'];
    }
    else{
      $numberposts=1;
    }
  }
  else{
    $numberposts=1;
  }
  
  if(isset($_GET['categori_id'])){
    if($_GET['categori_id']>0){
      $cat_id=$_GET['categori_id'];
    }
    else{
      $cat_id="";
    }
  }
  else{
    $cat_id="";
  }
  
  $args = array(
    'numberposts'     => $numberposts,
    'offset'          => 0,
    'category'        => $cat_id,
    'orderby'         => 'rand',
    'order'           => 'ASC',  
    'post_type'       => 'post',
    'post_status'     => 'publish' );
  $lastposts = get_posts($args);
  
  foreach($lastposts as $post) {

    $content = $post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
     ?>
    <h5><a href="<?php echo get_permalink($post->ID); ?>"><?php echo  get_the_title($post->ID); ?></a></h5>   
    <?php
     echo $content;
     };
  die();
  
}




?>