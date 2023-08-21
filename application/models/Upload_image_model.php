<?php
class Upload_image_model extends CI_Model {

  public function __construct(){
      parent::__construct();
  }

  public function upload_img($input, $folder, $img_error, $types = '*'){
    # $input // Nome do input
    # $folder // Diretorio que será salvo a imagem
    # $img_error // imagem que sera salva caso der erro
    # $types // Tipos de arquivos suportados
    $config['upload_path'] = $folder;
    $config['allowed_types'] = $types;
    $config['encrypt_name'] = true;

    $this->load->library('upload', $config);

    if ($_FILES[$input]['name'] != '') {
      if ($this->upload->do_upload($input)){
        $info_file = $this->upload->data();
        $images = $info_file['file_name'];
        return $images;
      } else {
        $images = $img_error;
        echo $this->upload->display_errors();
        // echo "<script>alert('Imagem não enviada'); history.back();</script>";
        return false;
      }
    } else {
      $images = $img_error;
      return false;
    }
    return false;
  }

  public function upload_images_multiples($input, $folder, $img_error, $types = null){
    # $input // Nome do input
    # $folder // Diretorio que será salvo a imagem
    # $img_error // imagem que sera salva caso der erro
    # $types // Tipos de arquivos suportados
    $data = [];
    $images = [];
    $count = count($input['name']);

    for($i=0;$i<$count;$i++){
      if(!empty($input['name'][$i])){
        $_FILES['file']['name'] = $input['name'][$i];
        $_FILES['file']['type'] = $input['type'][$i];
        $_FILES['file']['tmp_name'] = $input['tmp_name'][$i];
        $_FILES['file']['error'] = $input['error'][$i];
        $_FILES['file']['size'] = $input['size'][$i];

        $config['upload_path'] = $folder;
        $config['allowed_types'] = ($types == null) ? 'jpg|JPG|jpeg|JPEG|png|PNG' : $types;
        $config['file_name'] = $input['name'][$i];
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload',$config);

        if($this->upload->do_upload('file')){
          $uploadData = $this->upload->data();
          $images['arquivos'][] = $uploadData['file_name'];

          $data['totalFiles'][] = $images['arquivos'];
        }else{
          $images['arquivos'][] = $img_error;
          echo $this->upload->display_errors();
          echo "Imagem não enviada";
        }
      }
    }
    return $images['arquivos'];
  }

}
