$(document).ready(function(){
			// $('form.formKomentar , form.formKomentarUp').submit(function(e){
				
			// 	//
			// 	e.preventDefault();
			// });

			//klik kirim komentar
			// $('.detComment').click(function(){
			// 	// alert('ahai');
				
			// });
		});
		
		function kirimKomentar(idPost,dataJenis,postId)
		{
			if(dataJenis == "post")
				dataKomentar = $('.formKomentarUp[data-jenis="'+dataJenis+'"][data-id-post="'+idPost+'"]').find('textarea').val();
			else	
				dataKomentar = $('.formKomentar[data-jenis="'+dataJenis+'"][data-id-post="'+idPost+'"]').find('textarea').val();
			// alert('.formKomentar[data-jenis="'+dataJenis+'"][data-id-post="'+idPost+'"]');
			// alert(dataKomentar);
			//kirim data				
			$.ajax({
				url : 'kirimKomentar.php',
				method : 'POST',
				data : {
					'id_post' : idPost,
					'comment' : dataKomentar,
					'jenis' : dataJenis,
				},
				success : function(data){
					if(data == "berhasil")
					{	
						if(dataJenis == "post")		
							$('form.formKomentarUp[data-id-post="'+idPost+'"]').find('textarea').val("");
						else
							$('form.formKomentar[data-id-post="'+idPost+'"]').find('textarea').val("");
						countGetKomentar(postId);
						// getKomentar(postId);
						$('.giveCommented[data-post="'+postId+'"]').load("getKomentar.php?id_post="+postId);
						//load_js();
					}
					else
					{
						alert("Gagal");
					}

				}
			});
			return false;
		}
		function detCommentClick(id)
		{
			$('form.formKomentar').slideUp("fast");
			$('.detComment').not(('.detComment[data-id="'+id+'"]')).attr('data-state','up');
				if($('.detComment[data-id="'+id+'"]').attr('data-state') == "up")
				{
					$('.detComment[data-id="'+id+'"]').siblings('.giveComments').find('form.formKomentar').slideDown("fast");		
					$('.detComment[data-id="'+id+'"]').attr('data-state','down');	
				}
				else
				{
					$('.detComment[data-id="'+id+'"]').siblings('.giveComments').find('form.formKomentar').slideUp("fast");		
					$('.detComment[data-id="'+id+'"]').attr('data-state','up');	
				}
		}
		function detLihatKomentar(id)
		{
			$('.detComment[data-id="'+id+'"]').siblings('ul.listComment').slideToggle();
			// $('form.formKomentar').slideUp("fast");
			// $('.detComment').not(('.detComment[data-id="'+id+'"]')).attr('data-state','up');
				// if($('.detComment[data-id="'+id+'"]').attr('data-state') == "up")
				// {
				// 	$('.detComment[data-id="'+id+'"]').siblings('.giveComments').find('form.formKomentar').slideDown("fast");		
				// 	$('.detComment[data-id="'+id+'"]').attr('data-state','down');	
				// }
				// else
				// {
				// 	$('.detComment[data-id="'+id+'"]').siblings('.giveComments').find('form.formKomentar').slideUp("fast");		
				// 	$('.detComment[data-id="'+id+'"]').attr('data-state','up');	
				// }
		}
		function countGetKomentar(id)
		{
			idPost = id;
			$.ajax({
				url : 'countKomentar.php',
				method : 'POST',
				data : {
					'id_post' : id,					
				},
				success : function(data){
					// alert(data);
					// console.log(data);
					$('.box[data-id-post="'+idPost+'"]').find('.jumlahKomentar').html(data);
				}
			});
		}