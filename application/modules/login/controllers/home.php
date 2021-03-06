<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('login_model');
	}

	function index() {
		$this->load->view('login', '');
	}
	
	function logging() {
		if ($_POST) {
			$uemail = $this -> input -> post('uemail', true);
			$upass = $this -> input -> post('upass', true);
			$remember = (int) $this -> input -> post('remember');
			$this -> session -> unset_userdata('error');

			if (!$uemail || !$upass) {
				__set_error_msg(array('error' => 'Email dan password harus di isi !!!'));
				redirect(site_url('login'));
			}
			else {
				$login = $this -> login_model -> __get_login($uemail, $upass);
				if ($login) {
					$this -> login_model -> __update_history_login($login[0] -> uid, array('ulastlogin' => ip2long($_SERVER['REMOTE_ADDR']) . '*' . time()));
					$permission = $this -> login_model -> __get_permission($login[0] -> ugid);
					
					if ($remember == 1)
						$this -> memcachedlib -> add('__login', array('uid' => $login[0] -> uid, 'uemail' => $uemail, 'ubranch' => $login[0] -> bname, 'ubranchid' => $login[0] -> bid, 'ugid' => $login[0] -> ugid, 'permission' => $permission, 'ldate' => time(), 'lip' => ip2long($_SERVER['REMOTE_ADDR']), 'skey' => md5(sha1($login[0] -> ugid.$uemail) . 'dist')), time()+60*60*24*100);
					else
						$this -> memcachedlib -> add('__login', array('uid' => $login[0] -> uid, 'uemail' => $uemail, 'ubranch' => $login[0] -> bname, 'ubranchid' => $login[0] -> bid, 'ugid' => $login[0] -> ugid, 'permission' => $permission, 'ldate' => time(), 'lip' => ip2long($_SERVER['REMOTE_ADDR']), 'skey' => md5(sha1($login[0] -> ugid.$uemail) . 'dist')), 3600);

					redirect(site_url(''));
				}
				else {
					__set_error_msg(array('error' => 'Email dan password tidak sesuai !!!'));
					redirect(site_url('login'));
				}
			}
		}
		else
			redirect(site_url('login'));
	}
	
	function logout() {
		$this -> memcachedlib -> delete('__login');
		redirect('login');
	}
}
