分頁未完成作品
function paging(arguments,showpage,showlocation)
{
	//全部的陣列
	var totaldata= arguments.length
	var pagingN=Math.ceil(totaldata/9);
	
	//設定分頁數
	for(var m=1;m<=pagingN;m++)
	{
		$('showpage').append(
			"<li><a href=# class="+'getPaging'+">"+m+"</a></li>"
		
		);
	}
	
	$(".getPaging").click(function(){
		var number=(this.text)-1;
		var countN=Math.ceil(totaldata/3);
		//alert(number);
		if(i<(pagingN-1))
		{
			for(var i=0;i<3;i++)
			{
				//if(i<(countN-1))
				//{
					$('showlocation').append(
						
						
						"<tr>"
						
					);	
					
					for(var j=number*9;j<(number*9)+3;j++)
					{
						var titlestr = arguments[i+j]['title'].substr(0,7);
						//Jquery的方法裡面不能寫入php,for什麼的,然後javascript要放在function () {}中
						$('showlocation').append(
								
							
								//轉個彎不要一直想用PHP做JS也可以轉頁面
								  "<td class=index_style10>"+
										"<a href=item_detail.php?"+arguments[i+j]['id']+"><img src=Ch30/photo/item/"+arguments[i*3+j]['photo']+" width=100 height=120/></a>"+
									"<table class=table_sample>"+
									  "<tr>"+
										"<td class=index_style11>"+
											 "<a href=item_detail.php?"+arguments[i+j]['id']+" class=index_style12>"+
												 titlestr+
											  "</a>"+
										"</td>"+
									  "</tr>"+
									  "<tr>"+
										"<td class=index_style13>"+
										  
										  "作者 :"+ 
										  "<span class=index_style14>"+
											// +'<?php echo "123"; ?>'+
											arguments[i+j]['author']+
										  "</span>"+
										  "<br />"+
										  "發行日 :" +
										  "<span class=index_style14>"+
											arguments[i+j]['publishdate']+
										  "</span>"+
										  "<br />"+
										  "原價 : "+
										  "<span class=index_style14>"+
												arguments[i+j]['price']+"元"+
										  "</span>"+
										  "<br />"+
										  "<span class=index_style15>"+
											"特價："+arguments[i+j]['discount']+"折"+ 
											 arguments[i+j]['saleprice']+"元"+
										  "</span>"+
										  "<br />"+
										  //javascript單引號裡面的值才有效,用雙引號變字串
										  "<button type=button class='btn btn-info btn-lg'>加入購物車</button>"+
										  
										"</td>"+
									  "</tr>"+
									"</table>"+
								  "</td>"
								
									
						
							
						);
					}
					
					$('showlocation').append(
						
						
						"</tr>"
						
					);	
			}
		}
				//}
		else
		{
			var remainddata=totaldata-number*9;
			var countN=Math.ceil(remainddata/3);
			var remaind=remainddata%3;
			for(var g=0;g<countN;g++)
			{
				
				if(i<(countN-1))
				{
					$('showlocation').append(
						
						
						"<tr>"
						
					);	
					
					for(var k=number*9;k<(number*9)+3;k++)
					{
						$('showlocation').append(
							
									
								  "<td class=index_style10>"+
										"<a href=item_detail.php?"+arguments[g+k]['id']+"><img src=Ch30/photo/item/"+arguments[i*3+j]['photo']+" width=100 height=120/></a>"+
									"<table class=table_sample>"+
									  "<tr>"+
										"<td>"+
											"<a href=item_detail.php?"+arguments[g+k]['id']+" class=index_style12>"+
												 titlestr+
											  "</a>"+
										"</td>"+
									  "</tr>"+
									  "<tr>"+
										"<td>"+
										  
										  "作者 :"+ 
										  "<span class=index_style14>"+
											arguments[g+k]['author']+
										  "</span>"+
										  "<br />"+
										  "發行日 :" +
										  "<span class=index_style14>"+
											arguments[g+k]['publishdate']+
										  "</span>"+
										  "<br />"+
										  "原價 : "+
										  "<span class=index_style14>"+
												arguments[g+k]['price']+"元"+
										  "</span>"+
										  "<br />"+
										  "<span class=index_style15>"+
											"特價："+arguments[g+k]['discount']+"折"+ 
											 arguments[g+k]['saleprice']+"元"+
										  "</span>"+
										  "<br />"+
										  //javascript單引號裡面的值才有效,用雙引號變字串
										  "<button type=button class='btn btn-info btn-lg'>加入購物車</button>"+
										  
										"</td>"+
									  "</tr>"+
									"</table>"+
								  "</td>"
						);
					
					}
					$('showlocation').append(
						
						
						"</tr>"
						
					);
				}
				else
				{
					$('#showitem').append(
				
				
						"<tr>"
						
					);
				
					for(var n=number*9;n<remaind+(number*9);n++)
					{
						$('#showitem').append(
							
									
					              "<td class=index_style10>"+
					            		"<a href=item_detail.php?"+arguments[g+n]['id']+"><img src=Ch30/photo/item/"+arguments[i*3+j]['photo']+" width=100 height=120/></a>"+
					                "<table class=table_sample>"+
					                  "<tr>"+
					                    "<td>"+
					                        "<a href=item_detail.php?"+arguments[g+n]['id']+" class=index_style12>"+
						                         titlestr+
						                      "</a>"+
					                    "</td>"+
					                  "</tr>"+
					                  "<tr>"+
					                    "<td>"+
					                      
					                      "作者 :"+ 
					                      "<span class=index_style14>"+
					                        arguments[g+n]['author']+
					                      "</span>"+
					                      "<br />"+
					                      "發行日 :" +
					                      "<span class=index_style14>"+
					                        arguments[g+n]['publishdate']+
					                      "</span>"+
					                      "<br />"+
					                      "原價 : "+
										  "<span class=index_style14>"+
												arguments[g+n]['price']+"元"+
					                      "</span>"+
					                      "<br />"+
					                      "<span class=index_style15>"+
					                        "特價："+arguments[i*3+j]['discount']+"折"+ 
					                         arguments[g+n]['saleprice']+"元"+
					                      "</span>"+
					                      "<br />"+
					                      //javascript單引號裡面的值才有效,用雙引號變字串
					                      "<button type=button class='btn btn-info btn-lg'>加入購物車</button>"+
					                      
					                    "</td>"+
					                  "</tr>"+
					                "</table>"+
					              "</td>"
						);
					
					}
					$('#showitem').append(
						
						
						"</tr>"
						
					);
						
						
						
						
				}
			
			}
		
		}
			
			
			
			
			
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	var totaldata= arguments.length
	var pagingN=Math.ceil(totaldata/9);
	var countN=Math.ceil(totaldata/3);
	var remaind=totaldata%3;
	// var value = '<?php echo "123"; ?>';
	// alert(value);
	for(var i=0;i<countN;i++)
	{
		if(i<(countN-1))
		{
			$('#showitem').append(
				
				
				"<tr>"
				
			);	
			
			for(var j=0;j<3;j++)
			{
				var titlestr = arguments[i*3+j]['title'].substr(0,7);
				//Jquery的方法裡面不能寫入php,for什麼的,然後javascript要放在function () {}中
				$('#showitem').append(
						
					
			            //轉個彎不要一直想用PHP做JS也可以轉頁面
			              "<td class=index_style10>"+
			            		"<a href=item_detail.php?"+arguments[i*3+j]['id']+"><img src=Ch30/photo/item/"+arguments[i*3+j]['photo']+" width=100 height=120/></a>"+
			                "<table class=table_sample>"+
			                  "<tr>"+
			                    "<td class=index_style11>"+
			                         "<a href=item_detail.php?"+arguments[i*3+j]['id']+" class=index_style12>"+
				                         titlestr+
				                      "</a>"+
			                    "</td>"+
			                  "</tr>"+
			                  "<tr>"+
			                    "<td class=index_style13>"+
			                      
			                      "作者 :"+ 
			                      "<span class=index_style14>"+
			                    	// +'<?php echo "123"; ?>'+
			                        arguments[i*3+j]['author']+
			                      "</span>"+
			                      "<br />"+
			                      "發行日 :" +
			                      "<span class=index_style14>"+
			                        arguments[i*3+j]['publishdate']+
			                      "</span>"+
			                      "<br />"+
			                      "原價 : "+
								  "<span class=index_style14>"+
										arguments[i*3+j]['price']+"元"+
			                      "</span>"+
			                      "<br />"+
			                      "<span class=index_style15>"+
			                        "特價："+arguments[i*3+j]['discount']+"折"+ 
			                         arguments[i*3+j]['saleprice']+"元"+
			                      "</span>"+
			                      "<br />"+
								  //javascript單引號裡面的值才有效,用雙引號變字串
			                      "<button type=button class='btn btn-info btn-lg'>加入購物車</button>"+
			                      
			                    "</td>"+
			                  "</tr>"+
			                "</table>"+
			              "</td>"
						
							
				
					
				);
			}
			
			$('#showitem').append(
				
				
				"</tr>"
				
			);	
			
		}
		else
		{
			$('#showitem').append(
				
				
				"<tr>"
				
			);	
			
			for(var j=0;j<remaind;j++)
			{
				$('#showitem').append(
					
							
			              "<td class=index_style10>"+
			            		"<a href=item_detail.php?"+arguments[i*3+j]['id']+"><img src=Ch30/photo/item/"+arguments[i*3+j]['photo']+" width=100 height=120/></a>"+
			                "<table class=table_sample>"+
			                  "<tr>"+
			                    "<td>"+
			                        "<a href=item_detail.php?"+arguments[i*3+j]['id']+" class=index_style12>"+
				                         titlestr+
				                      "</a>"+
			                    "</td>"+
			                  "</tr>"+
			                  "<tr>"+
			                    "<td>"+
			                      
			                      "作者 :"+ 
			                      "<span class=index_style14>"+
			                        arguments[i*3+j]['author']+
			                      "</span>"+
			                      "<br />"+
			                      "發行日 :" +
			                      "<span class=index_style14>"+
			                        arguments[i*3+j]['publishdate']+
			                      "</span>"+
			                      "<br />"+
			                      "原價 : "+
								  "<span class=index_style14>"+
										arguments[i*3+j]['price']+"元"+
			                      "</span>"+
			                      "<br />"+
			                      "<span class=index_style15>"+
			                        "特價："+arguments[i*3+j]['discount']+"折"+ 
			                         arguments[i*3+j]['saleprice']+"元"+
			                      "</span>"+
			                      "<br />"+
			                      //javascript單引號裡面的值才有效,用雙引號變字串
			                      "<button type=button class='btn btn-info btn-lg'>加入購物車</button>"+
			                      
			                    "</td>"+
			                  "</tr>"+
			                "</table>"+
			              "</td>"
				);
			
			}
			$('#showitem').append(
				
				
				"</tr>"
				
			);
		
		
		
		}
	
	
	}
	

	
}