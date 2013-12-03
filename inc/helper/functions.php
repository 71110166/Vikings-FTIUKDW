<?php
	function get_product_name($pid){
		$result=mysql_query("select produk.nama, kategori.nama AS kat_nama from produk JOIN kategori ON produk.kategori_id=kategori.id where produk.id=$pid");
		$row=mysql_fetch_array($result);
		return $row['kat_nama'] . ' ' . $row['nama'];
	}
	function get_price($pid){
		$result=mysql_query("select harga from produk where id=$pid");
		$row=mysql_fetch_array($result);
		return $row['harga'];
	}
	function remove_product($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}
	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			$sum+=$price*$q;
		}
		return $sum;
	}
	function addtocart($pid,$q,$s){
		if($pid<1 or $q<1) return;

		if(is_array($_SESSION['cart'])){
			if(product_exists($pid)) return;
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['productid']=$pid;
			$_SESSION['cart'][$max]['qty']=$q;
			$_SESSION['cart'][$max]['size']=$s;
		}
		else{
			$_SESSION['cart']=array();
            $_SESSION['cart'][] = array('productid' => $pid, 'qty' => $q, 'size' => $s);
		}
	}
	function product_exists($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				$flag=1;
				break;
			}
		}
		return $flag;
	}

?>