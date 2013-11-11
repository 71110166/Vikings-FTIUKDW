$(document).ready(siap);

function siap() {
    $('div.imgproduk').on('click',function(){
				var produk = $('div.imgproduk p').text();
				console.log(produk);
                
                $('#popup').find('div.right p.nama-produk').text($(this).children('p').text());
                $('#popup').find('img').attr('src', $(this).children('img').attr('src'));
                
				$('div#popup').bPopup();
				//$('p.nama-produk').text(produk);
			})
}