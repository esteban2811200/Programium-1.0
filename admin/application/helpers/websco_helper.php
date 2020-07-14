	<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/******
	 *
	 *@author  	Carlos Guevara
	 *@email 	dejitaru@gmail.com
	 *
	 *******/
	#Definimos el date default
	date_default_timezone_set('America/Mexico_City');

	function form_select_nums($name, $values, $inicio = 1, $selected = NULL)
	{
		$html = '';
		if (is_array($values)) {
			foreach ($values as $k => $v) {
				$html .= '<option value="' . $k . '">' . $v . '</option>';
			}
		} else {
			for ($i = $inicio; $i <= $values; $i++) {
				$html .= '<option value="' . $i . '">' . $i . '</option>';
			}
		}
		return $html;
	}

	function form_select_options($values, $selected = NULL)
	{
		$html = '';
		foreach ($values as $key => $value) {
			$html .= '<option value="' . $key . '">' . $value . '</option>';
		}
		return $html;
	}
	function form_select_db($values, $key = 'id', $value = 'nombre', $selected = NULL)
	{
		$html = '';
		foreach ($values->result() as $item) {
			$s = ($item->$key == $selected) ? 'selected="selected"' : '';
			$html .= '<option value="' . $item->$key . '" ' . $s . '>' . $item->$value . '</option>';
		}
		return $html;
	}
	function form_select_db_eloquent($values, $key = 'id', $value = 'name', $selected = NULL)
	{
		$html = '';
		foreach ($values as $item) {
			$s = ($item->$key == $selected) ? 'selected="selected"' : '';
			$html .= '<option title="' . $item->name . '" value="' . $item->$key . '" ' . $s . '>' . $item->$value . '</option>';
		}
		return $html;
	}

	function date_cute($date, $full = FALSE)
	{
		$date = date('Y-n-d-h-i-s', strtotime($date));
		$date = explode('-', $date);
		$meses  = array('', 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic');
		if (!$full) {
			return $date[2] . ' ' . $meses[$date[1]] . ' ' . $date[0];
		} else {
			return $date[2] . ' de ' . $meses[$date[1]] . ' ' . $date[0] . ' a las ' . $date[3] . ':' . $date[4];
		}
	}

	/*function date_diff($start, $end) {
		$start_ts = strtotime($start);
		$end_ts = strtotime($end);
		$diff = $end_ts - $start_ts;
		return round($diff / 86400);
	}*/

	function foto_default($search = '', $default = '')
	{
		if (file_exists($search)) {
			return $search;
		}
		return $default;
	}


	function date_today($type = 'short')
	{
		$date	= date('Y-n-d');
		$meses  = array('', 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic');
		return 	$date[2] . ' ' . $meses[$date[1]] . ' ' . $date[0];
	}

	function date_encabezado()
	{
		$date	= date('N-j-n');
		$date = explode('-', $date);
		$meses  = array('', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
		$dias   = array('', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
		return 	$dias[$date[0]] . ' ' . $date[1] . ' de ' . $meses[$date[2]];
	}

	function date_tomorrow()
	{
		return date("Y-m-d", strtotime(date('Y-m-d') . "+1 year"));
	}

	function date_add_years($Start, $Years)
	{
		return date("Y-m-d", strtotime(date("Y-m-d", strtotime($Start)) . " +$Years year"));
	}

	function dateDefaultFormat($date)
	{
		if ($date != '0000-00-00') {
			return date('d/m/Y', strtotime($date));
		} else {
			return ' -- -- ';
		}
	}

	/*function date_add($start,$days){
		return date("Y-m-d", strtotime($start ."+$days days" ));
	}*/

	function form_select_months($name, $selected = NULL)
	{
		$html = '';
		$meses  = array('', 'ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic');
		for ($i = 1; $i <= 12; $i++) {
			if ($selected != $i) {
				$html .= '<option value="' . $i . '">' . $meses[$i] . '</option>';
			} else {
				$html .= '<option value="' . $i . '" selected="selected">' . $meses[$i] . '</option>';
			}
		}
		return $html;
	}
	function form_select_year($name, $n, $selected = NULL)
	{
		$html = '';
		$current_year = date('Y');
		$n = $current_year + $n;
		for ($i = $current_year; $i < $n; $i++) {
			if ($selected != $i) {
				$html .= '<option value="' . $i . '">' . $i . '</option>';
			} else {
				$html .= '<option value="' . $i . '" selected="selected">' . $i . '</option>';
			}
		}
		$html .= '</select>';
		return $html;
	}

	function class_error($is_error, $class_ok = 'ok', $class_error = 'error')
	{
		if (count($_POST) > 0) {
			if (strlen($is_error) > 0) {
				echo $class_error;
			} else {
				echo $class_ok;
			}
		}
	}

	function format_filesize($size)
	{
		$units = array(' Bytes', ' KB', ' MB', ' GB', ' TB');
		for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
		return round($size, 2) . $units[$i];
	}

	function random_str($length)
	{
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((float) microtime() * 1000000);
		$i = 0;
		$pass = '';

		while ($i < $length) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}

		return $pass;
	}

	function file_extension($filename)
	{
		return substr(strrchr($filename, '.'), 1);
	}


	/* Develeoped by: faisal ahmed <thephpx(at)gmail.com–> */
	function google_translate($api_key, $text, $from_lang, $to_lang)
	{
		$link = "https://www.googleapis.com/language/translate/v2?key=" . $api_key . "&amp;source=" . $from_lang . "&amp;target=" . $to_lang . "&amp;q=" . $text;
		$response = file_get_contents($link);
		$array = json_decode($response);
		return $array->data->translations[0]->translatedText;
	}

	function firstOfMonth()
	{
		return date("m/d/Y", strtotime(date('m') . '/01/' . date('Y') . ' 00:00:00'));
	}
	function add_assets(&$assets, $new_asset = '')
	{
		if (is_array($new_asset)) {
			foreach ($new_asset as $asset) {
				$ext = end(explode(".", $asset));
				array_push($assets[$ext], $asset);
			}
		} else {
			$ext = end(explode(".", $new_asset));
			array_push($assets[$ext], $new_asset);
		}
		return TRUE;
	}

	function shared_url()
	{
		$CI = &get_instance();
		return $CI->config->item('shared_url');
	}

	function my_month($n)
	{
		$meses = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		return $meses[$n];
	}

	function image_resize($image_path, $width = 0, $height = 0, $new_image_path = '/')
	{
		//Get the Codeigniter object by reference
		$CI = &get_instance();

		//Alternative image if file was not found
		if (!file_exists($image_path)) {
			$image_path = 'images/file_not_found.jpg';
			return NULL;
		}

		//The new generated filename we want
		$fileinfo = pathinfo($image_path);
		$new_image_path = $new_image_path . $fileinfo['filename'] . '.' . $fileinfo['extension'];

		//The first time the image is requested
		//Or the original image is newer than our cache image
		if ((!file_exists($new_image_path)) || filemtime($new_image_path) < filemtime($image_path)) {
			$CI->load->library('image_lib');

			//The original sizes
			$original_size = getimagesize($image_path);
			$original_width = $original_size[0];
			$original_height = $original_size[1];
			$ratio = $original_width / $original_height;

			//The requested sizes
			$requested_width = $width;
			$requested_height = $height;

			//Initialising
			$new_width = 0;
			$new_height = 0;

			//Calculations
			if ($requested_width > $requested_height) {
				$new_width = $requested_width;
				$new_height = $new_width / $ratio;
				if ($requested_height == 0)
					$requested_height = $new_height;

				if ($new_height < $requested_height) {
					$new_height = $requested_height;
					$new_width = $new_height * $ratio;
				}
			} else {
				$new_height = $requested_height;
				$new_width = $new_height * $ratio;
				if ($requested_width == 0)
					$requested_width = $new_width;

				if ($new_width < $requested_width) {
					$new_width = $requested_width;
					$new_height = $new_width / $ratio;
				}
			}

			$new_width = ceil($new_width);
			$new_height = ceil($new_height);

			//Resizing
			$config = array();
			$config['image_library'] = 'gd2';
			$config['source_image'] = $image_path;
			$config['new_image'] = $new_image_path;
			$config['maintain_ratio'] = FALSE;
			$config['height'] = $new_height;
			$config['width'] = $new_width;
			$CI->image_lib->initialize($config);
			$CI->image_lib->resize();
			$CI->image_lib->clear();

			//Crop if both width and height are not zero
			if (($width != 0) && ($height != 0)) {
				$x_axis = floor(($new_width - $width) / 2);
				$y_axis = floor(($new_height - $height) / 2);

				//Cropping
				$config = array();
				$config['source_image'] = $new_image_path;
				$config['maintain_ratio'] = FALSE;
				$config['new_image'] = $new_image_path;
				$config['width'] = $width;
				$config['height'] = $height;
				$config['x_axis'] = $x_axis;
				$config['y_axis'] = $y_axis;
				$CI->image_lib->initialize($config);
				$CI->image_lib->crop();
				$CI->image_lib->clear();
			}
		}
		return $new_image_path;
	}

	function truncate_str($str, $maxlen)
	{
		if (strlen($str) <= $maxlen) return $str;

		$newstr = substr($str, 0, $maxlen);
		if (substr($newstr, -1, 1) != ' ') $newstr = substr($newstr, 0, strrpos($newstr, " "));

		return $newstr;
	}

	function upload_delete($file)
	{
		$CI = &get_instance();
		@unlink($file);
	}

	function upload($field, $path, $new_name = NULL, $default = NULL)
	{

		$CI = &get_instance();
		if ($_FILES[$field]['size'] > 0) {

			$ext = get_file_extension($_FILES[$field]['name']); //end((explode(".", $_FILES[$field]['name'])));
			$filename = url_title($_FILES[$field]['name']);
			$config['upload_path'] = $CI->config->item('upload_path') . $path;
			$config['allowed_types'] =  '*'; #Acept all types #'gif|jpg|png|jpeg|doc|txt|pdf|xls';
			$config['file_name'] = random_str(10) . '.' . $ext;
			$config['overwrite'] = TRUE;
			$CI->load->library('upload');
			$CI->upload->initialize($config);

			if ($CI->upload->do_upload($field)) {
				return $config['file_name'];
			} else {
				return NULL;
			}
		} else {
			return NULL;
		}
	}

	function uploads($field, $path, $new_name = NULL, $default = NULL)
	{

		$CI = &get_instance();

		if ($_FILES[$field]['size'] > 0) {

			$filesCount = count($_FILES[$field]['name']);
			for ($i = 0; $i < $filesCount; $i++) {


				$ext = end((explode('.', $_FILES[$field]['name'][$i])));
				$_FILES['file']['name'] = random_str(10) . '.' . $ext;
				$_FILES['file']['type'] = $_FILES[$field]['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES[$field]['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES[$field]['error'][$i];
				$_FILES['file']['size'] = $_FILES[$field]['size'][$i];


				$config['upload_path'] = $CI->config->item('upload_path') . $path;
				$config['allowed_types'] = '*';
				$config['max_size'] = '0';
				$config['max_filename'] = '255';
				//$config['encrypt_name'] = TRUE;
				$config['file_name'] = $_FILES['file']['name']; //random_str(10).'.'.$ext;

				$CI->load->library('upload');
				$CI->upload->initialize($config);
				if ($CI->upload->do_upload('file')) {
					return $config['file_name'];
				} else {
					return NULL;
				}
			}
		} else {
			return NULL;
		}
	}

	function image_default($image = NULL, $default = 'default.jpg')
	{
		if ($image == NULL) {
			return $default;
		} else {
			return $image;
		}
	}

	function encrypt($string, $key = "@c-developer")
	{
		$result = '';
		for ($i = 0; $i < strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key)) - 1, 1);
			$char = chr(ord($char) + ord($keychar));
			$result .= $char;
		}
		return base64_encode($result);
	}

	function decrypt($string, $key = "@c-developer")
	{
		$result = '';
		$string = base64_decode($string);
		for ($i = 0; $i < strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key)) - 1, 1);
			$char = chr(ord($char) - ord($keychar));
			$result .= $char;
		}
		return $result;
	}

	function sendEmailServices($enviar_a, $titulo, $mensaje)
	{

		$ci = &get_instance();
		$query = "SELECT * FROM configuration WHERE Cv_Cve_Clase_Variable='0035'";
		$result = $ci->db->query($query);

		foreach ($result->result_array() as $config) {
			switch ($config['Cf_Variable']) {
				case 'EMAIL_AUTENTICACION':
					$eAuthentication = trim($config['Cf_Valor']);
					break;
				case 'EMAIL_PASSWORD':
					$ePassword = "2xhdtyq#cn-Pk9giblfuweamzsprQj";
					break;
				case 'EMAIL_PUERTO':
					$ePort = trim($config['Cf_Valor']);
					break;
				case 'EMAIL_SERVIDOR':
					$eHost = trim($config['Cf_Valor']);
					break;
				case 'EMAIL_SSL':
					$eSsl = false;
				case 'EMAIL_TIME_OUT':
					$epwd = trim($config['Cf_Valor']);
					break;
				case 'EMAIL_USUARIO':
					$eUser = trim($config['Cf_Valor']);
					break;
				case 'EMAIL_NOTIFICACION':
					$eName = trim($config['Cf_Valor']);
					break;
			}
		}

		$ci->load->library('email');
		#configuracion para gmail		
		$configEmail = array(
			'protocol' => 'smtp',
			'smtp_host' => $eHost,
			'smtp_port' => $ePort,
			'smtp_user' => $eUser,
			'smtp_pass' => $ePassword,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		);
		$ci->email->initialize($configEmail);
		$ci->email->from($eName);
		$ci->email->to($enviar_a);
		//  $ci->email->cc($eUser, $eName);
		$ci->email->subject($titulo);
		$ci->email->message($mensaje);

		if ($ci->email->send()) {
			return 1;
		} else {
			return 0;
		}
	}

	function generateDir($path)
	{

		@mkdir($path, 0777, TRUE);

		return $path;
	}

	function get_file_extension($file_name)
	{
		return substr(strrchr($file_name, '.'), 1);
	}

	function create_list($arr, $urutan)
	{

		if ($urutan == 0) {
			$html = "<ul class='sidebar-menu' data-widget='tree'>";
			$html .= "<li class='header'>MENU PRINCIPAL</li>";
		} else {
			$html = "<ul class='treeview-menu'>";
		}

		foreach ($arr as $key => $v) {


			if (array_key_exists('children', $v)) {

				$html .= "<li class='treeview'>";
				$html .= '<a href="#">
                            <i class="' . $v['icon'] . '"></i>
                            <span>' . $v['name'] . '</span>
                            <i class="fa fa-angle-left pull-right"></i>
                            </a>';

				$html .= create_list($v['children'], 1);
				$html .= "</li>";
			} else {
				$html .= '<li><a href="' . $v['url'] . '">';
				if ($urutan == 0) {
					$html .= '<i class="' . $v['icon'] . '"></i>';
				}
				if ($urutan == 1) {
					$html .= '<i class="fa fa-angle-double-right"></i>';
				}
				$html .= $v['name'] . "</a></li>\n";
			}
		}
		$html .= "</ul>\n";
		return $html;
	}


	function strPad($value, $cant = 15, $type = '0')
	{
		return str_pad($value, $cant, $type, STR_PAD_LEFT);
	}
	
# C#/PHP Compatible Encryption (AES256)
