<?php


class Best_magazine_meta_layout_controller extends WDWT_meta_controller_section{
  
    public function __construct(){
    require_once('meta_layout_model.php');
    require_once('meta_layout_view.php');

    $this->model = new Best_magazine_meta_layout_model();
    $this->view = new Best_magazine_meta_layout_view( $this->model);
  }

}


