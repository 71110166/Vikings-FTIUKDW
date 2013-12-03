$(document).ready(siap);

function siap() {
    $('div.imgproduk').on('click',function(){
				var produk = $('div.imgproduk p').text();
				console.log(produk);

                $('#popup').find('div.right p.nama-produk').html($(this).children('p:first').html());
                $('#popup').find('div.right input#id-produk').val($(this).children('p:first+p').text());
                $('#popup').find('img').attr('src', $(this).children('img').attr('src'));

				$('div#popup').bPopup();
				//$('p.nama-produk').text(produk);
			})
}