<?php
	function jam_tambah($jam){
		$ja = date('H:i:s',strtotime($jam));
		// $ja = date('H:i:s', strtotime($jam . '+ 7 hours'));
		return($ja);
	}
	function jam_t($jam){
		$ja = date('H:i',strtotime($jam.'+ 7 hours'));
		return($ja);
	}

	function hari_tambah($hari)
	{
		$ja = date('Y-m-d', strtotime($hari . '+ 1 day'));
		return ($ja);
	}
	
	function ambil_tanggal($tanggal){
		$r=date('l',strtotime($tanggal));
		$result=date('d M Y H:i:s',strtotime($tanggal));
		if($r=='Monday'){
			$a='Senin';
		}elseif($r=='Tuesday'){
			$a='Selasa';
		}elseif($r=='Wednesday'){
			$a='Rabu';
		}elseif($r=='Thursday'){
			$a='Kamis';
		}elseif($r=='Friday'){
			$a='Jumat';
		}elseif($r=='Saturday'){
			$a='Sabtu';
		}elseif($r=='Sunday'){
			$a='Minggu';
		}

		return($a.' '.$result);

	}

	function tanggal($tanggal){
		$result=date('d/m/Y',strtotime($tanggal));
		return($result);

	}
	function tanggal1($tanggal){
		$result=date('Y-m-d',strtotime($tanggal));
		return($result);

	}
?>